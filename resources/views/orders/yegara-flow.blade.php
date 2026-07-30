@extends('layouts.yegara')

@section('title', 'Order Domain & Hosting')

@section('content')
@php
    $currentStep = (int) request()->get('step', 1);
    $selectedPackageId = request('package_id', session('order_data.package_id'));
    $selectedPackage = $selectedPackageId ? \App\Models\Package::find($selectedPackageId) : null;
    $isService = $selectedPackage && $selectedPackage->type === 'services';
@endphp
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Progress Steps -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-8">
            @php
                $stepLabels = $isService
                    ? ['Select Package', 'Select Level', 'Order Details', 'Payment', 'Confirmation']
                    : ['Select Package', 'Domain Selection', 'Order Details', 'Payment', 'Confirmation'];
            @endphp
            @foreach($stepLabels as $i => $label)
                @php $stepNum = $i + 1; @endphp
                <div class="flex items-center @if($stepNum < 5) flex-1 @endif">
                    <div class="flex items-center">
                        <div class="w-8 h-8 @if($currentStep >= $stepNum) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == $stepNum) ring-2 ring-blue-500 ring-offset-2 @endif">
                            {{ $stepNum }}
                        </div>
                        <span class="ml-3 font-medium @if($currentStep >= $stepNum) text-blue-600 @else text-gray-500 @endif hidden md:inline">{{ $label }}</span>
                    </div>
                    @if($stepNum < 5)
                    <div class="flex-1 h-1 @if($currentStep > $stepNum) bg-blue-600 @else bg-gray-300 @endif mx-2 md:mx-4"></div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Step Content -->
    <div class="bg-white rounded-lg shadow-sm p-8">
        @switch($currentStep)
            @case(1)
                <!-- Step 1: Select Package -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2z"/>
                        </svg>
                        Select Your Package
                    </h2>
                    
                    @foreach($packages as $type => $typePackages)
                    @php
                        $typeLabels = [
                            'hosting' => ['title' => 'Hosting Packages', 'color' => 'blue'],
                            'services' => ['title' => 'Organizational Services', 'color' => 'green'],
                        ];
                        $label = $typeLabels[$type] ?? ['title' => ucfirst($type) . ' Packages', 'color' => 'gray'];
                    @endphp
                    <h3 class="text-xl font-bold text-gray-800 mb-4 mt-8 first:mt-0 flex items-center gap-2">
                        <svg class="w-5 h-5 text-{{ $label['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($type === 'hosting')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            @endif
                        </svg>
                        {{ $label['title'] }}
                    </h3>
                    @if($type === 'services')
                        @foreach($typePackages as $provider => $providerPackages)
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-gray-700 mb-4 pl-3 border-l-4 border-green-500">{{ $provider }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($providerPackages as $package)
                                <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer flex flex-col" onclick="selectPackage({{ $package->id }}, '{{ $package->type }}')">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $package->name }}</h3>
                                        @if($loop->first)
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Popular</span>
                                        @endif
                                    </div>
                                    @if($package->description)
                                    <p class="text-sm text-gray-500 mb-3">{{ $package->description }}</p>
                                    @endif
                                    @if($package->registration_fee || $package->monthly_fee)
                                    <div class="space-y-1 mb-4">
                                        @if($package->registration_fee)
                                        <div class="text-sm text-gray-600"><span class="font-medium">Registration:</span> {{ number_format($package->registration_fee) }} {{ $package->currency }}</div>
                                        @endif
                                        @if($package->monthly_fee)
                                        <div class="text-sm text-gray-600"><span class="font-medium">Monthly:</span> {{ number_format($package->monthly_fee) }} {{ $package->currency }}</div>
                                        @endif
                                    </div>
                                    @endif
                                    @if(is_array($package->features) && isset($package->features['levels']))
                                    <div class="text-sm text-gray-500 mb-4 flex-grow">
                                        <span class="font-medium text-gray-700">Available Levels:</span>
                                        <ul class="mt-1 space-y-1">
                                            @foreach($package->features['levels'] as $level)
                                            <li class="flex items-center">
                                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ $level['name'] }} - {{ number_format($level['fee']) }} {{ $package->currency }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <button onclick="event.stopPropagation(); selectPackage({{ $package->id }}, '{{ $package->type }}')" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold mt-auto">
                                        Select {{ $package->name }}
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($typePackages as $package)
                        <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-400 transition-colors cursor-pointer flex flex-col" onclick="selectPackage({{ $package->id }}, '{{ $package->type }}')">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $package->name }}</h3>
                                @if($loop->first)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">Popular</span>
                                @endif
                            </div>
                            @if($package->description)
                            <p class="text-sm text-gray-500 mb-3">{{ $package->description }}</p>
                            @endif
                            <div class="text-3xl font-bold text-blue-600 mb-4">
                                {{ number_format($package->price) }} {{ $package->currency }}
                                @if($type === 'hosting')<span class="text-sm text-gray-500">/month</span>@endif
                            </div>
                            @if(is_array($package->features) && count($package->features))
                            <ul class="space-y-2 text-gray-600 mb-6 flex-grow">
                                @foreach($package->features as $feature)
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 1.414z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ is_string($feature) ? $feature : '' }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                            <button onclick="event.stopPropagation(); selectPackage({{ $package->id }}, '{{ $package->type }}')" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold mt-auto">
                                Select {{ $package->name }}
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach
                    
                    <div class="text-center">
                        <button onclick="window.location.href='{{ route("orders.yegara-flow", ["step" => 2]) }}'" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                            Continue Without Package
                        </button>
                    </div>
                </div>
                
            @case(2)
                @if($isService)
                    <!-- Step 2: Level Selection for Services -->
                    <div>
                        <div class="mb-6 flex justify-start">
                            <a href="{{ route('orders.yegara-flow', ['step' => 1]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                Back to Packages
                            </a>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            {{ $selectedPackage->name }} - Select Service Level
                        </h2>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <p class="text-blue-800">
                                <strong>{{ $selectedPackage->name }}</strong> - 
                                Registration: {{ number_format($selectedPackage->registration_fee) }} {{ $selectedPackage->currency }} | 
                                Monthly: {{ number_format($selectedPackage->monthly_fee) }} {{ $selectedPackage->currency }}
                            </p>
                        </div>

                        @if(is_array($selectedPackage->features) && isset($selectedPackage->features['levels']))
                        <form id="serviceLevelForm" action="{{ route('orders.yegara-place-service') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $selectedPackage->id }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                @foreach($selectedPackage->features['levels'] as $index => $level)
                                <div class="level-card bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-green-400 hover:shadow-md transition-all cursor-pointer flex flex-col" onclick="selectLevel(this, {{ $level['fee'] }})">
                                    <div class="flex items-start mb-3">
                                        <input type="radio" name="selected_level" value="{{ $level['name'] }}" class="mt-1 mr-3" required>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $level['name'] }}</h3>
                                            <p class="text-sm text-gray-500">Service fee for {{ $level['name'] }}</p>
                                        </div>
                                    </div>
                                    <div class="text-2xl font-bold text-green-600">{{ number_format($level['fee']) }} {{ $selectedPackage->currency }}</div>
                                </div>
                                @endforeach
                            </div>

                            <div id="totalSummary" class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8 hidden">
                                <h3 class="text-lg font-semibold text-green-900 mb-3">Fee Breakdown</h3>
                                <div class="space-y-2 text-green-800">
                                    <div class="flex justify-between">
                                        <span>Registration Fee (one-time)</span>
                                        <span class="font-semibold">{{ number_format($selectedPackage->registration_fee) }} {{ $selectedPackage->currency }}</span>
                                    </div>
                                    <div id="selectedLevelFeeRow" class="flex justify-between">
                                        <span>Selected Service Fee (one-time)</span>
                                        <span class="font-semibold">0 {{ $selectedPackage->currency }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Monthly Fee (recurring)</span>
                                        <span class="font-semibold">{{ number_format($selectedPackage->monthly_fee) }} {{ $selectedPackage->currency }}</span>
                                    </div>
                                    <hr class="border-green-300">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total Due Now</span>
                                        <span id="totalAmount">{{ number_format($selectedPackage->registration_fee) }} {{ $selectedPackage->currency }}</span>
                                    </div>
                                </div>
                                <input type="hidden" name="total_amount" id="totalAmountInput" value="{{ $selectedPackage->registration_fee ?? 0 }}">
                            </div>

                            <div id="paymentMethodSection" class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8 hidden">
                                <h3 class="text-lg font-semibold text-blue-900 mb-4">Select Payment Method</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    @foreach($paymentMethods as $method)
                                    @php $hasDetails = $method->account_number && $method->account_name; @endphp
                                    <label class="payment-method border-2 border-gray-200 bg-white rounded-lg p-4 transition-all flex flex-col {{ $hasDetails ? 'hover:border-blue-400 cursor-pointer' : 'opacity-50 cursor-not-allowed' }}" data-method-id="{{ $method->id }}" data-has-details="{{ $hasDetails ? '1' : '0' }}">
                                        <div class="flex items-center gap-3">
                                            <input type="radio" name="payment_method" value="{{ $method->id }}" class="mt-0.5" {{ $hasDetails ? '' : 'disabled' }} {{ $loop->first && $hasDetails ? 'checked' : '' }}>
                                            @if($method->icon)
                                            <img src="{{ $method->icon_url }}" alt="{{ $method->name }}" class="h-8 w-8 object-contain rounded-lg border border-gray-200 bg-white p-0.5 flex-shrink-0">
                                            @endif
                                            <div>
                                                <span class="font-semibold text-gray-900">{{ $method->name }}</span>
                                                <div class="text-xs {{ $hasDetails ? 'text-gray-500' : 'text-red-400' }}">{{ $hasDetails ? $method->account_name : 'Not configured' }}</div>
                                            </div>
                                        </div>
                                        @if($hasDetails)
                                        <div class="method-details hidden mt-3 pt-3 border-t border-gray-200 text-sm text-gray-700">
                                            <p><strong>Account:</strong> <span class="font-mono text-blue-700">{{ $method->account_number }}</span></p>
                                            @if($method->instructions)
                                            <p class="mt-1 text-gray-500">{{ $method->instructions }}</p>
                                            @endif
                                        </div>
                                        @endif
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="proceedBtn" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold opacity-50 cursor-not-allowed" disabled>
                                    Proceed to Payment
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                @else
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
                        
                        <form id="domainForm" action="{{ route('orders.yegara-place') }}" method="POST" class="hidden space-y-6">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $selectedPackage->id ?? request('package_id', 2) }}">
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
                                <div class="relative">
                                    <select name="payment_method" id="domainPaymentMethod" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                        <option value="">Select Payment Method</option>
                                        @forelse($paymentMethods as $method)
                                            @php $hasDetails = $method->account_number && $method->account_name; @endphp
                                            <option value="{{ $method->id }}" data-icon="{{ $method->icon ? asset('storage/' . $method->icon) : '' }}" data-account="{{ $method->account_number }}" data-name="{{ $method->account_name }}" data-instructions="{{ $method->instructions ?? '' }}" {{ $hasDetails ? '' : 'disabled class=text-gray-400' }}>{{ $method->name }}{{ $hasDetails ? '' : ' (not configured)' }}</option>
                                        @empty
                                            <option value="" disabled>No payment methods available</option>
                                        @endforelse
                                    </select>
                                    <div id="domainSelectedIcon" class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none hidden">
                                        <img src="" alt="" class="h-5 w-5 object-contain">
                                    </div>
                                </div>
                                <div id="domainPaymentDetails" class="hidden mt-3 bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-800">
                                    <p><strong>Account Name:</strong> <span id="domainAccountName"></span></p>
                                    <p class="mt-1"><strong>Account Number:</strong> <span id="domainAccountNumber" class="font-mono"></span></p>
                                    <p id="domainInstructions" class="mt-1 text-gray-600"></p>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Proceed to Payment
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                
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
                            <p><strong>Package:</strong> {{ $order->package->name ?? 'N/A' }}</p>
                            @if($order->domain_name)
                            <p><strong>Domain:</strong> {{ $order->domain_name }}</p>
                            @endif
                            @if($order->selected_level)
                            <p><strong>Selected Level:</strong> {{ $order->selected_level['name'] ?? '' }}</p>
                            @endif
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
                                <p class="text-xl font-bold text-gray-900 mb-2 border-b pb-2 flex items-center">
                                    @if($selectedMethod->icon)
                                    <img src="{{ $selectedMethod->icon_url }}" alt="{{ $selectedMethod->name }}" class="h-8 w-8 object-contain mr-2 rounded-lg border border-gray-200 bg-white p-0.5">
                                    @endif
                                    Bank: {{ $selectedMethod->name }}
                                </p>
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
                            $order = \App\Models\Order::with('package')->find(request('order_id')); 
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
                                <p class="text-blue-800 font-medium flex items-center gap-2">
                                    @php
                                        $finalMethod = \App\Models\PaymentMethod::find($order?->payment_method);
                                    @endphp
                                    @if($finalMethod && $finalMethod->icon)
                                    <img src="{{ $finalMethod->icon_url }}" alt="{{ $finalMethod->name }}" class="h-6 w-6 object-contain rounded border border-gray-200 bg-white p-0.5">
                                    @endif
                                    Selected Payment Method: <strong class="text-blue-900 text-xl ml-2">{{ $bankName }}</strong>
                                </p>
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
function selectPackage(packageId, type) {
    localStorage.setItem('selectedPackage', packageId);
    window.location.href = `{{ route("orders.yegara-flow") }}?step=2&package_id=${packageId}`;
}

