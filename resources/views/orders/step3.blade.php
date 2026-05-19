@extends('layouts.app')

@section('hero-title', 'Checkout')
@section('hero-subtitle', 'Review your order and provide your billing information.')

@section('styles')
<style>
    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    .billing-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 3rem;
        box-shadow: var(--shadow-soft);
    }

    .summary-card {
        background: #0f172a;
        color: white;
        border-radius: var(--radius-lg);
        padding: 2.5rem;
        position: sticky;
        top: 120px;
        box-shadow: var(--shadow-lg);
    }

    .form-group {
        margin-bottom: 2rem;
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

    .summary-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 1rem;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.25rem;
        font-size: 0.95rem;
        color: #94a3b8;
    }

    .summary-item strong {
        color: white;
    }

    .summary-total {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px dashed rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-amount {
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent);
    }

    .coupon-group {
        display: flex;
        gap: 0.75rem;
        margin-top: 2rem;
    }

    .coupon-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        color: white;
        flex: 1;
        font-family: inherit;
    }

    .btn-coupon {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: none;
        padding: 0 1.25rem;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .payment-radio {
        display: none;
    }

    .payment-label {
        border: 2px solid var(--border);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: var(--bg-gray);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .payment-radio:checked + .payment-label {
        border-color: var(--primary);
        background: white;
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
        color: var(--primary);
    }

    @media (max-width: 992px) {
        .checkout-grid { grid-template-columns: 1fr; }
        .summary-card { position: static; margin-top: 2rem; }
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
    <div class="step active">
        <div class="step-icon">3</div>
        <div class="step-label">Checkout</div>
    </div>
    <div class="step">
        <div class="step-icon">4</div>
        <div class="step-label">Payment</div>
    </div>
    <div class="step">
        <div class="step-icon">5</div>
        <div class="step-label">Verify</div>
    </div>
</div>

<form action="{{ route('orders.placeOrder') }}" method="POST">
    @csrf
    <input type="hidden" name="package_id" value="{{ $package->id }}">
    <input type="hidden" name="domain_name" value="{{ $domainData['domain_name'] }}">
    <input type="hidden" name="domain_type" value="{{ $domainData['domain_type'] }}">

    <div class="checkout-grid">
        <div class="billing-card">
            <h2 style="font-weight: 800; margin-bottom: 2.5rem; font-size: 1.75rem;">Billing Information</h2>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user?->name) }}" placeholder="John Doe" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user?->phone) }}" maxlength="10" placeholder="0911223344" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user?->email) }}" placeholder="john@example.com" required>
            </div>

            <h2 style="font-weight: 800; margin: 3rem 0 1.5rem; font-size: 1.75rem;">Select Payment Method</h2>
            <div class="payment-grid">
                @foreach($paymentMethods as $method)
                <div>
                    <input type="radio" name="payment_method" id="pay_{{ $method->id }}" value="{{ $method->name }}" class="payment-radio" required>
                    <label for="pay_{{ $method->id }}" class="payment-label">
                        {{ $method->name }}
                    </label>
                </div>
                @endforeach
            </div>

            <div style="margin-top: 4rem; display: flex; gap: 1.5rem;">
                <a href="{{ route('orders.step2') }}" class="btn btn-secondary" style="width: auto; padding: 1rem 2.5rem;">Back</a>
                <button type="submit" class="btn btn-primary" style="flex: 1;">Complete Order & Pay</button>
            </div>
        </div>

        <div class="summary-card">
            <h2 class="summary-title">Order Summary</h2>
            
            <div class="summary-item">
                <span>Plan</span>
                <strong>{{ $package->name }}</strong>
            </div>
            <div class="summary-item">
                <span>Domain</span>
                <strong>{{ $domainData['domain_name'] }}</strong>
            </div>
            <div class="summary-item">
                <span>Setup Fee</span>
                <strong>Free</strong>
            </div>
            
            <div class="coupon-group">
                <input type="text" class="coupon-input" placeholder="Coupon Code">
                <button type="button" class="btn-coupon">Apply</button>
            </div>

            <div class="summary-total">
                <div style="color: #94a3b8; font-weight: 600;">Total Amount</div>
                <div class="total-amount">${{ number_format($package->price, 2) }}</div>
            </div>
            
            <p style="color: #64748b; font-size: 0.8rem; margin-top: 1.5rem; line-height: 1.4;">
                * Recurring amount will be billed annually. Prices are inclusive of all taxes.
            </p>
        </div>
    </div>
</form>

@endsection
