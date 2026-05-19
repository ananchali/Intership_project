@extends('layouts.app')

@section('hero-title', 'Make Payment')
@section('hero-subtitle', 'Please complete the transfer to the account details below.')

@section('styles')
<style>
    .payment-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .amount-display {
        text-align: center;
        margin-bottom: 4rem;
        background: var(--bg-gray);
        padding: 3rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
    }

    .amount-value {
        font-size: 4rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .bank-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 4rem;
        box-shadow: var(--shadow-soft);
        text-align: center;
        position: relative;
    }

    .bank-badge {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--primary-gradient);
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    }

    .account-number {
        font-size: 2.5rem;
        font-family: 'Poppins', monospace;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: 2px;
        margin: 2rem 0;
        padding: 1.5rem;
        background: var(--bg-gray);
        border-radius: 12px;
        display: inline-block;
    }

    .account-name {
        font-size: 1.25rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .payment-instructions {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
        font-size: 0.95rem;
        color: var(--text-muted);
        line-height: 1.8;
    }

    .payment-actions {
        margin-top: 4rem;
        display: flex;
        gap: 1.5rem;
    }
</style>
@endsection

@section('content')

<div class="stepper">
    <div class="step completed">
        <div class="step-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="step-label">Select Package</div>
    </div>
    <div class="step completed">
        <div class="step-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="step-label">Domain</div>
    </div>
    <div class="step completed">
        <div class="step-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="step-label">Checkout</div>
    </div>
    <div class="step active">
        <div class="step-icon">4</div>
        <div class="step-label">Payment</div>
    </div>
    <div class="step">
        <div class="step-icon">5</div>
        <div class="step-label">Verify</div>
    </div>
</div>

<div class="payment-container">
    <div class="amount-display">
        <div class="amount-value">${{ number_format($order->total_amount, 2) }}</div>
        <p style="font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em;">Total Amount Payable</p>
    </div>

    <div class="bank-card">
        @if($paymentMethod)
            <div class="bank-badge">{{ $paymentMethod->name }}</div>
            <div class="account-number">{{ $paymentMethod->account_number }}</div>
            <div class="account-name">Account Name: <span style="color: var(--text-main);">{{ $paymentMethod->account_name }}</span></div>
            
            @if($paymentMethod->instructions)
            <div class="payment-instructions">
                <strong>Instructions:</strong><br>
                {{ $paymentMethod->instructions }}
            </div>
            @endif
        @else
            <div class="bank-badge">{{ $order->payment_method }}</div>
            <p style="margin: 3rem 0; color: var(--text-muted); font-size: 1.1rem;">
                No automated payment details found for this method.<br>
                Please contact our 24/7 support for payment assistance.
            </p>
        @endif
    </div>

    <div class="payment-actions">
        <a href="{{ route('orders.step3') }}" class="btn btn-secondary" style="width: auto; padding: 1.25rem 3rem;">Back</a>
        <a href="{{ route('orders.step5', ['order' => $order->id]) }}" class="btn btn-primary" style="flex: 1; padding: 1.25rem;">
            I Have Completed The Payment
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-left: 10px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>
</div>

@endsection