function selectDomainType(type) {
    localStorage.setItem('domainType', type);
    document.getElementById('domain_type_input').value = type;
    document.getElementById('domainForm').classList.remove('hidden');
}

var levelSelected = false;

function selectLevel(el, fee) {
    document.querySelectorAll('.level-card').forEach(function(c) {
        c.classList.remove('border-green-400', 'bg-green-100', 'shadow-md');
        c.classList.add('border-gray-200');
    });
    el.classList.remove('border-gray-200');
    el.classList.add('border-green-400', 'bg-green-100', 'shadow-md');

    var radio = el.querySelector('input[type="radio"]');
    if (radio) radio.checked = true;

    var registrationFee = {{ $selectedPackage ? ($selectedPackage->registration_fee ?? 0) : 0 }};
    var total = registrationFee + fee;
    var feeRow = document.getElementById('selectedLevelFeeRow');
    if (feeRow) {
        var spans = feeRow.querySelectorAll('span');
        if (spans.length > 1) spans[spans.length - 1].textContent = Number(fee).toLocaleString() + ' {{ $selectedPackage ? $selectedPackage->currency : "ETB" }}';
    }
    var totalEl = document.getElementById('totalAmount');
    if (totalEl) totalEl.textContent = Number(total).toLocaleString() + ' {{ $selectedPackage ? $selectedPackage->currency : "ETB" }}';
    var inputEl = document.getElementById('totalAmountInput');
    if (inputEl) inputEl.value = total;
    var summaryEl = document.getElementById('totalSummary');
    if (summaryEl) summaryEl.classList.remove('hidden');

    document.getElementById('paymentMethodSection').classList.remove('hidden');
    levelSelected = true;
    checkProceed();
}

