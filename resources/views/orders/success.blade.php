@extends('layouts.app')

@section('content')

<div class="card" style="max-width: 600px; margin: 4rem auto; text-align: center; padding: 4rem 2rem;">
    
    <div style="width: 80px; height: 80px; background: #ECFDF5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-4">Order Placed Successfully!</h1>
    <p class="text-lg text-gray-600 mb-2">Thank you for choosing Afronex Hosting!</p>

    <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 2rem;">
        Thank you! We have received your payment verification details. Your account will be activated within 10 Minutes once the payment is verified.
    </p>

    <div style="background: #F9FAFB; border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 2rem;">
        <p style="margin-bottom: 0;"><strong>Need Help?</strong></p>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Contact us at <a href="mailto:support@afronexhosting.com" style="color: var(--primary);">support@afronexhosting.com</a> or call us at +251911234567.</p>
    </div>

    <div>
        <a href="/" class="btn btn-primary" style="width: auto;">Return to Home</a>
    </div>

</div>

@endsection
