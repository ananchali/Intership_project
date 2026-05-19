<?php

namespace App\Http\Controllers;

use App\Models\PaymentVerification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentVerificationController extends Controller
{
    /**
     * Show the verification form for a given order.
     */
    public function show(Order $order)
    {
        return view('payment.verify', ['order' => $order]);
    }

    /**
     * Handle verification form submission.
     */
    public function submit(Request $request, Order $order = null)
    {
        if (!$order && $request->has('order_id')) {
            // Find order by ID or order_number
            $order = Order::where('id', $request->order_id)
                         ->orWhere('order_number', $request->order_id)
                         ->first();
        }

        if (!$order) {
            return back()->withErrors(['The specified order could not be found. Please check your Order ID.'])->withInput();
        }
        $request->validate([
            'bank_name'          => 'required|string|max:255',
            'account_name'       => 'required|string|max:255',
            'transaction_number' => 'nullable|string|max:255',
            'transaction_date'   => 'required|date',
            'description'        => 'nullable|string',
            'bank_slip'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Ensure at least one of transaction number or bank slip is provided
        if (empty($request->transaction_number) && !$request->hasFile('bank_slip')) {
            return back()->withErrors(['Either a transaction number or a bank slip must be provided.'])->withInput();
        }

        $slipPath = null;
        if ($request->hasFile('bank_slip')) {
            $slipPath = $request->file('bank_slip')->store('slips', 'public');
        }

        PaymentVerification::create([
            'order_id'                  => $order->id,
            'transaction_reference'     => $request->transaction_number,
            'additional_notes'          => $request->description,
            'bank_slip_path'            => $slipPath,
            'customer_name'             => $request->account_name ?? null,
            'payment_date'              => $request->transaction_date ?? null,
            'bank_name'                 => $request->bank_name ?? null,
            'status'                    => 'pending',
        ]);

        return redirect()->route('orders.success');
    }

    /**
     * Show a simple success page after verification submission.
     */
    public function success()
    {
        return view('payment.success');
    }

    /**
     * Show payment status check form.
     */
    public function checkStatus()
    {
        return view('payment-status');
    }

    /**
     * Show payment verification status by order ID.
     */
    public function showStatus($order_id)
    {
        $verification = PaymentVerification::whereHas('payment.order', function ($query) use ($order_id) {
            return $query->where('order_number', $order_id);
        })->first();

        return view('payment-status', compact('verification'));
    }
}
