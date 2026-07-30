@extends('layouts.yegara')

@section('title', 'Hosting Packages - Afronexhost')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8 flex justify-start">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Home
        </a>
    </div>
    <!-- Hero Section -->
    <div class="text-center mb-16 max-w-4xl mx-auto bg-white/5 backdrop-blur-md rounded-3xl p-8 md:p-12 border border-white/10 shadow-2xl">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight text-white drop-shadow-sm" data-i18n="choose-package">Choose Your Package</h1>
        <p class="text-xl text-gray-300 font-light max-w-3xl mx-auto leading-relaxed" data-i18n="choose-package-sub">Select the perfect hosting or domain package tailored to your needs. Our solutions are designed to help you succeed online.</p>
    </div>

    <!-- Dynamic Packages from Database -->
    @foreach($packages as $type => $typePackages)
    @php
        $typeLabels = [
            'hosting' => ['title' => 'Hosting Packages', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
            'domain' => ['title' => 'Domain Packages', 'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9'],
            'services' => ['title' => 'Organizational Services', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ];
        $label = $typeLabels[$type] ?? ['title' => ucfirst($type), 'icon' => ''];
    @endphp
    <section class="mb-16">
        <div class="flex items-center justify-center gap-3 mb-8">
            @if($label['icon'])
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $label['icon'] }}"/>
            </svg>
            @endif
            <h2 class="text-3xl font-bold text-gray-900 text-center">{{ $label['title'] }}</h2>
        </div>

        @if($type === 'services')
            @foreach($typePackages as $provider => $providerPackages)
            <div class="mb-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 pl-2 border-l-4 border-green-500">{{ $provider }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($providerPackages as $package)
                    @include('packages._service_card', ['package' => $package])
                    @endforeach
                </div>
            </div>
            @endforeach
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($typePackages as $package)
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 flex flex-col">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $package->name }}</h3>
                    @if($loop->first)
                    <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">Popular</span>
                    @endif
                </div>
                @if($package->description)
                <p class="text-gray-500 text-sm mb-4">{{ $package->description }}</p>
                @endif
                <div class="text-4xl font-bold text-blue-600 mb-6">
                    {{ number_format($package->price) }} {{ $package->currency }}
                    @if($type === 'hosting')<span class="text-lg text-gray-500">/month</span>@endif
                </div>
                @if(is_array($package->features) && count($package->features))
                <ul class="text-gray-600 mb-8 space-y-3 flex-grow">
                    @foreach($package->features as $feature)
                    @if(is_string($feature))
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $feature }}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @endif
                <button onclick="handlePackageSelection({{ $package->id }})" class="w-full bg-blue-600 text-white text-center py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-lg mt-auto">
                    Select {{ $package->name }}
                </button>
            </div>
            @endforeach
        </div>
        @endif
    </section>
    @endforeach

    <!-- Features Section -->
    <section class="bg-gray-50 rounded-2xl p-12 mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6" data-i18n="why-choose">Why Choose Afronex Host?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-i18n="why-choose-sub">We provide reliable hosting solutions with unmatched features and support</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l-2-2H5a2 2 0 01-2 2v-4a2 2 0 012-2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3" data-i18n="lightning-fast">Lightning Fast</h3>
                <p class="text-gray-600" data-i18n="lightning-fast-desc">NVMe storage with 3x faster speeds than traditional SSD</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3" data-i18n="secure-reliable">Secure & Reliable</h3>
                <p class="text-gray-600" data-i18n="secure-reliable-desc">SSL certificates and secure payment processing</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656 3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3" data-i18n="support-247">24/7 Support</h3>
                <p class="text-gray-600" data-i18n="support-247-desc">Round-the-clock customer support via Telegram and email</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg text-white py-16 rounded-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl mb-8">Join thousands of satisfied customers who trust Afronex Host</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('orders.yegara-flow') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
                    Get Started Now
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:text-blue-600 transition-colors font-semibold text-lg">
                    Contact Sales
                </a>
            </div>
        </div>
    </section>
</div>

