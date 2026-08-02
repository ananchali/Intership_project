<?php

namespace App\Http\Controllers;

use App\Mail\NewPaymentVerification;
use App\Models\PaymentVerification;
use App\Models\Order;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            $order = Order::where('id', $request->order_id)
                         ->orWhere('order_number', $request->order_id)
                         ->first();
        }

        $validated = $request->validate([
            'order_id'           => 'required',
            'amount'             => 'required|numeric|min:0',
            'bank_name'          => 'nullable|string|max:255',
            'account_name'       => 'required|string|max:255',
            'transaction_number' => 'nullable|string|max:255|unique:payment_verifications,transaction_reference',
            'transaction_date'   => 'nullable|date',
            'description'        => 'nullable|string|max:1000',
            'bank_slip'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'order_id.required' => 'Please enter your Order ID or Invoice Number.',
            'amount.required' => 'Please enter the payment amount.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount must be greater than zero.',
            'account_name.required' => 'Please enter the account holder name.',
            'bank_slip.max' => 'Bank slip must be less than 2MB in size.',
        ]);

        if (!$order) {
            return back()->withErrors(['order_id' => 'The specified order could not be found. Please check your Order ID.'])->withInput();
        }

        if (empty($request->transaction_number) && !$request->hasFile('bank_slip')) {
            return back()->withErrors(['transaction_number' => 'Either a transaction reference number or a bank slip must be provided.'])->withInput();
        }

        $slipPath = null;
        if ($request->hasFile('bank_slip')) {
            $slipPath = $request->file('bank_slip')->store('slips', 'public');
        }

        $verification = PaymentVerification::create([
            'order_id'                  => $order->id,
            'business_id'               => $order->business_id,
            'transaction_reference'     => $request->transaction_number,
            'additional_notes'          => $request->description,
            'bank_slip_path'            => $slipPath,
            'customer_name'             => $request->account_name ?? null,
            'payment_date'              => $request->transaction_date ?? null,
            'bank_name'                 => $request->bank_name ?? null,
            'status'                    => 'pending',
        ]);

        // Reset order to pending when a verification is (re)submitted
        $order->update(['status' => 'pending']);

        AdminNotification::create([
            'type'    => 'payment_verification',
            'title'   => 'New Payment Verification',
            'message' => ($request->account_name ?? 'A customer') . ' submitted a payment verification for order #' . $order->order_number,
            'link'    => route('admin.verifications.pending'),
            'business_id' => $order->business_id,
        ]);

        // Send email notification to admin
        try {
            $adminEmail = config('mail.admin_address', 'support@afronexhosting.com');
            Mail::to($adminEmail)->send(new NewPaymentVerification($verification));
        } catch (\Exception $e) {
            \Log::warning('Failed to send admin notification email: ' . $e->getMessage());
        }

        $redirect = $request->input('_from_yegara')
            ? redirect()->route('orders.yegara-flow', ['step' => 4, 'order_id' => $order->id, 'verified' => 1])
            : redirect()->route('orders.success');

        return $redirect->with('success', 'Your payment verification has been submitted successfully and is now under review by our admin team.');
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
        })->orWhereHas('order', function ($query) use ($order_id) {
            return $query->where('order_number', $order_id);
        })->first();

        return view('payment-status', compact('verification'));
    }
}
