@extends('layouts.app')

@section('hero-title', 'Verify Your Payment')
@section('hero-subtitle', 'Submit your transaction details to activate your hosting plan.')

@section('styles')
<style>
    .verify-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .verify-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 4rem;
        box-shadow: var(--shadow-soft);
    }

    .form-group {
        margin-bottom: 2.5rem;
    }

    .form-label {
        display: block;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: var(--text-main);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control {
        width: 100%;
        padding: 1.25rem 1.5rem;
        border: 2px solid var(--border);
        border-radius: 12px;
        font-size: 1rem;
        font-family: inherit;
        transition: var(--transition);
        background: var(--bg-gray);
    }

    .form-control:focus {
        border-color: var(--primary);
        background: white;
        outline: none;
    }

    .upload-area {
        border: 2px dashed var(--border);
        border-radius: 16px;
        padding: 3rem;
        text-align: center;
        transition: var(--transition);
        cursor: pointer;
        background: var(--bg-gray);
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.02);
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .method-badge {
        display: inline-block;
        padding: 0.5rem 1.25rem;
        background: var(--primary-gradient);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        margin-bottom: 1rem;
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
    <div class="step completed">
        <div class="step-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="step-label">Payment</div>
    </div>
    <div class="step active">
        <div class="step-icon">5</div>
        <div class="step-label">Verify</div>
    </div>
</div>

<div class="verify-container">
    <div class="verify-card">
        <form action="{{ route('orders.submit', ['order' => $order->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="text-align: center; margin-bottom: 3rem;">
                <div class="method-badge">{{ $order->payment_method }}</div>
                <h2 style="font-weight: 800; font-size: 1.75rem;">Confirm Transaction</h2>
            </div>

            <div class="form-group">
                <label class="form-label" for="transaction_reference">Transaction ID / Reference</label>
                <input type="text" name="transaction_reference" id="transaction_reference" class="form-control" placeholder="Enter your transaction reference number" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="payment_date">Date of Payment</label>
                <input type="date" name="payment_date" id="payment_date" class="form-control" required value="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Proof of Payment</label>
                <div class="upload-area" onclick="document.getElementById('bank_slip').click()">
                    <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <div style="font-weight: 700; color: var(--text-main);">Click to upload screenshot</div>
                    <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 0.5rem;">PNG, JPG up to 10MB</div>
                    <input type="file" name="bank_slip" id="bank_slip" style="display: none;" accept="image/*">
                </div>
            </div>

            <div style="margin-top: 4rem; display: flex; gap: 1.5rem;">
                <a href="{{ route('orders.step4', ['order' => $order->id]) }}" class="btn btn-secondary" style="width: auto; padding: 1.25rem 2.5rem;">Back</a>
                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 1.25rem;">
                    Submit Verification
                </button>
            </div>
        </form>
    </div>
</div>

@endsection


@endsection
