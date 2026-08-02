<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class AdminPaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::with('business')
            ->when($this->businessId(), fn($q) => $q->where('business_id', $this->businessId()))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment-methods.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'instructions' => 'nullable|string|max:500',
            'is_active' => 'nullable',
            'applicable_to' => 'nullable|array',
            'applicable_providers' => 'nullable|array',
            'applicable_package_ids' => 'nullable|array',
        ], [
            'name.required' => 'Please select a bank or payment method name.',
            'account_number.required' => 'Account number / phone is required.',
            'account_name.required' => 'Account holder name is required.',
            'icon.image' => 'The icon must be an image file (PNG, JPG, SVG).',
            'icon.max' => 'The icon must be less than 2MB.',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['applicable_to'] = $request->has('applicable_to') ? implode(',', $request->applicable_to) : 'all';
        $data['applicable_providers'] = $request->has('applicable_providers') ? implode(',', $request->applicable_providers) : null;
        $data['applicable_package_ids'] = $request->has('applicable_package_ids') ? implode(',', $request->applicable_package_ids) : null;
        $data['business_id'] = $this->businessId();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('payment-icons', 'public');
        }

        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        $this->authorizeMethod($paymentMethod);
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorizeMethod($paymentMethod);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'instructions' => 'nullable|string|max:500',
            'is_active' => 'nullable',
            'applicable_to' => 'nullable|array',
            'applicable_providers' => 'nullable|array',
            'applicable_package_ids' => 'nullable|array',
        ], [
            'name.required' => 'Please select a bank or payment method name.',
            'account_number.required' => 'Account number / phone is required.',
            'account_name.required' => 'Account holder name is required.',
            'icon.image' => 'The icon must be an image file (PNG, JPG, SVG).',
            'icon.max' => 'The icon must be less than 2MB.',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['applicable_to'] = $request->has('applicable_to') ? implode(',', $request->applicable_to) : 'all';
        $data['applicable_providers'] = $request->has('applicable_providers') ? implode(',', $request->applicable_providers) : null;
        $data['applicable_package_ids'] = $request->has('applicable_package_ids') ? implode(',', $request->applicable_package_ids) : null;

        if ($request->hasFile('icon')) {
            if ($paymentMethod->icon) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($paymentMethod->icon);
            }
            $data['icon'] = $request->file('icon')->store('payment-icons', 'public');
        }

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            // Check if it was passed via route model binding if id is empty
            // But since we changed the route, we find it manually
            return redirect()->route('admin.payment-methods.index')->with('error', 'No payment method ID provided.');
        }

        try {
            $paymentMethod = PaymentMethod::findOrFail($id);
            $this->authorizeMethod($paymentMethod);
            $paymentMethod->delete();
            return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.payment-methods.index')->with('error', 'Error deleting: ' . $e->getMessage());
        }
    }

    private function businessId(): ?int
    {
        $user = auth()->user();
        if (!$user || $user->isSuperAdmin()) {
            return null;
        }
        return $user->business_id;
    }

    private function authorizeMethod(PaymentMethod $paymentMethod): void
    {
        $businessId = $this->businessId();
        if ($businessId && $paymentMethod->business_id !== $businessId) {
            abort(403);
        }
    }
}
