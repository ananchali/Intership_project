@extends('layouts.yegara')

@section('title', 'Order Details - Payment Verification System')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md p-8 mb-8 border border-gray-100">
        <div class="flex justify-between items-start mb-8 pb-6 border-b border-gray-100">
            <div>
                <h2 class="text-2xl font-black text-gray-900 mb-2">Order Details</h2>
                <p class="text-gray-600">Order Number: <span class="font-mono font-bold text-blue-600 text-lg">{{ $order->order_number }}</span></p>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold tracking-wide shadow-sm
                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                    @elseif($order->status === 'verified') bg-green-100 text-green-800
                    @elseif($order->status === 'activated') bg-purple-100 text-purple-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Package Information -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Package Information
                </h3>
                <div class="space-y-2">
                    <p class="font-bold text-gray-900 text-lg">{{ $order->package->name }}</p>
                    <p class="text-gray-600 text-sm mb-4">{{ $order->package->description }}</p>
                    <p class="text-3xl font-black text-blue-600">{{ $order->formatted_amount }}</p>
                </div>
            </div>

            <!-- Domain Information -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 019 0 9 9 0 01-9 9z"></path></svg>
                    Domain Information
                </h3>
                <div class="space-y-2">
                    <p class="font-mono font-bold text-gray-900 text-lg">{{ $order->domain_name }}</p>
                    <p class="text-gray-600 text-sm mt-2">
                        Type: <span class="font-semibold text-gray-800">
                            @if($order->domain_type === 'register') New Registration
                            @elseif($order->domain_type === 'transfer') Transfer
                            @else Own Domain
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Customer Information
                </h3>
                <div class="space-y-2 text-sm">
                    <p class="font-bold text-gray-900 text-base">{{ $order->customer_details['name'] }}</p>
                    <p class="text-gray-600">Email: <span class="text-gray-800 font-medium">{{ $order->customer_details['email'] }}</span></p>
                    <p class="text-gray-600">Phone: <span class="text-gray-800 font-medium">{{ $order->customer_details['phone'] }}</span></p>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Payment Method
                </h3>
                <div class="space-y-2">
                    <p class="font-bold text-gray-900 text-base">
                        @if($order->payment_method === 'bank') Bank Deposit
                        @elseif($order->payment_method === 'mobile') Mobile Banking
                        @else {{ strtoupper($order->payment_method) }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Actions -->
    @if($order->status === 'pending')
    <div class="bg-white rounded-xl shadow-md p-8 mb-8 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Complete Your Payment</h3>
        <p class="text-gray-600 mb-6">
            Please make a deposit to our bank account and then submit your payment details below.
        </p>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <h4 class="font-bold text-blue-900 mb-3 text-base">Bank Account Details</h4>
            <div class="space-y-2 text-sm text-blue-800">
                <p><strong>Bank:</strong> Commercial Bank of Ethiopia</p>
                <p><strong>Account Name:</strong> Your Company Name</p>
                <p><strong>Account Number:</strong> <span class="font-mono font-bold text-base text-blue-900">1000123456</span></p>
                <p><strong>Amount:</strong> <span class="font-bold text-base text-blue-900">{{ $order->formatted_amount }}</span></p>
            </div>
        </div>
        <a href="{{ route('payments.create', $order->id) }}" 
           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-md">
            Submit Payment Details
        </a>
    </div>
    @endif

    <!-- Payment Status -->
    @if($order->payments->count() > 0)
    <div class="bg-white rounded-xl shadow-md p-8 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Payment Status</h3>
        @foreach($order->payments as $payment)
        <div class="border border-gray-150 rounded-xl p-6 space-y-4">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-bold text-gray-900">Transaction Reference: <span class="font-mono text-blue-600">{{ $payment->transaction_reference }}</span></p>
                    <p class="text-gray-600 text-sm">Bank: {{ $payment->bank_name }}</p>
                    <p class="text-gray-600 text-sm">Payment Date: {{ $payment->payment_date->format('M j, Y') }}</p>
                </div>
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold shadow-sm
                    @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($payment->status === 'verified') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>
            
            @if($payment->verification)
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 text-sm space-y-1">
                <p class="text-gray-700">
                    <strong>Verification Status:</strong> 
                    <span class="font-semibold @if($payment->verification->status === 'pending') text-yellow-600
                    @elseif($payment->verification->status === 'approved') text-green-600
                    @else text-red-600 @endif">
                        {{ ucfirst($payment->verification->status) }}
                    </span>
                </p>
                @if($payment->verification->admin_notes)
                <p class="text-gray-700">
                    <strong>Admin Notes:</strong> {{ $payment->verification->admin_notes }}
                </p>
                @endif
            </div>
            @endif

            <div class="pt-2">
                <a href="{{ route('payments.status', $order->id) }}" 
                   class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center gap-1">
                    View Payment Details →
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-1">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
