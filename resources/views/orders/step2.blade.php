@extends('layouts.app')

@section('hero-title', 'Choose Your Domain')
@section('hero-subtitle', 'Every great website starts with a memorable domain name.')

@section('styles')
<style>
    .domain-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .domain-option {
        background: white;
        border: 2px solid var(--border);
        border-radius: var(--radius-md);
        padding: 2.5rem 2rem;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .domain-option:hover {
        border-color: var(--primary);
        transform: translateY(-5px);
        box-shadow: var(--shadow-soft);
    }

    .domain-option.selected {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.02);
        box-shadow: 0 0 0 1px var(--primary);
    }

    .domain-option.selected::before {
        content: '✓';
        position: absolute;
        top: 15px;
        right: 15px;
        width: 24px;
        height: 24px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 800;
    }

    .option-icon {
        width: 48px;
        height: 48px;
        background: var(--bg-gray);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--primary);
        transition: var(--transition);
    }

    .domain-option:hover .option-icon, .domain-option.selected .option-icon {
        background: var(--primary-gradient);
        color: white;
    }

    .option-title {
        font-weight: 800;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: var(--text-main);
    }

    .option-desc {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .package-summary {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4rem;
        box-shadow: var(--shadow-soft);
    }

    .domain-input-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 4rem;
        box-shadow: var(--shadow-soft);
        display: none;
        animation: slideUp 0.4s ease forwards;
    }

    .domain-input-card.active {
        display: block;
    }

    .input-wrapper {
        display: flex;
        max-width: 700px;
        margin: 2rem auto 0;
        gap: 1rem;
    }

    .domain-control {
        flex: 1;
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        border: 2px solid var(--border);
        font-size: 1.1rem;
        font-family: inherit;
        transition: var(--transition);
        outline: none;
    }

    .domain-control:focus {
        border-color: var(--primary);
    }

    .btn-submit {
        padding: 0 2.5rem;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-submit:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    }
</style>
@endsection

@section('content')

<div class="back-to-step1-wrapper" style="margin-bottom: 2rem; display: flex; justify-content: flex-start; width: 100%;">
    <a href="{{ route('orders.step1') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: rgba(255, 255, 255, 0.9); border: 1px solid var(--border); border-radius: 12px; font-weight: 700; color: var(--text-main); text-decoration: none; box-shadow: var(--shadow); transition: all 0.2s;">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke-width: 2.5;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Packages
    </a>
</div>

<div class="stepper">
    <div class="step completed">
        <div class="step-icon">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div class="step-label">Select Package</div>
    </div>
    <div class="step active">
        <div class="step-icon">2</div>
        <div class="step-label">Domain</div>
    </div>
    <div class="step">
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

<div class="package-summary">
    <div>
        <span style="color: var(--text-muted); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.05em;">Selected Plan:</span>
        <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main);">{{ $package->name }} — ${{ number_format($package->price, 2) }}/mo</h3>
    </div>
    <a href="{{ route('orders.step1') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
        Change Plan
    </a>
</div>

<div class="domain-options">
    <div class="domain-option" onclick="selectOption('register', this)">
        <div class="option-icon">
            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
        </div>
        <div class="option-title">Register New</div>
        <div class="option-desc">I want to register a brand new domain name.</div>
    </div>
    <div class="domain-option" onclick="selectOption('transfer', this)">
        <div class="option-icon">
            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        </div>
        <div class="option-title">Transfer Domain</div>
        <div class="option-desc">Transfer your existing domain from another registrar.</div>
    </div>
    <div class="domain-option" onclick="selectOption('own', this)">
        <div class="option-icon">
            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="option-title">I'll use my own</div>
        <div class="option-desc">I will update my nameservers on an existing domain.</div>
    </div>
</div>

<div style="margin-bottom: 2rem;">
    <a href="{{ route('orders.step1') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2rem; background: white; color: var(--text-main); border: 2px solid var(--border); border-radius: 12px; font-weight: 700; text-decoration: none; transition: var(--transition);">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Packages
    </a>
</div>

<div class="domain-input-card" id="domainInputContainer">
    <h2 style="text-align: center; font-weight: 800; font-size: 1.75rem;">Enter your domain name</h2>
    <p style="text-align: center; color: var(--text-muted);">Please provide the domain you wish to use with this plan.</p>
    
    <form action="{{ route('orders.step3') }}" method="POST" id="domainForm">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <input type="hidden" name="domain_type" id="domain_type" value="">
        
        <div class="input-wrapper">
            <input type="text" name="domain_name" id="domain_name" class="domain-control" placeholder="e.g. mysite.com" required>
            <button type="submit" class="btn-submit">Continue</button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    function selectOption(type, element) {
        document.querySelectorAll('.domain-option').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        
        document.getElementById('domain_type').value = type;
        document.getElementById('domainInputContainer').classList.add('active');
        document.getElementById('domain_name').focus();
        
        // Smooth scroll to input
        document.getElementById('domainInputContainer').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
</script>
@endsection
