@extends('layouts.yegara')

@section('title', 'How to Transfer Domain')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Article Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                How to Transfer Domain
            </h2>
            <span class="text-sm text-gray-500">July 13, 2023</span>
        </div>
        
        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-8">
            <span>5 Comments</span>
            <span>•</span>
            <span>Category: Domain Management</span>
        </div>
        
        <p class="text-lg text-gray-700 mb-8">
            Transfer your existing domain to Afronex Hosting and enjoy our reliable services! 
            Follow the steps below to complete your domain transfer.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="flex items-center p-4 bg-green-50 rounded-lg">
                <svg class="w-6 h-6 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold text-green-800">Seamless Transfer</span>
            </div>
            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h14a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z" clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold text-blue-800">No Downtime</span>
            </div>
        </div>
    </div>

    <!-- Steps -->
    <div class="space-y-8">
        <!-- Step 1 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    1
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Prepare Your Domain</h2>
            </div>
            <p class="text-gray-700 mb-4">
                Before initiating the transfer, ensure your domain meets the following requirements:
            </p>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Domain must be at least 60 days old
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Domain must not be expired or close to expiration
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Unlock the domain at your current registrar
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Obtain the EPP/Authorization code from current registrar
                    </li>
                </ul>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    2
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Initiate Transfer Order</h2>
            </div>
            <p class="text-gray-700 mb-6">
                Place a transfer order through our system:
            </p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <ol class="space-y-3 text-sm text-blue-800 list-decimal list-inside">
                    <li>Go to our <a href="{{ route('home') }}" class="underline font-semibold">homepage</a></li>
                    <li>Select a hosting package</li>
                    <li>Choose "Transfer Domain" option</li>
                    <li>Enter your domain name</li>
                    <li>Complete the order process</li>
                </ol>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    3
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Make Payment</h2>
            </div>
            <p class="text-gray-700 mb-6">
                Pay for the transfer service using your preferred payment method. The transfer fee includes one year of domain registration.
            </p>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-yellow-600 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-yellow-900 mb-2">Note:</h4>
                        <p class="text-sm text-yellow-800">
                            Keep your transaction reference number for payment verification.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    4
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Authorize Transfer</h2>
            </div>
            <p class="text-gray-700 mb-6">
                After payment verification, you'll receive an email from your current registrar to authorize the transfer. Follow the instructions in the email to approve the transfer.
            </p>
            
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                <h4 class="font-semibold text-purple-900 mb-2">Important:</h4>
                <p class="text-sm text-purple-800">
                    The transfer authorization email is usually sent to the domain's administrative contact. Check your spam folder if you don't see it within 24 hours.
                </p>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    5
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Transfer Complete</h2>
            </div>
            <p class="text-gray-700 mb-6">
                Domain transfers typically take 5-7 days to complete. Once transferred, you'll receive a confirmation email and your domain will be managed under your Afronex Hosting account.
            </p>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-green-600 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-green-900 mb-2">Success!</h4>
                        <p class="text-sm text-green-800">
                            Your domain is now with Afronex Hosting. Enjoy our reliable services and support!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div class="bg-white rounded-lg shadow-sm p-8 mt-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">How helpful was this article to you?</h3>
        <div class="flex flex-wrap gap-4">
            <button class="bg-green-100 text-green-800 px-6 py-3 rounded-lg hover:bg-green-200 transition-colors font-medium">
                😊 Very Helpful
            </button>
            <button class="bg-blue-100 text-blue-800 px-6 py-3 rounded-lg hover:bg-blue-200 transition-colors font-medium">
                🙂 Helpful
            </button>
            <button class="bg-gray-100 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                😐 Neutral
            </button>
            <button class="bg-red-100 text-red-800 px-6 py-3 rounded-lg hover:bg-red-200 transition-colors font-medium">
                😞 Not Helpful
            </button>
        </div>
    </div>

    <!-- Related Articles -->
    <div class="mt-12">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Related Articles</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('howto.buy') }}" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">How to Buy Domain and Hosting</h4>
                <p class="text-sm text-gray-600">Complete guide to purchasing domains and hosting</p>
            </a>
            <a href="{{ route('howto.hosting') }}" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">How to Get Hosting</h4>
                <p class="text-sm text-gray-600">Step-by-step guide to getting started with hosting</p>
            </a>
            <a href="{{ route('support') }}" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">Need Help?</h4>
                <p class="text-sm text-gray-600">Contact our support team for assistance</p>
            </a>
        </div>
    </div>
</div>
@endsection
