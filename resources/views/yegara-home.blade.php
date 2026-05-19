@extends('layouts.yegara')

@section('title', 'Ethiopia\'s Web Hosting and Domain Provider')

@section('content')
<!-- Hero Section -->
<section class="relative bg-blue-900 text-white min-h-[80vh] flex items-center pt-24 pb-32 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80" alt="Hosting Background" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-purple-900/90 to-blue-900/90"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10 w-full">
        <div class="text-center max-w-4xl mx-auto">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 font-bold tracking-wider text-sm mb-6 animate-pulse">
                🚀 NEW: NVMe SSD HOSTING
            </span>
            <h1 class="text-5xl md:text-7xl font-black mb-8 leading-tight tracking-tight drop-shadow-lg">
                Hosting for Ethiopia's <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Brilliant Businesses</span>
            </h1>
            <p class="text-xl md:text-2xl mb-12 text-gray-300 font-light max-w-3xl mx-auto">
                Join thousands of businesses on Ethiopia's fastest, most reliable, and secure web hosting platform.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('packages.index') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-blue-50 hover:scale-105 transition-all shadow-xl shadow-blue-900/50 flex items-center justify-center gap-2 group">
                    View Hosting Plans
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('howto.buy') }}" class="bg-transparent border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold hover:bg-white/10 hover:border-white transition-all backdrop-blur-sm flex items-center justify-center">
                    How to Buy
                </a>
            </div>
        </div>
    </div>
    
    <!-- Wave Shape Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-[calc(100%+1.3px)] h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.2,201.33,110.53Z" class="fill-white"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">
                Why Choose <span class="text-blue-600">Afronex</span>?
            </h2>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">Experience the perfect blend of performance, security, and exceptional support.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <div class="bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-300 transform hover:-translate-y-2 group border border-slate-100 hover:border-blue-100">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Lightning Fast</h3>
                <p class="text-gray-600 leading-relaxed">Powered by enterprise NVMe storage, delivering 3x faster read-write speeds than traditional SSDs for optimal performance.</p>
            </div>
            
            <div class="bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-purple-900/10 transition-all duration-300 transform hover:-translate-y-2 group border border-slate-100 hover:border-purple-100">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ironclad Security</h3>
                <p class="text-gray-600 leading-relaxed">Free SSL certificates, robust firewalls, and secure payment processing keep your data and your customers safe.</p>
            </div>
            
            <div class="bg-slate-50 p-10 rounded-3xl hover:bg-white hover:shadow-2xl hover:shadow-emerald-900/10 transition-all duration-300 transform hover:-translate-y-2 group border border-slate-100 hover:border-emerald-100">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">24/7 Expert Support</h3>
                <p class="text-gray-600 leading-relaxed">Our dedicated support team is available round the clock via Telegram and email to help you succeed.</p>
            </div>
        </div>
    </div>
</section>

<!-- Premium Hosting Section -->
<section class="py-24 bg-slate-50 border-t border-gray-100 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-purple-500/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-blue-500/10 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 p-8 md:p-16 border border-slate-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block py-1 px-3 rounded-full bg-purple-100 text-purple-700 font-bold tracking-wider text-xs mb-6 uppercase">Unmatched Value</span>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-8 leading-tight">
                        Premium Hosting, <br>Zero Compromises
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start bg-slate-50 p-4 rounded-2xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-900 text-lg">UNLIMITED NVMe Storage</h4>
                                <p class="text-gray-500 mt-1">NVMe has 3x Read-Write Speed and can transfer data 25 times faster than standard SSD</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-slate-50 p-4 rounded-2xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-900 text-lg">UNLIMITED Bandwidth</h4>
                                <p class="text-gray-500 mt-1">Never worry about traffic spikes with unmetered data transfer</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-slate-50 p-4 rounded-2xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mt-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-900 text-lg">Free .COM Domain</h4>
                                <p class="text-gray-500 mt-1">Included free of charge with all annual hosting plans</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <!-- Tech illustration/graphic area -->
                    <div class="aspect-square bg-gradient-to-tr from-blue-600 to-purple-600 rounded-full p-2 relative shadow-2xl shadow-purple-900/20">
                        <div class="absolute inset-0 bg-white/10 rounded-full backdrop-blur-sm"></div>
                        <div class="w-full h-full bg-gray-900 rounded-full flex flex-col items-center justify-center text-center p-12 relative overflow-hidden border-8 border-gray-900">
                            <!-- Abstract tech circles inside -->
                            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at center, white 1px, transparent 1px); background-size: 20px 20px;"></div>
                            
                            <h3 class="text-white text-3xl font-black mb-2 relative z-10">Start Building</h3>
                            <p class="text-gray-400 mb-8 relative z-10">Everything you need to launch.</p>
                            
                            <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-8 py-4 rounded-xl font-bold hover:shadow-lg hover:shadow-purple-500/50 transition-all transform hover:-translate-y-1 relative z-10 inline-block">
                                View Packages
                            </a>
                        </div>
                    </div>
                    
                    <!-- Floating achievement badge -->
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl">🏆</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Ranked</p>
                            <p class="text-lg font-black text-gray-900">#1 in Ethiopia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gray-900 text-white py-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at center, white 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-black mb-6 tracking-tight">
            Ready to Take Your Website to the Next Level?
        </h2>
        <p class="text-xl mb-10 text-gray-400 max-w-2xl mx-auto">
            Join the thousands of developers and businesses who trust Afronex with their online presence.
        </p>
        <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-10 py-5 rounded-xl font-bold hover:shadow-lg hover:shadow-purple-500/30 transition-all transform hover:scale-105 inline-block text-lg border border-white/10">
            Get Started Today
        </a>
    </div>
</section>
@endsection