function checkProceed() {
    var btn = document.getElementById('proceedBtn');
    var paymentSelected = document.querySelector('input[name="payment_method"]:checked');
    if (levelSelected && paymentSelected) {
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.payment-method').forEach(function(label) {
        label.addEventListener('click', function() {
            if (this.dataset.hasDetails !== '1') return;
            document.querySelectorAll('.payment-method').forEach(function(m) {
                m.classList.remove('border-blue-400', 'bg-blue-50');
                m.classList.add('border-gray-200');
                var d = m.querySelector('.method-details');
                if (d) d.classList.add('hidden');
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-blue-400', 'bg-blue-50');
            var details = this.querySelector('.method-details');
            if (details) details.classList.remove('hidden');
            var radio = this.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
            checkProceed();
        });
    });

    var domainPayment = document.getElementById('domainPaymentMethod');
    if (domainPayment) {
        domainPayment.addEventListener('change', function() {
            var sel = this.options[this.selectedIndex];
            if (sel && sel.disabled) {
                this.value = '';
                return;
            }
            var details = document.getElementById('domainPaymentDetails');
            var iconContainer = document.getElementById('domainSelectedIcon');
            if (sel && sel.value) {
                document.getElementById('domainAccountName').textContent = sel.getAttribute('data-name') || '';
                document.getElementById('domainAccountNumber').textContent = sel.getAttribute('data-account') || '';
                document.getElementById('domainInstructions').textContent = sel.getAttribute('data-instructions') || '';
                details.classList.remove('hidden');
                var iconUrl = sel.getAttribute('data-icon');
                if (iconUrl) {
                    iconContainer.querySelector('img').src = iconUrl;
                    iconContainer.classList.remove('hidden');
                } else {
                    iconContainer.classList.add('hidden');
                }
            } else {
                details.classList.add('hidden');
                iconContainer.classList.add('hidden');
            }
        });
    }
});
</script>
@endsection