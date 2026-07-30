@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 text-center">

        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-2">Payment Verification Submitted!</h1>
        <p class="text-base text-gray-600 mb-2">Thank you for your payment!</p>

        <p class="text-sm text-gray-500 leading-relaxed mb-6">
            We have received your payment verification details. Your payment will be reviewed and your account will be activated within 10 minutes once verification is complete.
        </p>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 mb-6">
            <p class="font-semibold text-gray-900 mb-2">Need Help?</p>
            <p class="text-sm text-gray-500">Contact us at <a href="mailto:support@afronexhosting.com" class="text-blue-600 hover:text-blue-700 font-medium">support@afronexhosting.com</a> or call us at +251911234567.</p>
        </div>

        <a href="/" class="inline-flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Return to Home
        </a>

    </div>
</div>

@endsection
