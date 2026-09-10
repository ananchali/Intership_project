<?php

@extends('layouts.app')

@section('styles')
<style>
    .verify-card {
        max-width: 600px;
        margin: 3rem auto;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border-radius: var(--radius);
        border: 1px solid rgba(255,255,255,0.2);
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        color: var(--text-main);
    }
    .verify-card h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        margin-bottom: 1rem;
        text-align: center;
        color: var(--primary);
    }
    .verify-card input,
    .verify-card textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: var(--radius);
        background: rgba(255,255,255,0.05);
        color: var(--text-main);
        font-family: inherit;
    }
    .verify-card input::placeholder,
    .verify-card textarea::placeholder {
        color: var(--text-muted);
    }
    .verify-card button {
        width: 100%;
        padding: 0.85rem;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: var(--radius);
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .verify-card button:hover {
        background: var(--primary-hover);
    }
</style>
@endsection

@section('content')
@if(session('success'))
<div class="verify-card" style="border-left: 4px solid #10b981; background: rgba(16, 185, 129, 0.1);">
    <div style="text-align: center; padding: 2rem 0;">
        <svg style="width: 64px; height: 64px; color: #10b981; margin-bottom: 1.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 1.75rem; margin-bottom: 1rem; color: #065f46;">Payment Verification Submitted!</h2>
        <p style="color: var(--text-main); font-size: 1rem; line-height: 1.6; max-width: 480px; margin: 0 auto 2rem;">
            Your payment details have been submitted successfully. Our admin team will review and approve your payment shortly. You will receive a confirmation once it is approved.
        </p>
        <div style="text-align: center;">
            <a href="{{ route('customer.dashboard') }}" class="btn btn-primary" style="padding: 1rem 2rem; text-decoration: none; display: inline-block;">Go to Dashboard</a>
        </div>
    </div>
</div>
@else
<div class="verify-card">
    <h2>Payment Verification</h2>
    <p class="text-center" style="margin-bottom:1.5rem; color: var(--text-muted);">
        Please submit your transaction details or upload your bank slip to verify your payment for order #{{ $order->id }}.
    </p>

    @if($errors->any())
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; border-radius: var(--radius); padding: 1rem; margin-bottom: 1.5rem;">
        <ul style="margin: 0; padding-left: 1.25rem; color: #ef4444; font-size: 0.9rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('orders.submit', ['order' => $order->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Payment Amount</label>
            <input type="number" step="0.01" name="amount" placeholder="Enter the amount you paid" value="{{ old('amount', $order->total_amount) }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Bank Name</label>
            <input type="text" name="bank_name" placeholder="e.g. Commercial Bank of Ethiopia" value="{{ old('bank_name') }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Account Name (Who paid?)</label>
            <input type="text" name="account_name" placeholder="Your full name" value="{{ old('account_name') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Transaction Reference / Number</label>
            <input type="text" name="transaction_number" placeholder="Reference code from your receipt" value="{{ old('transaction_number') }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Payment Date</label>
            <input type="date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Additional Notes</label>
            <textarea name="description" rows="3" placeholder="Any additional information...">{{ old('description') }}</textarea>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">Upload Bank Slip (Image or PDF)</label>
            <input type="file" name="bank_slip" accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <button type="submit">Submit Verification</button>
    </form>
</div>
@endif
@endsection
?>
