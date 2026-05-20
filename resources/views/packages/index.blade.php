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

    <!-- Hosting Packages -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center" data-i18n="hosting-packages">Hosting Packages</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Starter Package -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold text-gray-900" data-i18n="starter-hosting">Starter Hosting</h3>
                    <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full" data-i18n="popular">Popular</span>
                </div>
                <div class="text-4xl font-bold text-blue-600 mb-6">150 ETB<span class="text-lg text-gray-500" data-i18n="month">/month</span></div>
                <ul class="text-gray-600 mb-8 space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="starter-nvme">5 GB NVMe Storage</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="starter-bandwidth">50 GB Bandwidth</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="starter-emails">5 Email Accounts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="starter-domains">1 Free Domain</span>
                    </li>
                </ul>
                <button onclick="handlePackageSelection(2)" class="w-full bg-blue-600 text-white text-center py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-lg" data-i18n="select-starter">
                    Select Starter
                </button>
            </div>

            <!-- Professional Package -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-blue-500 relative">
                <div class="absolute -top-3 -right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full" data-i18n="recommended">Recommended</div>
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold text-gray-900" data-i18n="professional-hosting">Professional Hosting</h3>
                    <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full" data-i18n="best-value">Best Value</span>
                </div>
                <div class="text-4xl font-bold text-blue-600 mb-6">300 ETB<span class="text-lg text-gray-500" data-i18n="month">/month</span></div>
                <ul class="text-gray-600 mb-8 space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="pro-nvme">15 GB NVMe Storage</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="pro-bandwidth">150 GB Bandwidth</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="pro-emails">15 Email Accounts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="pro-domains">2 Free Domains</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="pro-ssl">SSL Certificate</span>
                    </li>
                </ul>
                <button onclick="handlePackageSelection(3)" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-4 px-6 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 font-semibold text-lg shadow-lg" data-i18n="select-pro">
                    Select Professional
                </button>
            </div>

            <!-- Business Package -->
            <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-2xl font-bold text-gray-900" data-i18n="business-hosting">Business Hosting</h3>
                    <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full" data-i18n="advanced">Advanced</span>
                </div>
                <div class="text-4xl font-bold text-blue-600 mb-6">600 ETB<span class="text-lg text-gray-500" data-i18n="month">/month</span></div>
                <ul class="text-gray-600 mb-8 space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="biz-nvme">50 GB NVMe Storage</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="biz-bandwidth">Unlimited Bandwidth</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="biz-emails">Unlimited Email Accounts</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="biz-domains">5 Free Domains</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span data-i18n="biz-support">Priority Support</span>
                    </li>
                </ul>
                <button onclick="handlePackageSelection(4)" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center py-4 px-6 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300 font-semibold text-lg shadow-lg" data-i18n="select-biz">
                    Select Business
                </button>
            </div>
        </div>
    </section>

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
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[90vh] flex flex-col overflow-hidden transform transition-all">
        <!-- Close Button -->
        <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-white z-10 bg-black/20 hover:bg-black/40 rounded-full p-1 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white text-center shrink-0">
            <h3 class="text-2xl font-bold mb-1">User Account Dashboard</h3>
            <p class="text-blue-100 text-sm">Register or log in to secure your hosting package</p>
        </div>

        <div class="flex border-b border-gray-200 bg-gray-50 shrink-0">
            <button id="tab-register" onclick="switchTab('register')" class="flex-1 py-4 text-center font-semibold text-blue-600 border-b-2 border-blue-600 focus:outline-none">Register</button>
            <button id="tab-login" onclick="switchTab('login')" class="flex-1 py-4 text-center font-semibold text-gray-500 hover:text-gray-700 focus:outline-none">Login</button>
        </div>

        <div class="p-6 md:p-8 overflow-y-auto">
            <div id="authAlert" class="hidden mb-4 p-3 rounded text-sm font-medium"></div>
            
            <!-- Login Form -->
            <form id="loginForm" class="space-y-4 hidden" onsubmit="submitAuth(event, 'login')">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Sign In
                </button>
            </form>

            <!-- Register Form -->
            <form id="registerForm" class="space-y-4" onsubmit="submitAuth(event, 'register')">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone (10 digits starting with 09)</label>
                    <input type="text" name="phone" required maxlength="10" placeholder="e.g. 0911234567" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
            openAuthModal();
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
        const form = event.target;
        const formData = new FormData(form);
        const url = type === 'login' ? '{{ route("ajax.login") }}' : '{{ route("ajax.register") }}';
        
        const alertEl = document.getElementById('authAlert');
        alertEl.classList.add('hidden');
        alertEl.className = 'p-4 rounded-lg mb-6 hidden'; // Reset classes
        
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
                    // Switch to login tab and show success message
                    switchTab('login');
                    alertEl.classList.remove('hidden');
                    alertEl.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
                    alertEl.textContent = 'Registration successful! Please log in to continue.';
                    form.reset();
                } else {
                    // Login success - redirect to dashboard!
                    proceedToDashboard();
                }
            } else {
                // Error
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
</script>
@endsection
