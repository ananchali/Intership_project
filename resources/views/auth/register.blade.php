@extends('layouts.yegara')

@section('title', 'Register - Afronexhost')

@section('content')
<div class="min-h-screen flex items-stretch bg-gray-50">
    <div class="hidden lg:flex w-1/2 relative text-white overflow-hidden bg-black/40 backdrop-blur-md border-r border-white/5">
        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-15 mix-blend-overlay">
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
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-md">Join Our <br>Community.</h1>
                <p class="text-xl text-blue-200 max-w-md font-light">Create an account to manage your hosting, domains, and billing.</p>
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
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Get Started
                </div>
                <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight leading-snug">
                    Create Your Account
                </h3>
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
                <form id="registerForm" action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="relative group">
                        <label for="reg-name" class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" id="reg-name" name="name" value="{{ old('name') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="John Doe">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="reg-email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input type="email" id="reg-email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="reg-phone" class="block text-sm font-bold text-gray-700 mb-2">Phone</label>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                </div>
                                <input type="text" id="reg-phone" name="phone" value="{{ old('phone') }}" required maxlength="10"
                                       class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                       placeholder="0911234567">
                            </div>
                            <button type="button" id="sendOtpBtn" onclick="sendRegOtp()" class="shrink-0 px-5 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm font-bold disabled:opacity-50 transition-all">Send OTP</button>
                        </div>
                        <p id="otpStatus" class="text-xs mt-1 hidden"></p>
                    </div>

                    <div id="otpSection" class="hidden">
                        <label for="reg-otp" class="block text-sm font-bold text-gray-700 mb-2">OTP Code</label>
                        <div class="flex gap-2">
                            <input type="text" id="reg-otp" maxlength="6" placeholder="Enter 6-digit OTP"
                                   class="flex-1 w-full px-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900 text-center text-xl tracking-widest">
                            <button type="button" id="verifyOtpBtn" onclick="verifyRegOtp()" class="shrink-0 px-5 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 text-sm font-bold disabled:opacity-50 transition-all">Verify</button>
                        </div>
                        <p id="otpVerifyStatus" class="text-xs mt-1 hidden"></p>
                        <input type="hidden" name="phone_verified" id="phoneVerified" value="0">
                    </div>

                    <div class="relative group">
                        <label for="reg-password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="reg-password" name="password" required
                                   class="w-full pl-11 pr-12 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="••••••••" oninput="checkPasswordStrength(this.value)">
                            <button type="button" onclick="togglePassword('reg-password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                        <div id="passwordStrength" class="mt-2 hidden">
                            <div class="flex gap-1 mb-1">
                                <div class="bar h-1 flex-1 rounded-full bg-gray-200 transition-all"></div>
                                <div class="bar h-1 flex-1 rounded-full bg-gray-200 transition-all"></div>
                                <div class="bar h-1 flex-1 rounded-full bg-gray-200 transition-all"></div>
                                <div class="bar h-1 flex-1 rounded-full bg-gray-200 transition-all"></div>
                            </div>
                            <p id="strengthText" class="text-xs font-semibold"></p>
                            <ul id="passwordRules" class="text-xs mt-1 space-y-0.5">
                                <li id="rule-length" class="text-gray-400">&#9679; At least 8 characters</li>
                                <li id="rule-upper" class="text-gray-400">&#9679; One uppercase letter</li>
                                <li id="rule-lower" class="text-gray-400">&#9679; One lowercase letter</li>
                                <li id="rule-number" class="text-gray-400">&#9679; One number</li>
                                <li id="rule-special" class="text-gray-400">&#9679; One special character (@$!%*?&)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="reg-password-confirm" class="block text-sm font-bold text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="reg-password-confirm" name="password_confirmation" required
                                   class="w-full pl-11 pr-12 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword('reg-password-confirm', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg py-4 rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex justify-center items-center gap-2 group/btn">
                        Create Account
                        <svg class="w-5 h-5 opacity-70 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600 font-semibold">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-extrabold text-blue-600 hover:text-blue-800 transition-colors">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let otpCooldown = false;

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

    function checkPasswordStrength(password) {
        const container = document.getElementById('passwordStrength');
        const bars = container.querySelectorAll('.bar');
        const text = document.getElementById('strengthText');
        if (!password) {
            container.classList.add('hidden');
            return;
        }
        container.classList.remove('hidden');

        const rules = {
            length: password.length >= 8,
            upper: /[A-Z]/.test(password),
            lower: /[a-z]/.test(password),
            number: /\d/.test(password),
            special: /[@$!%*?&]/.test(password),
        };

        document.getElementById('rule-length').className = rules.length ? 'text-green-600' : 'text-gray-400';
        document.getElementById('rule-upper').className = rules.upper ? 'text-green-600' : 'text-gray-400';
        document.getElementById('rule-lower').className = rules.lower ? 'text-green-600' : 'text-gray-400';
        document.getElementById('rule-number').className = rules.number ? 'text-green-600' : 'text-gray-400';
        document.getElementById('rule-special').className = rules.special ? 'text-green-600' : 'text-gray-400';

        const passed = Object.values(rules).filter(Boolean).length;
        const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-lime-500', 'bg-green-500'];
        const labels = ['Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
        bars.forEach((bar, i) => {
            bar.className = `bar h-1 flex-1 rounded-full transition-all ${i < passed ? colors[passed-1] : 'bg-gray-200'}`;
        });
        text.textContent = labels[passed - 1] || '';
        text.className = `text-xs font-semibold ${passed <= 2 ? 'text-red-600' : passed <= 3 ? 'text-yellow-600' : 'text-green-600'}`;
    }

    document.getElementById('reg-phone').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });
    document.getElementById('reg-otp').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });

    document.querySelector('#registerForm')?.addEventListener('submit', function (e) {
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
        const phone = document.getElementById('reg-phone').value.trim();
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
        const phone = document.getElementById('reg-phone').value.trim();
        const otp = document.getElementById('reg-otp').value.trim();
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
                document.getElementById('reg-phone').disabled = true;
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