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

    public function yegaraPlaceOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'domain_name' => 'required|string',
            'domain_type' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $package = Package::find($request->package_id);
        $user = auth()->user();
        $parts = explode(' ', $user?->name ?? 'Customer User');
        $firstName = $request->first_name ?? $parts[0];
        $lastName = $request->last_name ?? ($parts[1] ?? '');
        $domainExt = $request->domain_ext ?? '';

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'package_id' => $package->id,
            'customer_id' => auth()->id(),
            'domain_name' => $request->domain_name . $domainExt,
            'domain_type' => $request->domain_type,
            'status' => 'pending',
            'total_amount' => $package->price,
            'currency' => $package->currency,
            'customer_details' => [
                'name' => trim($firstName . ' ' . $lastName),
                'email' => $request->email ?? $user?->email,
                'phone' => $request->phone ?? $user?->phone,
            ],
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('orders.yegara-flow', [
            'step' => 4,
            'order_id' => $order->id,
            'payment_method' => $request->payment_method
        ]);
    }
}
