@extends('layouts.app')

@section('styles')
<style>
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .package-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .pkg-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .pkg-desc {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        min-height: 40px;
    }

    .pkg-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .pkg-price span {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    .pkg-features {
        list-style: none;
        margin-bottom: 2rem;
        text-align: left;
        flex-grow: 1;
    }

    .pkg-features li {
        padding: 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    .pkg-features li svg {
        color: #10B981;
        flex-shrink: 0;
    }

    .btn-plan {
        padding: 0.75rem 1.5rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
        font-family: inherit;
    }

    .btn-plan:hover {
        background: var(--primary-hover);
    }
</style>
@endsection

@section('content')

<h1 class="page-title">Choose Your Hosting Plan</h1>
<p class="page-subtitle">Select the perfect plan for your website needs.</p>

<div class="stepper">
    <div class="step active">
        <div class="step-number">1</div>
        <div class="step-label">Select Package</div>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">2</div>
        <div class="step-label">Domain</div>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">3</div>
        <div class="step-label">Checkout</div>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">4</div>
        <div class="step-label">Payment</div>
    </div>
    <div class="step-divider"></div>
    <div class="step">
        <div class="step-number">5</div>
        <div class="step-label">Verify</div>
    </div>
</div>

@if($errors->any())
    <div style="background: #FEF2F2; color: #DC2626; padding: 1rem; border-radius: var(--radius); margin-bottom: 2rem; font-weight: 500; text-align: center; border: 1px solid #FECACA;">
        {{ $errors->first() }}
    </div>
@endif

<div class="packages-grid">
    @foreach($packages as $package)
    <div class="package-card">
        <h2 class="pkg-name">{{ $package->name }}</h2>
        <p class="pkg-desc">{{ $package->description }}</p>
        <div class="pkg-price">${{ number_format($package->price, 2) }} <span>/mo</span></div>
        
        <ul class="pkg-features">
            @if(is_array($package->features))
                @foreach($package->features as $feature)
                    <li>
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        {{ $feature }}
                    </li>
                @endforeach
            @endif
        </ul>
        
        <form action="{{ route('orders.step2') }}" method="POST">
            @csrf
            <input type="hidden" name="package_id" value="{{ $package->id }}">
            <button type="submit" class="btn-plan">Order Now</button>
        </form>
    </div>
    @endforeach
</div>

@endsection