<!-- Auth Modal -->
<div id="authModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[95vh] flex flex-col overflow-hidden transform transition-all">
        <!-- Close Button -->
        <button onclick="closeAuthModal()" class="absolute top-3 right-3 text-gray-400 hover:text-white z-10 bg-black/20 hover:bg-black/40 rounded-full p-1 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-4 py-3 text-white text-center shrink-0">
            <h3 class="text-base font-bold">User Account Dashboard</h3>
            <p class="text-blue-100 text-xs">Register or log in to secure your hosting package</p>
        </div>

        <div class="flex border-b border-gray-200 bg-gray-50 shrink-0">
            <button id="tab-register" onclick="switchTab('register')" class="flex-1 py-3 text-center font-semibold text-sm text-blue-600 border-b-2 border-blue-600 focus:outline-none">Register</button>
            <button id="tab-login" onclick="switchTab('login')" class="flex-1 py-3 text-center font-semibold text-sm text-gray-500 hover:text-gray-700 focus:outline-none">Login</button>
        </div>

        <div class="p-4 md:p-5 overflow-y-auto">
            <div id="authAlert" class="hidden mb-3 p-2.5 rounded text-sm font-medium"></div>
            
            <!-- Login Form -->
            <form id="loginForm" class="space-y-3 hidden" onsubmit="submitAuth(event, 'login')">
                @csrf
                <div id="loginCredentials">
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="loginEmail" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="loginPassword" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                    </div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Sign In
                    </button>
                </div>
                <div id="loginOtpSection" class="hidden">
                    <div class="text-center mb-3">
                        <p class="text-sm text-gray-600">Enter the OTP sent to <strong id="loginOtpPhone"></strong></p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700">OTP Code</label>
                        <input type="text" name="login_otp" id="loginOtp" maxlength="6" inputmode="numeric" class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-center text-lg tracking-widest" placeholder="000000">
                    </div>
                    <button type="button" id="loginOtpVerifyBtn" onclick="submitLoginOtp()" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Verify & Sign In
                    </button>
                    <button type="button" onclick="cancelLoginOtp()" class="w-full text-center text-xs text-gray-500 hover:text-gray-700 mt-1.5 font-semibold underline">Back</button>
                </div>
            </form>

            <!-- Register Form -->
            <form id="registerForm" class="space-y-2.5" onsubmit="submitAuth(event, 'register')">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700">Phone (10 digits starting with 09)</label>
                    <div class="mt-0.5 flex gap-2">
                        <input type="text" name="phone" id="regPhone" required maxlength="10" placeholder="e.g. 0911234567" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                        <button type="button" id="sendOtpBtn" onclick="sendOtp()" class="shrink-0 px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-xs font-semibold disabled:opacity-50">Send OTP</button>
                    </div>
                    <p id="otpStatus" class="text-xs mt-0.5 hidden"></p>
                </div>
                <div id="otpSection" class="hidden">
                    <label class="block text-xs font-medium text-gray-700">OTP Code</label>
                    <div class="mt-0.5 flex gap-2">
                        <input type="text" name="otp" id="regOtp" maxlength="6" placeholder="6-digit code" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                        <button type="button" id="verifyOtpBtn" onclick="verifyOtp()" class="shrink-0 px-3 py-1.5 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs font-semibold disabled:opacity-50">Verify</button>
                    </div>
                    <p id="otpVerifyStatus" class="text-xs mt-0.5 hidden"></p>
                </div>
                <input type="hidden" name="phone_verified" id="phoneVerified" value="0">
                <div>
                    <label class="block text-xs font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="mt-0.5 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-1.5 border text-sm">
                </div>
                <button type="submit" id="registerSubmitBtn" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                    Create Account
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Hidden Form for Checkout -->
<form id="checkoutForm" action="{{ route('orders.step2') }}" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="package_id" id="checkoutPackageId">
</form>

