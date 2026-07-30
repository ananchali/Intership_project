@extends('layouts.yegara')

@section('title', 'Payment Status - Afronexhost')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Status Header -->
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <div class="text-center mb-8">
            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-white" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="50" fill="#000000"/>
                    <path d="M50 10 C30 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 90, 90 70, 90 50 C90 35, 75 15, 60 12" fill="#8B4513"/>
                    <circle cx="35" cy="40" r="8" fill="#654321"/>
                    <circle cx="65" cy="40" r="8" fill="#FF0000"/>
                    <path d="M25 60 Q50 70, 75 60" stroke="#C0C0C0" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Verification Status</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Check the status of your payment verification and track your hosting activation progress.
            </p>
        </div>
    </div>

    <!-- Status Check Form -->
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Check Your Verification Status
        </h2>
        
        <form method="GET" action="{{ route('payment-status.check') }}" class="space-y-6">
            <div>
                <label for="order_id" class="block text-sm font-medium text-gray-700 mb-2">Order ID / Invoice Number</label>
                <div class="flex gap-4">
                    <input type="text" id="order_id" name="order_id" required
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g., INV-2024-001" value="{{ request('order_id') }}">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                        Check Status
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Verification Results -->
    @if(isset($verification))
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <div class="border-l-4 {{ $verification->status === 'approved' ? 'border-green-500' : ($verification->status === 'rejected' ? 'border-red-500' : 'border-yellow-500') }} pl-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 {{ $verification->status === 'approved' ? 'bg-green-100' : ($verification->status === 'rejected' ? 'bg-red-100' : 'bg-yellow-100') }} rounded-full flex items-center justify-center mr-4">
                    @if($verification->status === 'approved')
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @elseif($verification->status === 'rejected')
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Verification {{ ucfirst($verification->status) }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        {{ $verification->created_at->format('F j, Y \a\t g:i A') }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Order Information</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Order Number:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->payment->order->order_number ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Package:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->payment->order->package->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Amount:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->payment->formatted_amount }}</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Payment Details</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Transaction Reference:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->transaction_reference ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Bank:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->bank_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Payment Date:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $verification->payment_date->format('M j, Y') ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($verification->admin_notes)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-semibold text-gray-900 mb-2">Admin Notes</h4>
                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">{{ $verification->admin_notes }}</p>
            </div>
            @endif

            @if($verification->status === 'approved')
            <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <h4 class="text-sm font-semibold text-green-800 mb-2">🎉 Hosting Activated!</h4>
                <p class="text-sm text-green-700">
                    Your payment has been verified and your hosting account is now active. You can access your hosting control panel using the credentials sent to your email.
                </p>
                <div class="mt-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                        Contact Support
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @elseif($verification->status === 'rejected')
            <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h4 class="text-sm font-semibold text-red-800 mb-2">❌ Payment Verification Rejected</h4>
                <p class="text-sm text-red-700">
                    Unfortunately, your payment verification was rejected. Please review the admin notes below and contact support if you need assistance.
                </p>
                <div class="mt-4">
                    <a href="{{ route('payment.verify') }}?order_id={{ $verification->payment->order->order_number }}" class="inline-flex items-center text-red-600 hover:text-red-800 font-medium">
                        Resubmit Payment
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @else
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h4 class="text-sm font-semibold text-yellow-800 mb-2">⏳ Verification Pending</h4>
                <p class="text-sm text-yellow-700">
                    Your payment verification is currently under review. We'll process it as soon as possible. You can check back here for updates.
                </p>
                <div class="mt-4">
                    <p class="text-xs text-yellow-600">
                        <strong>Expected Processing Time:</strong> 1-2 business hours
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Help Section -->
    <div class="bg-white rounded-lg shadow-sm p-8">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Need Help?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.003 9.003 0 00-9-9c0 1.652.316 3.224.874 4.418l6.626 6.626A10.003 10.003 0 0022 12c0-4.418-4.03-8-9-8a9.003 9.003 0 00-9 9c0 1.652-.316 3.224-.874 4.418l6.626-6.626A10.003 10.003 0 002 12z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Live Chat</h4>
                <p class="text-gray-600 text-sm mb-3">Get instant help via Telegram</p>
                <a href="https://t.me/afronexhost" target="_blank" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Chat Now
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Email Support</h4>
                <p class="text-gray-600 text-sm mb-3">Send us an email anytime</p>
                <a href="mailto:support@afronexhost.com" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Email Us
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 19 7.5 19s3.332-.523 4.246-1.247V6.253z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Knowledgebase</h4>
                <p class="text-gray-600 text-sm mb-3">Browse helpful articles</p>
                <a href="{{ route('howto.buy') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Browse Articles
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
