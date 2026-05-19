<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentVerification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function create(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'This order cannot accept payments.');
        }

        return view('payments.create', compact('order'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,_id',
            'bank_name' => 'required|string|max:255',
            'transaction_reference' => 'required|string|max:255',
            'payment_date' => 'required|date',
            'bank_slip' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'customer_name' => 'required|string|max:255',
            'additional_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $order = Order::findOrFail($request->order_id);

        if ($order->status !== 'pending') {
            return back()->with('error', 'This order cannot accept payments.');
        }

        // Upload bank slip
        $bankSlipPath = $request->file('bank_slip')->store('bank_slips', 'public');

        // Create payment
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'currency' => $order->currency,
            'payment_method' => $order->payment_method,
            'bank_name' => $request->bank_name,
            'transaction_reference' => $request->transaction_reference,
            'payment_date' => $request->payment_date,
            'status' => 'pending',
        ]);

        // Create payment verification
        $verification = PaymentVerification::create([
            'payment_id' => $payment->id,
            'bank_slip_path' => $bankSlipPath,
            'customer_name' => $request->customer_name,
            'transaction_reference' => $request->transaction_reference,
            'payment_date' => $request->payment_date,
            'bank_name' => $request->bank_name,
            'additional_notes' => $request->additional_notes,
            'status' => 'pending',
        ]);

        // Send notifications
        $this->notificationService->sendPaymentVerificationConfirmation($order);
        $this->notificationService->sendAdminNewVerificationNotification($verification);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Payment details submitted successfully! Your payment is now pending verification.');
    }

    public function verificationStatus(Order $order)
    {
        $payment = $order->payments()->first();
        $verification = $payment ? $payment->verification : null;

        return view('payments.status', compact('order', 'payment', 'verification'));
    }
}
