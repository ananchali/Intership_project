<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Step 1: Select Package
    public function step1()
    {
        $packages = Package::active()->get();
        return view('orders.step1', compact('packages'));
    }

    // Step 2: Domain Selection
    public function step2(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(['package_id' => 'required|exists:packages,id']);
            session(['order_data.package_id' => $request->package_id]);
        }

        $package_id = session('order_data.package_id');
        if (!$package_id) {
            return redirect()->route('orders.step1');
        }

        $package = Package::find($package_id);
        return view('orders.step2', compact('package'));
    }

    // Step 3: Checkout Details
    public function step3(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'package_id' => 'required|exists:packages,id',
                'domain_name' => 'required|string',
                'domain_type' => 'required|string',
            ]);
            
            session(['order_data.domain_name' => $request->domain_name]);
            session(['order_data.domain_type' => $request->domain_type]);
        }

        $package_id = session('order_data.package_id');
        $domain_name = session('order_data.domain_name');
        $domain_type = session('order_data.domain_type');

        if (!$package_id || !$domain_name) {
            return redirect()->route('orders.step2');
        }
        
        $package = Package::find($package_id);
        $domainData = [
            'domain_name' => $domain_name,
            'domain_type' => $domain_type,
        ];
        $paymentMethods = PaymentMethod::where('is_active', true)->get();
        $user = auth()->user();
        
        return view('orders.step3', compact('package', 'domainData', 'paymentMethods', 'user'));
    }

    // Step 4: Place Order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'domain_name' => ['required', 'string'],
            'domain_type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'payment_method' => ['required', 'string'],
        ], [
            'phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911223344)',
        ]);

        $package = Package::find($request->package_id);

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'package_id' => $package->id,
            'customer_id' => auth()->id(),
            'domain_name' => $request->domain_name,
            'domain_type' => $request->domain_type,
            'status' => 'pending',
            'total_amount' => $package->price,
            'currency' => $package->currency,
            'customer_details' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('orders.step4', ['order' => $order->id]);
    }

    // Step 4: Payment Instructions
    public function step4(Order $order)
    {
        $paymentMethod = PaymentMethod::where('name', $order->payment_method)->first();
        return view('orders.step4', compact('order', 'paymentMethod'));
    }

    public function yegaraStoreDomain(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'domain_name' => 'required|string',
            'domain_type' => 'required|string',
            'domain_ext' => 'nullable|string',
        ]);

        session(['order_data' => [
            'package_id' => $request->package_id,
            'domain_name' => $request->domain_name . ($request->domain_ext ?? ''),
            'domain_type' => $request->domain_type,
        ]]);

        return redirect()->route('orders.yegara-flow', ['step' => 3, 'package_id' => $request->package_id]);
    }

    public function yegaraStoreLevel(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'selected_level' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        session(['order_data' => [
            'package_id' => $request->package_id,
            'selected_level' => $request->selected_level,
            'total_amount' => $request->total_amount,
        ]]);

        return redirect()->route('orders.yegara-flow', ['step' => 3, 'package_id' => $request->package_id]);
    }

    public function yegaraPlaceOrder(Request $request)
    {
        $orderData = session('order_data');
        if (!$orderData || !isset($orderData['package_id'])) {
            return redirect()->route('orders.yegara-flow', ['step' => 1]);
        }

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $package = Package::find($orderData['package_id']);
        $user = auth()->user();
        $parts = explode(' ', $user?->name ?? 'Customer User');
        $firstName = $parts[0];
        $lastName = $parts[1] ?? '';

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'package_id' => $package->id,
            'customer_id' => auth()->id(),
            'domain_name' => $orderData['domain_name'] ?? '',
            'domain_type' => $orderData['domain_type'] ?? 'register',
            'status' => 'pending',
            'total_amount' => $package->price,
            'currency' => $package->currency,
            'customer_details' => [
                'name' => trim($firstName . ' ' . $lastName),
                'email' => $user?->email,
                'phone' => $user?->phone,
            ],
            'payment_method' => $request->payment_method,
        ]);

        session()->forget('order_data');

        return redirect()->route('orders.yegara-flow', [
            'step' => 4,
            'order_id' => $order->id,
        ]);
    }

    public function yegaraPlaceServiceOrder(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $orderData = session('order_data');
        if (!$orderData || !isset($orderData['package_id'])) {
            return redirect()->route('orders.yegara-flow', ['step' => 1]);
        }

        $request->validate([
            'payment_method' => 'required',
        ]);

        $package = Package::find($orderData['package_id']);
        $user = auth()->user();

        if (!$package || $package->type !== 'services') {
            return redirect()->back()->withErrors(['Invalid service package.']);
        }

        $levels = $package->features['levels'] ?? [];
        $selectedLevelData = null;
        foreach ($levels as $level) {
            if ($level['name'] === $orderData['selected_level']) {
                $selectedLevelData = $level;
                break;
            }
        }

        if (!$selectedLevelData) {
            return redirect()->back()->withErrors(['Invalid service level selected.']);
        }

        $parts = explode(' ', $user?->name ?? 'Customer');
        $firstName = $parts[0];
        $lastName = $parts[1] ?? '';

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'package_id' => $package->id,
            'customer_id' => auth()->id(),
            'selected_level' => $selectedLevelData,
            'status' => 'pending',
            'total_amount' => $orderData['total_amount'],
            'currency' => $package->currency,
            'customer_details' => [
                'name' => trim($firstName . ' ' . $lastName),
                'email' => $user?->email,
                'phone' => $user?->phone,
            ],
            'payment_method' => $request->payment_method,
        ]);

        session()->forget('order_data');

        return redirect()->route('orders.yegara-flow', [
            'step' => 4,
            'order_id' => $order->id,
        ]);
    }
}
