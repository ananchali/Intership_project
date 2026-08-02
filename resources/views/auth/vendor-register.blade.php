@extends('layouts.yegara')

@section('title', 'Register Your Business - Afronexhost')

@section('content')
<div class="min-h-screen flex items-stretch bg-gray-50">
    <div class="hidden lg:flex w-1/2 relative text-white overflow-hidden bg-black/40 backdrop-blur-md border-r border-white/5">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-15 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 p-16 flex flex-col justify-between w-full">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-3 group inline-flex">
                    <div class="w-12 h-12 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="text-2xl font-black text-white tracking-tight">AFRONEX<span class="text-blue-400">HOST</span></span>
                </a>
            </div>
            <div>
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-md">Sell Your <br>Services Here.</h1>
                <p class="text-xl text-blue-200 max-w-md font-light">Own a business? Register it once and start receiving and managing customer orders in one dashboard.</p>
            </div>
            <div class="text-blue-300 text-sm">
                &copy; {{ date('Y') }} Afronexhost. All rights reserved.
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10 animate-blob lg:hidden"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10 animate-blob animation-delay-2000 lg:hidden"></div>

        <div class="w-full max-w-md z-10">
            <div class="lg:hidden text-center mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="w-16 h-16 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center border-2 border-transparent group-hover:border-blue-100 transition-all">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                </a>
                <h2 class="text-2xl font-black text-gray-900 mt-4 tracking-tight">AFRONEX<span class="text-blue-600">HOST</span></h2>
            </div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-purple-500/10 text-blue-600 border border-blue-100 rounded-full text-xs font-black tracking-wide uppercase mb-4 shadow-sm animate-pulse">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Vendor Registration
                </div>
                <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight leading-snug">
                    Register Your Business
                </h3>
                <p class="text-sm text-gray-500 font-medium mt-2">Your business goes live after the platform admin approves it.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                    <ul class="list-disc pl-5 space-y-1 font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-blue-900/10 p-8 md:p-12 border border-white">
                <form id="vendorForm" action="{{ route('vendor.register.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="relative group">
                        <label for="v-business-name" class="block text-sm font-bold text-gray-700 mb-2">Business Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <input type="text" id="v-business-name" name="business_name" value="{{ old('business_name') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="e.g. Senaf Hotel">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="v-owner-name" class="block text-sm font-bold text-gray-700 mb-2">Owner Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" id="v-owner-name" name="owner_name" value="{{ old('owner_name') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="John Doe">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="v-owner-email" class="block text-sm font-bold text-gray-700 mb-2">Owner Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input type="email" id="v-owner-email" name="owner_email" value="{{ old('owner_email') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="v-owner-phone" class="block text-sm font-bold text-gray-700 mb-2">Owner Phone</label>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="text" id="v-owner-phone" name="owner_phone" value="{{ old('owner_phone') }}" required maxlength="10"
                                       class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                       placeholder="0911234567">
                            </div>
                            <button type="button" id="sendOtpBtn" onclick="sendRegOtp()" class="shrink-0 px-5 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm font-bold disabled:opacity-50 transition-all">Send OTP</button>
                        </div>
                        <p id="otpStatus" class="text-xs mt-1 hidden"></p>
                    </div>

                    <div id="otpSection" class="hidden">
                        <label for="v-otp" class="block text-sm font-bold text-gray-700 mb-2">OTP Code</label>
                        <div class="flex gap-2">
                            <input type="text" id="v-otp" maxlength="6" placeholder="Enter 6-digit OTP"
                                   class="flex-1 w-full px-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900 text-center text-xl tracking-widest">
                            <button type="button" id="verifyOtpBtn" onclick="verifyRegOtp()" class="shrink-0 px-5 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 text-sm font-bold disabled:opacity-50 transition-all">Verify</button>
                        </div>
                        <p id="otpVerifyStatus" class="text-xs mt-1 hidden"></p>
                        <input type="hidden" name="phone_verified" id="phoneVerified" value="0">
                    </div>

                    <div class="relative group">
                        <label for="v-password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="v-password" name="password" required
                                   class="w-full pl-11 pr-12 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword('v-password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="v-password-confirm" class="block text-sm font-bold text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="v-password-confirm" name="password_confirmation" required
                                   class="w-full pl-11 pr-12 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword('v-password-confirm', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg py-4 rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex justify-center items-center gap-2 group/btn">
                        Submit for Approval
                        <svg class="w-5 h-5 opacity-70 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600 font-semibold">
                    Already have a business account?
                    <a href="{{ route('login') }}" class="font-extrabold text-blue-600 hover:text-blue-800 transition-colors">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let otpCooldown = false;
    const otpAlreadyVerified = @json(old('owner_phone') && old('owner_phone') === ($otpVerifiedPhone ?? null));

    document.addEventListener('DOMContentLoaded', function () {
        if (otpAlreadyVerified) {
            document.getElementById('phoneVerified').value = '1';
            document.getElementById('v-owner-phone').readOnly = true;
            document.getElementById('v-owner-phone').disabled = false;
            document.getElementById('sendOtpBtn').disabled = true;
            document.getElementById('sendOtpBtn').textContent = 'Verified';
            const status = document.getElementById('otpStatus');
            status.className = 'text-xs mt-1 text-green-600';
            status.textContent = 'Phone verified successfully!';
            status.classList.remove('hidden');
        }
    });

    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const open = btn.querySelector('.eye-open');
        const closed = btn.querySelector('.eye-closed');
        if (input.type === 'password') {
            input.type = 'text';
            open.classList.add('hidden');
            closed.classList.remove('hidden');
        } else {
            input.type = 'password';
            open.classList.remove('hidden');
            closed.classList.add('hidden');
        }
    }

    document.getElementById('v-owner-phone').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });
    document.getElementById('v-otp').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });

    document.querySelector('#vendorForm')?.addEventListener('submit', function (e) {
        if (document.getElementById('phoneVerified').value !== '1') {
            e.preventDefault();
            const alert = document.querySelector('.bg-red-50') || createAlert();
            alert.classList.remove('hidden');
            alert.innerHTML = '<ul class="list-disc pl-5 space-y-1 font-medium"><li>Please verify your phone number via OTP first.</li></ul>';
        }
    });

    function createAlert() {
        const div = document.createElement('div');
        div.className = 'mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm';
        const form = document.querySelector('form');
        form.parentNode.insertBefore(div, form);
        return div;
    }

    async function sendRegOtp() {
        const phone = document.getElementById('v-owner-phone').value.trim();
        const status = document.getElementById('otpStatus');
        if (!phone || phone.length !== 10 || !/^09\d{8}$/.test(phone)) {
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Please enter a valid 10-digit phone number starting with 09.';
            status.classList.remove('hidden');
            return;
        }
        if (otpCooldown) return;

        const btn = document.getElementById('sendOtpBtn');
        btn.disabled = true;
        btn.textContent = 'Sending...';
        status.className = 'text-xs mt-1 hidden';

        const formData = new FormData();
        formData.append('phone', phone);
        formData.append('_token', '{{ csrf_token() }}');

        try {
            const res = await fetch('{{ route("otp.send") }}', {
                method: 'POST', body: formData,
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
                btn.textContent = 'Resend (' + countdown + 's)';
                const timer = setInterval(function () {
                    countdown--;
                    if (countdown <= 0) {
                        clearInterval(timer);
                        btn.disabled = false;
                        btn.textContent = 'Send OTP';
                        otpCooldown = false;
                    } else {
                        btn.textContent = 'Resend (' + countdown + 's)';
                    }
                }, 1000);
            } else {
                status.className = 'text-xs mt-1 text-red-600';
                status.textContent = data.errors ? Object.values(data.errors).flat().join(' ') : 'Failed to send OTP.';
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

    async function verifyRegOtp() {
        const phone = document.getElementById('v-owner-phone').value.trim();
        const otp = document.getElementById('v-otp').value.trim();
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
                method: 'POST', body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const data = await res.json();
            if (data.success) {
                status.className = 'text-xs mt-1 text-green-600';
                status.textContent = 'Phone verified successfully!';
                status.classList.remove('hidden');
                document.getElementById('phoneVerified').value = '1';
                document.getElementById('v-owner-phone').readOnly = true;
                document.getElementById('sendOtpBtn').disabled = true;
                btn.textContent = 'Verified';
                btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                btn.classList.add('bg-green-800', 'cursor-default');
            } else {
                status.className = 'text-xs mt-1 text-red-600';
                status.textContent = data.errors ? Object.values(data.errors).flat().join(' ') : 'Invalid OTP.';
                status.classList.remove('hidden');
                btn.disabled = false;
                btn.textContent = 'Verify';
            }
        } catch (e) {
            status.className = 'text-xs mt-1 text-red-600';
            status.textContent = 'Network error.';
            status.classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Verify';
        }
    }
</script>
@endsection
