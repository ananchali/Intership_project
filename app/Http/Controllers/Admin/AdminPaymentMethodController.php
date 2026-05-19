<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class AdminPaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();
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
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');
        
        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

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
            $paymentMethod->delete();
            return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.payment-methods.index')->with('error', 'Error deleting: ' . $e->getMessage());
        }
    }
}
