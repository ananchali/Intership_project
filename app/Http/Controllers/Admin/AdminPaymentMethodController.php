<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\HandlesAdminDestroy;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class AdminPaymentMethodController extends Controller
{
    use HandlesAdminDestroy;

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
        $data = $request->validate($this->paymentMethodValidationRules());
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
        $data = $request->validate($this->paymentMethodValidationRules());
        $data['is_active'] = $request->has('is_active');

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment Method updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        return $this->destroyRecord(
            $request,
            $id,
            PaymentMethod::class,
            'admin.payment-methods.index',
            'Payment Method'
        );
    }

    protected function paymentMethodValidationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable',
        ];
    }
}
