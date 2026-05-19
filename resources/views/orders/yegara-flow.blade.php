@extends('layouts.yegara')

@section('title', 'Order Domain & Hosting')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Progress Steps -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-8">
            @php
                $currentStep = request()->get('step', 1);
            @endphp
            <div class="flex items-center flex-1">
                <div class="flex items-center">
                    <div class="w-8 h-8 @if($currentStep >= 1) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == 1) ring-2 ring-blue-500 ring-offset-2 @endif">
                        1
                    </div>
                    <span class="ml-3 font-medium @if($currentStep >= 1) text-blue-600 @else text-gray-500 @endif">Select Package</span>
                </div>
                <div class="flex-1 h-1 @if($currentStep >= 1) bg-blue-600 @else bg-gray-300 @endif mx-4"></div>
            </div>
            
            <div class="flex items-center flex-1">
                <div class="flex items-center">
                    <div class="w-8 h-8 @if($currentStep >= 2) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == 2) ring-2 ring-blue-500 ring-offset-2 @endif">
                        2
                    </div>
                    <span class="ml-3 font-medium @if($currentStep >= 2) text-blue-600 @else text-gray-500 @endif">Domain Selection</span>
                </div>
                <div class="flex-1 h-1 @if($currentStep >= 2) bg-blue-600 @else bg-gray-300 @endif mx-4"></div>
            </div>
            
            <div class="flex items-center flex-1">
                <div class="flex items-center">
                    <div class="w-8 h-8 @if($currentStep >= 3) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == 3) ring-2 ring-blue-500 ring-offset-2 @endif">
                        3
                    </div>
                    <span class="ml-3 font-medium @if($currentStep >= 3) text-blue-600 @else text-gray-500 @endif">Order Details</span>
                </div>
                <div class="flex-1 h-1 @if($currentStep >= 3) bg-blue-600 @else bg-gray-300 @endif mx-4"></div>
            </div>
            
            <div class="flex items-center flex-1">
                <div class="flex items-center">
                    <div class="w-8 h-8 @if($currentStep >= 4) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == 4) ring-2 ring-blue-500 ring-offset-2 @endif">
                        4
                    </div>
                    <span class="ml-3 font-medium @if($currentStep >= 4) text-blue-600 @else text-gray-500 @endif">Payment</span>
                </div>
                <div class="flex-1 h-1 @if($currentStep >= 4) bg-blue-600 @else bg-gray-300 @endif mx-4"></div>
            </div>
            
            <div class="flex items-center">
                <div class="w-8 h-8 @if($currentStep >= 5) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == 5) ring-2 ring-blue-500 ring-offset-2 @endif">
                    5
                </div>
                <span class="ml-3 font-medium @if($currentStep >= 5) text-blue-600 @else text-gray-500 @endif">Confirmation</span>
            </div>
        </div>
    </div>

    <!-- Step Content -->
    <div class="bg-white rounded-lg shadow-sm p-8">
        @switch(request()->get('step', 1))
            @case(1)
                <!-- Step 1: Select Package -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"/>
                        </svg>
                        Select Your Hosting Package
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Starter Hosting</h3>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Popular</span>
                            </div>
                            <div class="text-3xl font-bold text-blue-600 mb-4">150 ETB<span class="text-sm text-gray-500">/month</span></div>
                            <ul class="space-y-2 text-gray-600 mb-6">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    5 GB NVMe Storage
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    50 GB Bandwidth
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    5 Email Accounts
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    1 Free Domain
                                </li>
                            </ul>
                            <button onclick="selectPackage('starter')" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                Select Starter
                            </button>
                        </div>
                        
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Professional Hosting</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">Recommended</span>
                            </div>
                            <div class="text-3xl font-bold text-blue-600 mb-4">300 ETB<span class="text-sm text-gray-500">/month</span></div>
                            <ul class="space-y-2 text-gray-600 mb-6">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    15 GB NVMe Storage
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    150 GB Bandwidth
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    15 Email Accounts
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    2 Free Domains
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    SSL Certificate
                                </li>
                            </ul>
                            <button onclick="selectPackage('professional')" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                Select Professional
                            </button>
                        </div>
                        
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Business Hosting</h3>
                                <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2 py-1 rounded">Advanced</span>
                            </div>
                            <div class="text-3xl font-bold text-blue-600 mb-4">600 ETB<span class="text-sm text-gray-500">/month</span></div>
                            <ul class="space-y-2 text-gray-600 mb-6">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    50 GB NVMe Storage
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Unlimited Bandwidth
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Unlimited Email Accounts
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    5 Free Domains
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Priority Support
                                </li>
                            </ul>
                            <button onclick="selectPackage('business')" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                Select Business
                            </button>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button onclick="window.location.href='{{ route("orders.yegara-flow", ["step" => 2]) }}'" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                            Continue Without Package
                        </button>
                    </div>
                </div>
                
            @case(2)
                <!-- Step 2: Domain Selection & Payment Method -->
                <div>
                    <div class="mb-6 flex justify-start">
                        <a href="{{ route('orders.yegara-flow', ['step' => 1]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back to Packages
                        </a>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 019 0 9 9 0 01-9 9z"/>
                        </svg>
                        Select Your Domain Option
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer" onclick="selectDomainType('register')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Register New Domain</h3>
                                <p class="text-gray-600 text-sm">Register a new domain name for your website</p>
                            </div>
                        </div>
                        
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer" onclick="selectDomainType('transfer')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m0 0l-4-4m4 4l-4-4m0 8h8m-4-4v4m0 0l4-4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Transfer Existing Domain</h3>
                                <p class="text-gray-600 text-sm">Transfer your current domain to Yegara</p>
                            </div>
                        </div>
                        
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer" onclick="selectDomainType('existing')">
                            <div class="text-center">
                                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 019 0 9 9 0 01-9 9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1v-4z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Use Existing Domain</h3>
                                <p class="text-gray-600 text-sm">I already have hosting, just need to connect my domain</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Domain & Payment Input Form -->
                    <form id="domainForm" action="{{ route('orders.yegara-place') }}" method="POST" class="hidden space-y-6">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ request('package_id', 2) }}">
                        <input type="hidden" name="domain_type" id="domain_type_input" value="register">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Domain Name *</label>
                                <input type="text" name="domain_name" id="domainName" placeholder="example" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Domain Extension *</label>
                                <select name="domain_ext" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value=".com">.com</option>
                                    <option value=".net">.net</option>
                                    <option value=".org">.org</option>
                                    <option value=".et">.et</option>
                                    <option value=".info">.info</option>
                                    <option value=".biz">.biz</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                            <select name="payment_method" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Payment Method</option>
                                @forelse($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @empty
                                    <option value="cbe">Commercial Bank of Ethiopia (CBE)</option>
                                    <option value="awash">Awash Bank</option>
                                    <option value="dashen">Dashen Bank</option>
                                    <option value="telebirr">Telebirr</option>
                                    <option value="coop">Cooperative Bank of Oromia</option>
                                @endforelse
                            </select>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                Proceed to Payment
                            </button>
                        </div>
                    </form>
                </div>
                
            @case(4)
                <!-- Step 4: Payment -->
                <div>
                    <div class="mb-6 flex justify-start">
                        <a href="{{ route('orders.yegara-flow', ['step' => 1]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back to Packages
                        </a>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                        </svg>
                        Make Payment
                    </h2>
                    
                    @if($order)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Order Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong>Order Number:</strong> <span class="text-blue-700">{{ $order->order_number }}</span></p>
                            <p><strong>Package:</strong> {{ $order->package->name ?? 'Hosting Package' }}</p>
                            <p><strong>Domain:</strong> {{ $order->domain_name }}</p>
                            <p><strong>Total Amount:</strong> <span class="text-lg font-bold text-blue-700">{{ number_format($order->total_amount) }} {{ $order->currency }}</span></p>
                        </div>
                    </div>
                    @endif

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-yellow-900 mb-4">Payment Instructions</h3>
                        
                        @php
                            $selectedMethod = null;
                            if ($order && is_numeric($order->payment_method)) {
                                $selectedMethod = \App\Models\PaymentMethod::find($order->payment_method);
                            }
                        @endphp
                        
                        @if($selectedMethod)
                            <div class="mb-6 bg-white p-4 rounded border border-yellow-300">
                                <p class="text-xl font-bold text-gray-900 mb-2 border-b pb-2">Bank: {{ $selectedMethod->name }}</p>
                                <p class="text-md text-gray-800 mt-2"><strong>Account Name:</strong> {{ $selectedMethod->account_name }}</p>
                                <p class="text-md text-gray-800"><strong>Account Number:</strong> <span class="font-mono text-lg font-bold text-blue-600">{{ $selectedMethod->account_number }}</span></p>
                                @if($selectedMethod->instructions)
                                    <p class="text-sm text-gray-600 mt-3 p-2 bg-gray-50 rounded">{{ $selectedMethod->instructions }}</p>
                                @endif
                            </div>
                        @elseif($order)
                            <p class="mb-6 text-gray-800 bg-white p-4 rounded border border-yellow-300"><strong>Bank Details:</strong> Please check your confirmation email for the exact account number corresponding to your selected bank ({{ strtoupper($order->payment_method) }}).</p>
                        @endif

                        <div class="space-y-4 text-yellow-800">
                            <p><strong>1.</strong> Make a deposit of <strong class="text-lg">{{ $order ? number_format($order->total_amount) . ' ' . $order->currency : 'the total amount' }}</strong> to the bank account details provided above.</p>
                            <p><strong>2.</strong> Keep your payment receipt or transaction reference number safe.</p>
                            <p><strong>3.</strong> After payment, come back to this page to verify your payment.</p>
                            <p><strong>4.</strong> Your account will be activated within 10 minutes after verification.</p>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button onclick="window.location.href='{{ route('orders.yegara-flow', ['step' => 5, 'order_id' => request('order_id')]) }}'" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold shadow-lg">
                            I Have Made Payment - Verify Now
                        </button>
                        <p class="mt-4 text-gray-600">
                            Need help? <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800 font-medium">Contact Support</a>
                        </p>
                    </div>
                </div>
                
            @case(5)
                <!-- Step 5: Confirmation -->
                <div>
                    <div class="mb-6 flex justify-start">
                        <a href="{{ route('orders.yegara-flow', ['step' => 1]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back to Packages
                        </a>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Payment Verification
                    </h2>
                    
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        @php 
                            $order = \App\Models\Order::find(request('order_id')); 
                            $bankName = '';
                            if ($order && is_numeric($order->payment_method)) {
                                $method = \App\Models\PaymentMethod::find($order->payment_method);
                                if ($method) $bankName = $method->name;
                            } else if ($order) {
                                $bankName = strtoupper($order->payment_method);
                            }
                        @endphp
                        
                        <p class="text-lg text-gray-700 mb-4">Upload your bank slip or enter transaction details to complete your order</p>
                        
                        @if($bankName)
                            <div class="inline-block bg-blue-50 border border-blue-200 rounded-lg px-6 py-3 mt-2 mb-6">
                                <p class="text-blue-800 font-medium">Selected Payment Method: <strong class="text-blue-900 text-xl ml-2">{{ $bankName }}</strong></p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="text-center">
                        <a href="{{ route('payment.verify', ['order_id' => $order?->order_number, 'amount' => $order?->total_amount, 'bank_name' => $order?->payment_method]) }}" class="bg-blue-600 text-white px-12 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-lg">
                            Go to Payment Verification
                        </a>
                    </div>
                </div>
        @endswitch
    </div>
</div>

<script>
function selectPackage(packageType) {
    localStorage.setItem('selectedPackage', packageType);
    const packageMap = {
        'starter': 2,
        'professional': 3,
        'business': 4
    };
    const packageId = packageMap[packageType] || 2;
    window.location.href = `{{ route("orders.yegara-flow") }}?step=2&package_id=${packageId}`;
}

function selectDomainType(type) {
    localStorage.setItem('domainType', type);
    document.getElementById('domain_type_input').value = type;
    document.getElementById('domainForm').classList.remove('hidden');
}

function proceedToStep(step) {
    window.location.href = `{{ route("orders.yegara-flow") }}?step=${step}`;
}
</script>
@endsection
