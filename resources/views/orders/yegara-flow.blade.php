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
                    ? ['Select Package', 'Select Level', 'Payment Method', 'Payment']
                    : ['Select Package', 'Domain Selection', 'Payment Method', 'Payment'];
            @endphp
            @foreach($stepLabels as $i => $label)
                @php $stepNum = $i + 1; @endphp
                <div class="flex items-center @if(!$loop->last) flex-1 @endif">
                    <div class="flex items-center">
                        <div class="w-8 h-8 @if($currentStep >= $stepNum) gradient-bg @else bg-gray-300 @endif rounded-full flex items-center justify-center text-white font-bold text-sm @if($currentStep == $stepNum) ring-2 ring-blue-500 ring-offset-2 @endif">
                            {{ $stepNum }}
                        </div>
                        <span class="ml-3 font-medium @if($currentStep >= $stepNum) text-blue-600 @else text-gray-500 @endif hidden md:inline">{{ $label }}</span>
                    </div>
                    @if(!$loop->last)
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
                        <form id="serviceLevelForm" action="{{ route('orders.yegara-step2-level') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $selectedPackage->id }}">
                            
                            <div class="mb-6 flex items-center gap-3 bg-blue-50 border-2 border-blue-200 border-dashed rounded-xl px-5 py-4 animate-pulse">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0l3-3m-3 3l-3-3m3 6a2 2 0 110 4 2 2 0 010-4zm-5 2a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-blue-800 font-bold text-sm">Tap or click on <span class="underline">one service</span> below to select it, then continue.</p>
                            </div>

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

                            <div class="text-center">
                                <button type="submit" id="proceedBtn" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold opacity-50 cursor-not-allowed" disabled>
                                    Continue
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
                        
                        <form id="domainForm" action="{{ route('orders.yegara-step2-domain') }}" method="POST" class="hidden space-y-6">
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

                            <div class="text-center">
                                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                    Continue
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                
            @case(3)
                @php $orderData = session('order_data'); @endphp
                @if(!$orderData || !isset($orderData['package_id']))
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Order Data Found</h3>
                        <p class="text-gray-500 mb-6">Please select a package first before choosing payment method.</p>
                        <a href="{{ route('orders.yegara-flow', ['step' => 1]) }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">Browse Packages</a>
                    </div>
                @else
                <!-- Step 3: Payment Method Selection -->
                <div>
                    <div class="mb-6 flex justify-start">
                        <a href="{{ route('orders.yegara-flow', ['step' => 2, 'package_id' => session('order_data.package_id')]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back
                        </a>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                        </svg>
                        Select Payment Method
                    </h2>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4">Order Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($orderData && isset($orderData['package_id']))
                                @php $pkg = \App\Models\Package::find($orderData['package_id']); @endphp
                                <p><strong>Package:</strong> {{ $pkg->name ?? 'N/A' }}</p>
                                @if(isset($orderData['domain_name']))
                                <p><strong>Domain:</strong> {{ $orderData['domain_name'] }}</p>
                                @endif
                                @if(isset($orderData['selected_level']))
                                <p><strong>Level:</strong> {{ $orderData['selected_level'] }}</p>
                                @endif
                                <p><strong>Total Amount:</strong> <span class="text-lg font-bold text-blue-700">
                                    {{ number_format($orderData['total_amount'] ?? $pkg->price) }} {{ $pkg->currency ?? 'ETB' }}
                                </span></p>
                            @endif
                        </div>
                    </div>

                    <form id="paymentMethodForm" action="{{ $isService ? route('orders.yegara-place-service') : route('orders.yegara-place') }}" method="POST">
                        @csrf
                        <div class="bg-gray-50 rounded-lg p-6 mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($paymentMethods as $method)
                                @php $hasDetails = $method->account_number && $method->account_name; @endphp
                                <label class="payment-method border-2 border-gray-200 bg-white rounded-lg p-4 transition-all flex flex-col {{ $hasDetails ? 'hover:border-blue-400 cursor-pointer' : 'opacity-50 cursor-not-allowed' }}" data-has-details="{{ $hasDetails ? '1' : '0' }}">
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
                                @empty
                                <div class="col-span-2 text-center py-8 text-gray-500">
                                    <p class="font-semibold">No payment methods available</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        @if($paymentMethods->count() > 0)
                        <div class="text-center">
                            <button type="submit" class="bg-blue-600 text-white px-12 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-lg">
                                Place Order &amp; Proceed to Payment
                            </button>
                        </div>
                        @endif
                    </form>
                </div>

                <script>
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
                        });
                    });
                });
                </script>
                </div>
                @endif

            @case(4)
                @if(request('verified'))
                <div class="text-center py-8">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Payment Submitted Successfully!</h2>
                    <p class="text-lg text-gray-600 max-w-lg mx-auto mb-8">
                        Your payment verification has been submitted and is now under review by our admin team.
                        You will be notified once your payment is verified.
                    </p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 max-w-md mx-auto mb-8">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-sm text-yellow-800 font-medium text-left">
                                Your order #{{ $order->order_number ?? '' }} is currently pending review. Activation typically takes up to 10 minutes after admin approval.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3.5 rounded-2xl font-bold shadow-lg hover:shadow-blue-500/20 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Go to Dashboard
                    </a>
                </div>
                @else
                <!-- Step 4: Payment -->
                <div>
                    <div class="mb-6 flex justify-start">
                        <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 font-semibold border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back to Dashboard
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
                        <button onclick="document.getElementById('verifyForm').classList.toggle('hidden'); this.classList.add('hidden');" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold shadow-lg">
                            I Have Made Payment - Verify Now
                        </button>
                        <p class="mt-4 text-gray-600">
                            Need help? <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800 font-medium">Contact Support</a>
                        </p>
                    </div>

                    @if($order)
                    <div id="verifyForm" class="hidden mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Payment Verification
                        </h3>

                        <form action="{{ route('payment.verify.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->order_number }}">
                            <input type="hidden" name="amount" value="{{ $order->total_amount }}">
                            <input type="hidden" name="_from_yegara" value="1">

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Transaction Details</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Reference Number *</label>
                                        <input type="text" name="transaction_number" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="e.g., FT2501667SR1" value="{{ old('transaction_number') }}">
                                        <p class="mt-1 text-xs text-gray-500">Found on your payment receipt or bank statement</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Account Holder Name *</label>
                                        <input type="text" name="account_name" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                               placeholder="Name as it appears on bank account" value="{{ old('account_name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Upload Bank Slip (Optional)</h4>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 4.9V4a2 2 0 00-2-2H6a2 2 0 00-2 2v2.9z"/>
                                    </svg>
                                    <p class="text-gray-600 mb-4">Drag and drop your bank slip here or click to browse</p>
                                    <input type="file" name="bank_slip" accept="image/*,.pdf"
                                           class="hidden" onchange="handleFileSelect(this)">
                                    <button type="button" onclick="this.parentElement.querySelector('input[type=file]').click()"
                                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                                        Choose File
                                    </button>
                                </div>
                                <div id="filePreview" class="mt-3 hidden">
                                    <p class="text-sm text-gray-600 mb-1">Selected file:</p>
                                    <div class="bg-white border border-gray-200 rounded-lg p-3 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span id="fileName" class="text-sm font-medium text-gray-900"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h4>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description / Notes</label>
                                    <textarea name="description" rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                              placeholder="Any additional information...">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="bg-green-600 text-white px-12 py-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-lg shadow-lg">
                                    Submit Payment Verification
                                </button>
                                <p class="mt-4 text-sm text-gray-600">Your account will be activated within 10 minutes after successful verification</p>
                            </div>
                        </form>
                    </div>

                    <script>
                    function handleFileSelect(input) {
                        var file = input.files[0];
                        var preview = document.getElementById('filePreview');
                        var fileName = document.getElementById('fileName');
                        if (file) {
                            fileName.textContent = file.name;
                            preview.classList.remove('hidden');
                        } else {
                            preview.classList.add('hidden');
                        }
                    }
                    </script>
                    @endif
                </div>
                @endif
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

    levelSelected = true;
    checkProceed();
}

function checkProceed() {
    var btn = document.getElementById('proceedBtn');
    if (levelSelected) {
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // No payment method handlers needed in step 2
});
</script>
@endsection