<script>
    const isAuth = {{ auth()->check() ? 'true' : 'false' }};
    let selectedPackageId = null;

    function handlePackageSelection(packageId) {
        selectedPackageId = packageId;
        if (isAuth) {
            proceedToCheckout();
        } else {
            window.location.href = '{{ route("login") }}';
        }
    }

    function proceedToCheckout() {
        window.location.href = `{{ route('orders.yegara-flow') }}?step=2&package_id=${selectedPackageId}`;
    }

    function proceedToDashboard() {
        window.location.href = `{{ route('customer.dashboard') }}?package_id=${selectedPackageId}`;
    }

    function openAuthModal() {
        document.getElementById('authModal').classList.remove('hidden');
        switchTab('register');
    }

    function closeAuthModal() {
        document.getElementById('authModal').classList.add('hidden');
        selectedPackageId = null;
    }

    function switchTab(tab) {
        if (tab === 'login') {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('tab-login').className = "flex-1 py-4 text-center font-semibold text-blue-600 border-b-2 border-blue-600 focus:outline-none";
            document.getElementById('tab-register').className = "flex-1 py-4 text-center font-semibold text-gray-500 hover:text-gray-700 focus:outline-none";
        } else {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('tab-register').className = "flex-1 py-4 text-center font-semibold text-blue-600 border-b-2 border-blue-600 focus:outline-none";
            document.getElementById('tab-login').className = "flex-1 py-4 text-center font-semibold text-gray-500 hover:text-gray-700 focus:outline-none";
        }
        document.getElementById('authAlert').classList.add('hidden');
    }

    async function submitAuth(event, type) {
        event.preventDefault();
        if (type === 'register' && document.getElementById('phoneVerified').value !== '1') {
            const alertEl = document.getElementById('authAlert');
            alertEl.classList.remove('hidden');
            alertEl.className = 'p-4 rounded-lg mb-6 bg-red-50 text-red-700 border border-red-200';
            alertEl.textContent = 'Please verify your phone number via OTP first.';
            return;
        }
        const form = event.target;
        const formData = new FormData(form);
        const url = type === 'login' ? '{{ route("ajax.login") }}' : '{{ route("ajax.register") }}';
        
        const alertEl = document.getElementById('authAlert');
        alertEl.classList.add('hidden');
        alertEl.className = 'p-4 rounded-lg mb-6 hidden';
        
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (type === 'register') {
                    switchTab('login');
                    alertEl.classList.remove('hidden');
                    alertEl.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
                    alertEl.textContent = 'Registration successful! Please log in to continue.';
                    form.reset();
                    document.getElementById('phoneVerified').value = '0';
                    document.getElementById('otpSection').classList.add('hidden');
                    document.getElementById('otpStatus').classList.add('hidden');
                    document.getElementById('sendOtpBtn').disabled = false;
                } else if (data.otp_required) {
                    // Show OTP step for login
                    document.getElementById('loginCredentials').classList.add('hidden');
                    document.getElementById('loginOtpSection').classList.remove('hidden');
                    document.getElementById('loginOtpPhone').textContent = data.phone_masked;
                    document.getElementById('loginOtp').value = '';
                    document.getElementById('loginOtp').focus();
                    if (data.otp) {
                        const alertEl = document.getElementById('authAlert');
                        alertEl.classList.remove('hidden');
                        alertEl.className = 'p-4 rounded-lg mb-6 bg-yellow-50 text-yellow-800 border border-yellow-200';
                        alertEl.innerHTML = 'DEV MODE — OTP: <strong>' + data.otp + '</strong>';
                    }
                } else {
                    proceedToCheckout();
                }
            } else {
                alertEl.classList.remove('hidden');
                alertEl.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
                if (data.errors) {
                    alertEl.innerHTML = Object.values(data.errors).map(err => `<div>${err}</div>`).join('');
                } else if (data.message) {
                    alertEl.textContent = data.message;
                }
            }
        } catch (error) {
            console.error(error);
        }
    }

    async function submitLoginOtp() {
        const otp = document.getElementById('loginOtp').value.trim();
        const alertEl = document.getElementById('authAlert');
        alertEl.classList.add('hidden');
        alertEl.className = 'p-4 rounded-lg mb-6 hidden';

        if (!otp || otp.length !== 6) {
            alertEl.classList.remove('hidden');
            alertEl.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
            alertEl.textContent = 'Please enter the 6-digit OTP.';
            return;
        }

        const btn = document.getElementById('loginOtpVerifyBtn');
        btn.disabled = true;
        btn.textContent = 'Verifying...';

        const formData = new FormData();
        formData.append('otp', otp);
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const res = await fetch('{{ route("ajax.login.otp") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();

            if (data.success) {
                proceedToCheckout();
            } else {
                alertEl.classList.remove('hidden');
                alertEl.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
                if (data.errors) {
                    alertEl.innerHTML = Object.values(data.errors).flat().join(' ');
                } else if (data.message) {
                    alertEl.textContent = data.message;
                }
                btn.disabled = false;
                btn.textContent = 'Verify & Sign In';
            }
        } catch (e) {
            alertEl.classList.remove('hidden');
            alertEl.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
            alertEl.textContent = 'Network error. Please try again.';
            btn.disabled = false;
            btn.textContent = 'Verify & Sign In';
        }
    }

    function cancelLoginOtp() {
        document.getElementById('loginCredentials').classList.remove('hidden');
        document.getElementById('loginOtpSection').classList.add('hidden');
        document.getElementById('loginOtp').value = '';
    }

    let otpCooldown = false;

    async function sendOtp() {
        const phone = document.getElementById('regPhone').value.trim();
        if (!phone || phone.length !== 10 || !/^09\d{8}$/.test(phone)) {
            const status = document.getElementById('otpStatus');
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Please enter a valid 10-digit phone number starting with 09.';
            status.classList.remove('hidden');
            return;
        }

        if (otpCooldown) return;

        const btn = document.getElementById('sendOtpBtn');
        btn.disabled = true;
        btn.textContent = 'Sending...';
        const status = document.getElementById('otpStatus');
        status.className = 'text-xs mt-1 hidden';

        const formData = new FormData();
        formData.append('phone', phone);
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const res = await fetch('{{ route("otp.send") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();

            if (data.success) {
                status.className = 'text-xs mt-1 text-green-600';
                status.textContent = data.otp ? 'OTP: ' + data.otp + ' (dev mode)' : 'OTP sent!';
                status.classList.remove('hidden');
                document.getElementById('otpSection').classList.remove('hidden');
                otpCooldown = true;
                let countdown = 30;
                btn.textContent = `Resend (${countdown}s)`;
                const timer = setInterval(() => {
                    countdown--;
                    if (countdown <= 0) {
                        clearInterval(timer);
                        btn.disabled = false;
                        btn.textContent = 'Send OTP';
                        otpCooldown = false;
                    } else {
                        btn.textContent = `Resend (${countdown}s)`;
                    }
                }, 1000);
            } else {
                status.className = 'text-xs mt-1 text-red-600';
                if (data.errors) {
                    status.textContent = Object.values(data.errors).flat().join(' ');
                } else {
                    status.textContent = 'Failed to send OTP.';
                }
                status.classList.remove('hidden');
                btn.disabled = false;
                btn.textContent = 'Send OTP';
            }
        } catch (e) {
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Network error. Please try again.';
            status.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Send OTP';
        }
    }

    async function verifyOtp() {
        const phone = document.getElementById('regPhone').value.trim();
        const otp = document.getElementById('regOtp').value.trim();
        const status = document.getElementById('otpVerifyStatus');

        if (!otp || otp.length !== 6) {
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Please enter the 6-digit OTP.';
            status.classList.remove('hidden');
            return;
        }

        const btn = document.getElementById('verifyOtpBtn');
        btn.disabled = true;
        btn.textContent = 'Verifying...';
        status.className = 'text-xs mt-1 hidden';

        const formData = new FormData();
        formData.append('phone', phone);
        formData.append('otp', otp);
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const res = await fetch('{{ route("otp.verify") }}', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();

            if (data.success) {
                status.className = 'text-xs mt-1 text-green-600';
                status.textContent = 'Phone verified successfully!';
                status.classList.remove('hidden');
                document.getElementById('phoneVerified').value = '1';
                document.getElementById('regOtp').disabled = true;
                document.getElementById('regPhone').disabled = true;
                document.getElementById('sendOtpBtn').disabled = true;
                btn.textContent = 'Verified';
                btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                btn.classList.add('bg-green-800', 'cursor-default');
            } else {
                status.className = 'text-xs mt-1 text-red-600';
                if (data.errors) {
                    status.textContent = Object.values(data.errors).flat().join(' ');
                } else {
                    status.textContent = 'Invalid OTP. Please try again.';
                }
                status.classList.remove('hidden');
                btn.disabled = false;
                btn.textContent = 'Verify';
            }
        } catch (e) {
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Network error. Please try again.';
            status.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Verify';
        }
    }
</script>
@endsection
