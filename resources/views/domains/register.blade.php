@extends('layouts.yegara')

@section('title', 'Register Domain - Afronexhost')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-8">
            <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="50" fill="#000000"/>
                <path d="M50 10 C30 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 90, 90 70, 90 50 C90 35, 75 15, 60 12" fill="#8B4513"/>
                <circle cx="35" cy="40" r="8" fill="#654321"/>
                <circle cx="65" cy="40" r="8" fill="#FF0000"/>
                <path d="M25 60 Q50 70, 75 60" stroke="#C0C0C0" stroke-width="2" fill="none"/>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Register Your Domain</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Find the perfect domain name for your website. Search and register your domain today.</p>
    </div>

    <!-- Domain Search -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-16">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Search for Your Domain</h2>
            <div class="flex flex-col sm:flex-row gap-4">
                <input type="text" placeholder="Enter your domain name (e.g., mywebsite.com)" class="flex-1 px-6 py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg">
                <button class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg">
                    Search
                </button>
            </div>
            <p class="text-sm text-gray-500 mt-4 text-center">Supported extensions: .com, .net, .org, .et, .io, .co, and more</p>
        </div>
    </div>

    <!-- Domain Pricing -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Popular Domain Extensions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-blue-600 mb-2">.com</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">500 ETB<span class="text-sm text-gray-500">/year</span></p>
                    <p class="text-gray-600 text-sm">Most popular extension</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-green-600 mb-2">.et</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">300 ETB<span class="text-sm text-gray-500">/year</span></p>
                    <p class="text-gray-600 text-sm">Ethiopian domain</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-purple-600 mb-2">.net</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">450 ETB<span class="text-sm text-gray-500">/year</span></p>
                    <p class="text-gray-600 text-sm">Network & tech</p>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-orange-600 mb-2">.org</h3>
                    <p class="text-3xl font-bold text-gray-900 mb-2">400 ETB<span class="text-sm text-gray-500">/year</span></p>
                    <p class="text-gray-600 text-sm">Organizations</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('domains.pricing') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                View Full Pricing →
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="bg-gray-50 rounded-2xl p-12 mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Register with Afronex Host?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Get more than just a domain name</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Instant Activation</h3>
                <p class="text-gray-600">Your domain is activated immediately after registration</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Free Privacy Protection</h3>
                <p class="text-gray-600">Keep your personal information private with WHOIS protection</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656 3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Easy Management</h3>
                <p class="text-gray-600">Manage DNS, forwarding, and settings from your dashboard</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="gradient-bg text-white py-16 rounded-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Your Domain?</h2>
            <p class="text-xl mb-8">Start your online journey today with Afronex Host</p>
            <a href="{{ route('packages.index') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
                Get Domain + Hosting
            </a>
        </div>
    </section>
</div>
@endsection
