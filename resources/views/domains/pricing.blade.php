@extends('layouts.yegara')

@section('title', 'Domain Pricing - Afronexhost')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-16">
        <!-- <div class="w-24 h-24 gradient-bg rounded-full flex items-center justify-center mx-auto mb-8">
            <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="50" fill="#000000"/>
                <path d="M50 10 C30 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 90, 90 70, 90 50 C90 35, 75 15, 60 12" fill="#8B4513"/>
                <circle cx="35" cy="40" r="8" fill="#654321"/>
                <circle cx="65" cy="40" r="8" fill="#FF0000"/>
                <path d="M25 60 Q50 70, 75 60" stroke="#C0C0C0" stroke-width="2" fill="none"/>
            </svg>
        </div> -->
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Domain Pricing</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Transparent pricing for all domain extensions. No hidden fees.</p>
    </div>

    <!-- Pricing Table -->
    <section class="mb-16">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="gradient-bg text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Extension</th>
                        <th class="px-6 py-4 text-center">1 Year</th>
                        <th class="px-6 py-4 text-center">2 Years</th>
                        <th class="px-6 py-4 text-center">5 Years</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-blue-600 mr-3">.com</span>
                                <span class="text-gray-600">Most Popular</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">500 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">900 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">2,000 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-green-600 mr-3">.et</span>
                                <span class="text-gray-600">Ethiopian</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">300 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">550 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,200 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-purple-600 mr-3">.net</span>
                                <span class="text-gray-600">Network</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">450 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">820 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,800 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-orange-600 mr-3">.org</span>
                                <span class="text-gray-600">Organization</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">400 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">750 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,600 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-red-600 mr-3">.io</span>
                                <span class="text-gray-600">Tech Startups</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">600 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,100 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">2,400 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-teal-600 mr-3">.co</span>
                                <span class="text-gray-600">Business</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">550 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,000 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">2,200 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-indigo-600 mr-3">.info</span>
                                <span class="text-gray-600">Information</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">350 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">650 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,400 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-pink-600 mr-3">.biz</span>
                                <span class="text-gray-600">Business</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-semibold">380 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">700 ETB</td>
                        <td class="px-6 py-4 text-center font-semibold">1,500 ETB</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('domains.register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                                Register
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Info Section -->
    <section class="bg-gray-50 rounded-2xl p-12 mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">What's Included</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Every domain registration includes these features</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Free SSL Certificate</h3>
                <p class="text-gray-600">Secure your website with free SSL</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Privacy Protection</h3>
                <p class="text-gray-600">Hide your personal information</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">DNS Management</h3>
                <p class="text-gray-600">Full control over your DNS records</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656 3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">24/7 Support</h3>
                <p class="text-gray-600">Round-the-clock customer support</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="gradient-bg text-white py-16 rounded-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Register Your Domain?</h2>
            <p class="text-xl mb-8">Search and register your perfect domain name today</p>
            <a href="{{ route('domains.register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg hover:bg-gray-100 transition-colors font-semibold text-lg">
                Search Domains
            </a>
        </div>
    </section>
</div>
@endsection
