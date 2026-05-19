@extends('layouts.yegara')

@section('title', 'How to Buy Domain and Hosting')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Article Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                </svg>
                How to Buy Domain and Hosting
            </h2>
            <span class="text-sm text-gray-500">July 13, 2023</span>
        </div>
        
        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-8">
            <span>12 Comments</span>
            <span>•</span>
            <span>Category: Getting Started</span>
        </div>
        
        <p class="text-lg text-gray-700 mb-8">
            The Most Intuitive & Easiest way to <strong>Register a domain and Host</strong> in Ethiopia! 
            Follow the steps below and you will be online in no time
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="flex items-center p-4 bg-green-50 rounded-lg">
                <svg class="w-6 h-6 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold text-green-800">Fully Automated</span>
            </div>
            <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h14a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z" clip-rule="evenodd"/>
                </svg>
                <span class="font-semibold text-blue-800">Convenient Payment Method</span>
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
                <h2 class="text-2xl font-bold text-gray-900">Select a Package</h2>
            </div>
            <p class="text-gray-700 mb-4">
                Navigate to <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-semibold">yegara.com</a> or 
                <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">my.yegara.com/order.php</a> 
                and go to the section where the available packages are listed. then click on "Order Now"
            </p>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600">
                    <strong>💡 Tip:</strong> Compare different packages to find the one that best suits your needs. 
                    Consider factors like storage, bandwidth, and number of domains.
                </p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    2
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                </svg>
                Payment Verification
            </h2>
            </div>
            <p class="text-gray-700 mb-6">
                Depending on your need select one of the options and submit your domain
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-colors">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Register Domain</h3>
                    </div>
                    <p class="text-gray-600 text-sm">if you want to buy a new Domain Name</p>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-colors">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 5a1 1 0 100 2h4a1 1 0 100-2H8z" clip-rule="evenodd"/>
                            <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Transfer Domain</h3>
                    </div>
                    <p class="text-gray-600 text-sm">if you have a domain and want to move your domain to Yegara</p>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-colors">
                    <div class="flex items-center mb-2">
                        <svg class="w-6 h-6 text-purple-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 00-.607.739L9.25 8.5H3a1 1 0 000 2h6.25l-2.251 2.681A1 1 0 007 14.08l7-3a1 1 0 00.394-1z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-900">Use My Own Domain</h3>
                    </div>
                    <p class="text-gray-600 text-sm">If you want to Buy Hosting Only</p>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    3
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Place Your Order</h2>
            </div>
            <p class="text-gray-700 mb-6">
                Fill out your name, phone, Email and choose a convenient Payment Method for you and Place your Order
            </p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-blue-900 mb-2">Required Information:</h4>
                <ul class="space-y-2 text-sm text-blue-800">
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Full Name (as appears on ID)
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Active Phone Number
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Valid Email Address
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Preferred Payment Method
                    </li>
                </ul>
                <p class="text-xl mb-8">
                    JOIN AFRONEX HOST TODAY!
                </p>
                <p class="text-xl mb-8">
                    ETHIOPIA'S BEST EXPERT WEB HOSTING
                </p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    4
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Make Payment</h2>
            </div>
            <p class="text-gray-700 mb-6">
                Go-ahead and Make a deposit in to the account you received!
            </p>
            
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-yellow-600 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-yellow-900 mb-2">Important:</h4>
                        <p class="text-sm text-yellow-800">
                            Keep your payment receipt or transaction reference number safe. 
                            You will need this for the next step to verify your payment.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-xl mr-4 flex-shrink-0">
                    5
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Confirm Payment</h2>
            </div>
            <p class="text-gray-700 mb-6">
                After Making a Deposit Open the invoice and click on the bank you used and Fill out Your Name, 
                The Transaction reference number, And Date and click on Submit Detail
            </p>
            
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-green-600 mr-3 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-green-900 mb-2">That's It!</h4>
                        <p class="text-sm text-green-800">
                            Your account will be Activated within <strong>10 Minutes</strong> after payment verification.
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
            <a href="#" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">How to install WordPress In Only One Click</h4>
                <p class="text-sm text-gray-600">Learn how to install WordPress with our one-click installer</p>
            </a>
            <a href="#" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">How to Create an Email Account in DirectAdmin</h4>
                <p class="text-sm text-gray-600">Step-by-step guide for setting up email accounts</p>
            </a>
            <a href="#" class="block bg-white rounded-lg shadow-sm p-4 hover:shadow-md transition-shadow">
                <h4 class="font-semibold text-gray-900 mb-2">Managing Your VPS</h4>
                <p class="text-sm text-gray-600">Complete guide to VPS management</p>
            </a>
        </div>
    </div>
</div>
@endsection
