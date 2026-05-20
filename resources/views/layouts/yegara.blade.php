<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Afronexhost</title>
    @vite(['resources/css/app.css', 'resources/css/glassmorphism.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #1a202c;
            line-height: 1.6;
        }
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .mobile-menu {
            display: none;
        }
        @media (max-width: 768px) {
            .mobile-menu {
                display: block;
            }
            .desktop-menu {
                display: none;
            }
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-33.33%); }
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-50">
    <!-- Top Banner -->
    <div class="gradient-bg text-white py-2 px-4 overflow-hidden relative">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-sm relative">
            <div class="flex-1 overflow-hidden whitespace-nowrap">
                <div class="inline-block" style="animation: marquee 15s linear infinite;">
                    <span class="mr-12 font-black tracking-widest text-yellow-300">AFRONEX HOSTING CLONE</span>
                    <span class="mr-12 font-black tracking-widest text-yellow-300">AFRONEX HOSTING CLONE</span>
                    <span class="mr-12 font-black tracking-widest text-yellow-300">AFRONEX HOSTING CLONE</span>
                    <span class="mr-12 font-black tracking-widest text-yellow-300">AFRONEX HOSTING CLONE</span>
                </div>
            </div>
            <div class="hidden md:flex space-x-6 flex-shrink-0 bg-transparent pl-4 items-center">
                <a href="tel:+251911234567" class="hover:text-yellow-300 transition-colors font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    +251 902496151
                </a>
                <a href="mailto:support@yegara.com" class="hover:text-yellow-300 transition-colors font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    support@afronexhost.com
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-50 transition-all duration-300 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-md group-hover:shadow-lg transition-all duration-300 transform group-hover:scale-105 bg-white flex items-center justify-center border-2 border-transparent group-hover:border-blue-100">
                            <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                        </div>
                        <span class="text-2xl font-black text-gray-900 tracking-tight transition-colors group-hover:text-blue-600">AFRONEX<span class="text-blue-600 group-hover:text-purple-600">HOST</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="desktop-menu hidden md:flex items-center space-x-8">
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 font-medium">
                            <span data-i18n="web-hosting">Web Hosting</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('packages.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600" data-i18n="shared-hosting">Shared Hosting</a>
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 font-medium">
                            <span data-i18n="how-to">How To</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('howto.buy') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600" data-i18n="buy-domain-hosting">Buy Domain & Hosting</a>
                            <a href="{{ route('howto.hosting') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600" data-i18n="buy-hosting-only">Buy Hosting Only</a>
                            <a href="{{ route('howto.transfer') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600" data-i18n="transfer-to-afronex">Transfer to Afronex</a>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium" data-i18n="contact">Contact</a>
                    
                    <!-- Multilingual Switcher Dropdown -->
                    @include('partials.language_switcher')

                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 mr-4" data-i18n="dashboard">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0v7a4 4 0 018 0h2a2 2 0 002-2v-4a2 2 0 00-2-2H6a2 2 0 00-2 2v4a2 2 0 002 2z"></path></svg>
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-medium bg-transparent border-none cursor-pointer" data-i18n="logout">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium" data-i18n="login">Login</a>
                    @endauth
                </nav>

                <!-- Mobile Menu Button -->
                <button class="mobile-menu p-2 rounded-lg text-gray-700 hover:bg-gray-100" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden fixed top-0 left-0 w-full h-full bg-white z-50 overflow-y-auto">
            <div class="p-4">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center mr-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                        </div>
                        <span class="text-xl font-black text-gray-900 tracking-tight">AFRONEX<span class="text-blue-600">HOST</span></span>
                    </div>
                    <button onclick="toggleMobileMenu()" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <nav class="space-y-4">
                    <div class="border-t pt-4">
                        <h3 class="font-semibold text-gray-900 mb-3">Web Hosting</h3>
                        <div class="space-y-2">
                            <a href="{{ route('packages.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Shared Hosting</a>
                            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Free Hosting</a>
                            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">VPS Hosting</a>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h3 class="font-semibold text-gray-900 mb-3">How To</h3>
                        <div class="space-y-2">
                            <a href="{{ route('howto.buy') }}" class="block py-2 text-gray-700 hover:text-blue-600">Buy Domain & Hosting</a>
                            <a href="{{ route('howto.hosting') }}" class="block py-2 text-gray-700 hover:text-blue-600">Buy Hosting Only</a>
                            <a href="{{ route('howto.transfer') }}" class="block py-2 text-gray-700 hover:text-blue-600">Transfer to Afronex</a>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4 space-y-2">
                        <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a>
                        @auth
                            <a href="{{ route('customer.dashboard') }}" class="block py-2 text-blue-600 hover:text-blue-800 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-blue-600">Login</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg bg-white flex items-center justify-center mr-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                        </div>
                        <span class="text-2xl font-black">AFRONEX<span class="text-blue-400">HOST</span></span>
                    </div>
                    <!-- <p class="text-gray-400 mb-4">Ethiopia's #1 Web Hosting and Domain Provider. Fast, reliable, and affordable hosting solutions.</p>
                    <p class="text-xl mb-8">
                    JOIN AFRONEX HOST TODAY!
                </p>
                <p class="text-xl mb-8">
                    ETHIOPIA'S BEST EXPERT WEB HOSTING
                </p> -->
                    <!-- <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 00-2.825-.775 9.994 9.994 0 014.195 5.054c3.78 4.145 5.909 9.092 5.909 14.326a9.97 9.97 0 01-1.847 2.933 11.045 11.045 0 01-2.833 2.317A11.031 11.031 0 0112 22.933a11.03 11.031 0 01-6.676-2.317 11.045 11.045 0 01-2.833-2.317A9.97 9.97 0 011.645 14.3c0-5.234 2.129-10.181 5.909-14.326a9.994 9.994 0 014.195-5.054 4.958 4.958 0 00-2.825.775 10 10 0 01-2.825-.775z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 00-2.825-.775 9.994 9.994 0 014.195 5.054c3.78 4.145 5.909 9.092 5.909 14.326a9.97 9.97 0 01-1.847 2.933 11.045 11.045 0 01-2.833 2.317A11.031 11.031 0 0112 22.933a11.03 11.031 0 01-6.676-2.317 11.045 11.045 0 01-2.833-2.317A9.97 9.97 0 011.645 14.3c0-5.234 2.129-10.181 5.909-14.326a9.994 9.994 0 014.195-5.054 4.958 4.958 0 00-2.825.775 10 10 0 01-2.825-.775z"/>
                            </svg>
                        </a>
                    </div> -->
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4">Hosting</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white">Shared Hosting</a></li>
                        <li><a href="#" class="hover:text-white">Free Hosting</a></li>
                        <li><a href="#" class="hover:text-white">VPS Hosting</a></li>
                        <li><a href="#" class="hover:text-white">Dedicated Servers</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4">Domains</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Register Domain</a></li>
                        <li><a href="#" class="hover:text-white">Transfer Domain</a></li>
                        <li><a href="#" class="hover:text-white">Domain Pricing</a></li>
                        <li><a href="#" class="hover:text-white">WHOIS Lookup</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4">Support</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('howto.buy') }}" class="hover:text-white">Knowledgebase</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white">Contact Us</a></li>
                        <!-- <li><a href="#" class="hover:text-white">Live Chat</a></li> -->
                        <li><a href="#" class="hover:text-white">Service Status</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} AFRONEX HOST. All rights reserved.</p>
                <!-- <p class="mt-2">Powered by <a href="#" class="text-blue-400 hover:text-blue-300">ClientExec</a></p>
            </div> -->
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const button = event.target.closest('button');
            
            if (!menu.contains(event.target) && !button) {
                menu.classList.add('hidden');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
