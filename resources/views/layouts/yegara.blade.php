<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Afronexhost</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <div class="relative inline-block text-left" id="lang-switcher">
                        <button type="button" onclick="toggleLangDropdown(event)" class="inline-flex justify-center items-center gap-2 rounded-xl bg-gray-50 border border-gray-200 px-3 py-1.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-100 transition-colors" id="menu-button" aria-expanded="false" aria-haspopup="true">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                            <span id="current-lang-name">English</span>
                            <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="absolute right-0 z-50 mt-2 w-44 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black/5 focus:outline-none transition-all duration-200 hidden" id="lang-dropdown" role="menu">
                            <div class="py-1.5 p-1" role="none">
                                <a href="javascript:void(0)" onclick="setLanguage('en')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇬🇧 English</a>
                                <a href="javascript:void(0)" onclick="setLanguage('am')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 አማርኛ (Amharic)</a>
                                <a href="javascript:void(0)" onclick="setLanguage('om')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 Oromoo (Oromo)</a>
                                <a href="javascript:void(0)" onclick="setLanguage('so')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇸🇴 Soomaali (Somali)</a>
                            </div>
                        </div>
                    </div>

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

        // Multilingual Translation System (English, Amharic, Oromo, Somali)
        const translations = {
            en: {
                "contact": "Contact",
                "login": "Login",
                "logout": "Logout",
                "dashboard": "Dashboard",
                "web-hosting": "Web Hosting",
                "shared-hosting": "Shared Hosting",
                "how-to": "How To",
                "buy-domain-hosting": "Buy Domain & Hosting",
                "buy-hosting-only": "Buy Hosting Only",
                "transfer-to-afronex": "Transfer to Afronex",
                "marquee-text": "AFRONEX HOSTING CLONE",
                "choose-package": "Choose Your Package",
                "choose-package-sub": "Select the perfect hosting or domain package tailored to your needs. Our solutions are designed to help you succeed online.",
                "hosting-packages": "Hosting Packages",
                "starter-hosting": "Starter Hosting",
                "popular": "Popular",
                "month": "/month",
                "starter-nvme": "5 GB NVMe Storage",
                "starter-bandwidth": "50 GB Bandwidth",
                "starter-emails": "5 Email Accounts",
                "starter-domains": "1 Free Domain",
                "select-starter": "Select Starter",
                "recommended": "Recommended",
                "best-value": "Best Value",
                "professional-hosting": "Professional Hosting",
                "pro-nvme": "15 GB NVMe Storage",
                "pro-bandwidth": "150 GB Bandwidth",
                "pro-emails": "15 Email Accounts",
                "pro-domains": "2 Free Domains",
                "pro-ssl": "SSL Certificate",
                "select-pro": "Select Professional",
                "advanced": "Advanced",
                "business-hosting": "Business Hosting",
                "biz-nvme": "50 GB NVMe Storage",
                "biz-bandwidth": "Unlimited Bandwidth",
                "biz-emails": "Unlimited Email Accounts",
                "biz-domains": "5 Free Domains",
                "biz-support": "Priority Support",
                "select-biz": "Select Business",
                "why-choose": "Why Choose Afronex Host?",
                "why-choose-sub": "We provide reliable hosting solutions with unmatched features and support",
                "lightning-fast": "Lightning Fast",
                "lightning-fast-desc": "NVMe storage with 3x faster speeds than traditional SSD",
                "secure-reliable": "Secure & Reliable",
                "secure-reliable-desc": "SSL certificates and secure payment processing",
                "support-247": "24/7 Support",
                "support-247-desc": "Round-the-clock customer support via Telegram and email",
                "hero-badge": "🚀 NEW: NVMe SSD HOSTING",
                "hero-title-main": "Hosting for Ethiopia's ",
                "hero-title-sub": "Brilliant Businesses",
                "hero-desc": "Join thousands of businesses on Ethiopia's fastest, most reliable, and secure web hosting platform.",
                "view-plans": "View Hosting Plans",
                "how-to-buy": "How to Buy",
                "unmatched-value": "Unmatched Value",
                "premium-title": "Premium Hosting, Zero Compromises",
                "cpanel-access": "Full cPanel Control",
                "cpanel-desc": "Manage your databases, files, and domains easily with full cPanel dashboard access.",
                "uptime-guarantee": "99.9% Uptime Guarantee",
                "uptime-desc": "Enterprise-grade server reliability keeps your website online and responsive 24/7.",
                "round-clock": "Round-the-Clock Monitoring",
                "round-clock-desc": "Proactive security scans and backups guard your business against threats."
            },
            am: {
                "contact": "ያግኙን",
                "login": "ግባ",
                "logout": "ውጣ",
                "dashboard": "ዳሽቦርድ",
                "web-hosting": "ዌብ ሆስቲንግ",
                "shared-hosting": "የጋራ ሆስቲንግ",
                "how-to": "እንዴት እንደሚሰራ",
                "buy-domain-hosting": "ዶሜን እና ሆስቲንግ መግዛት",
                "buy-hosting-only": "ሆስቲንግ ብቻ መግዛት",
                "transfer-to-afronex": "ወደ አፍሮኔክስ ማዛወር",
                "marquee-text": "አፍሮኔክስ የዌብ ሆስቲንግ እና የዶሜን አቅራቢ",
                "choose-package": "የሆስቲንግ ፓኬጅዎን ይምረጡ",
                "choose-package-sub": "ለእርስዎ ፍላጎት ተስማሚ የሆነውን የዌብ ሆስቲንግ ወይም የዶሜን ፓኬጅ ይምረጡ። የእኛ መፍትሄዎች በመስመር ላይ ስኬታማ እንዲሆኑ የተነደፉ ናቸው።",
                "hosting-packages": "የሆስቲንግ ፓኬጆች",
                "starter-hosting": "ጀማሪ ሆስቲንግ (Starter)",
                "popular": "ተመራጭ",
                "month": "/በወር",
                "starter-nvme": "5 ጂቢ የኤንቪኤምኢ ስቶሬጅ",
                "starter-bandwidth": "50 ጂቢ የባንድዊድዝ መጠን",
                "starter-emails": "5 የኢሜይል አካውንቶች",
                "starter-domains": "1 ነፃ ዶሜን",
                "select-starter": "ጀማሪን ይምረጡ",
                "recommended": "ተመራጭ",
                "best-value": "ምርጥ ዋጋ",
                "professional-hosting": "ባለሙያ ሆስቲንግ (Professional)",
                "pro-nvme": "15 ጂቢ የኤንቪኤምኢ ስቶሬጅ",
                "pro-bandwidth": "150 ጂቢ የባንድዊድዝ መጠን",
                "pro-emails": "15 የኢሜይል አካውንቶች",
                "pro-domains": "2 ነፃ ዶሜኖች",
                "pro-ssl": "የኤስኤስኤል ሰርተፊኬት",
                "select-pro": "ባለሙያን ይምረጡ",
                "advanced": "የላቀ",
                "business-hosting": "የንግድ ሆስቲንግ (Business)",
                "biz-nvme": "50 ጂቢ የኤንቪኤምኢ ስቶሬጅ",
                "biz-bandwidth": "ያልተገደበ የባንድዊድዝ መጠን",
                "biz-emails": "ያልተገደበ የኢሜይል አካውንቶች",
                "biz-domains": "5 ነፃ ዶሜኖች",
                "biz-support": "ቅድሚያ የሚሰጠው ድጋፍ",
                "select-biz": "የንግድን ይምረጡ",
                "why-choose": "ለምን አፍሮኔክስን ይመርጣሉ?",
                "why-choose-sub": "ተወዳዳሪ የሌላቸው ባህሪያት እና አስተማማኝ የሆስቲንግ አገልግሎቶችን ከሙሉ ድጋፍ ጋር እናቀርባለን",
                "lightning-fast": "እጅግ በጣም ፈጣን",
                "lightning-fast-desc": "ከባህላዊ ኤስኤስዲ 3 እጥፍ ፈጣን ፍጥነት ያለው የኤንቪኤምኢ ስቶሬጅ",
                "secure-reliable": "ደህንነቱ የተጠበቀ እና አስተማማኝ",
                "secure-reliable-desc": "የኤስኤስኤል ሰርተፊኬቶች እና ደህንነቱ የተጠበቀ ክፍያ",
                "support-247": "የ24/7 የደንበኛ ድጋፍ",
                "support-247-desc": "በቴሌግራም እና በኢሜይል አማካኝነት የ24 ሰዓት ቀጣይነት ያለው ድጋፍ",
                "hero-badge": "🚀 አዲስ፦ NVMe SSD ሆስቲንግ",
                "hero-title-main": "ለኢትዮጵያ አስደናቂ ",
                "hero-title-sub": "ንግዶች የተዘጋጀ ሆስቲንግ",
                "hero-desc": "በኢትዮጵያ ፈጣን፣ እጅግ አስተማማኝ እና ደህንነቱ የተጠበቀ የዌብ ሆስቲንግ ፕላትፎርም ላይ በሺዎች የሚቆጠሩ ንግዶችን ይቀላቀሉ።",
                "view-plans": "የሆስቲንግ ፓኬጆችን ይመልከቱ",
                "how-to-buy": "እንዴት እንደሚገዛ",
                "unmatched-value": "ተወዳዳሪ የሌለው ዋጋ",
                "premium-title": "ፕሪሚየም ሆስቲንግ፣ ያለምንም ስምምነት",
                "cpanel-access": "ሙሉ የሲፓነል (cPanel) ቁጥጥር",
                "cpanel-desc": "በቀላሉ ሙሉ የሲፓነል ዳሽቦርድ መዳረሻን በመጠቀም የውሂብ ጎታዎችን፣ ፋይሎችን እና ዶሜኖችን ያስተዳድሩ።",
                "uptime-guarantee": "የ99.9% ቀጣይነት ዋስትና",
                "uptime-desc": "በከፍተኛ ደረጃ የተገነቡ ሰርቨሮቻችን ዌብሳይትዎ በቀን 24 ሰዓት በመስመር ላይ ንቁ እንዲሆን ያደርጋሉ።",
                "round-clock": "የ24 ሰዓት ቁጥጥር እና ክትትል",
                "round-clock-desc": "ንግድዎን ከስጋቶች ለመጠበቅ ንቁ የደህንነት ቅኝቶችን እና ምትኬዎችን (Backups) እናዘጋጃለን።"
            },
            om: {
                "contact": "Quunnamaa",
                "login": "Seeni",
                "logout": "Ba'i",
                "dashboard": "Daashboordii",
                "web-hosting": "Weeb Hosting",
                "shared-hosting": "Hosting Waliinii",
                "how-to": "Akkaataa Hojii",
                "buy-domain-hosting": "Domeenii fi Hosting Bitachuu",
                "buy-hosting-only": "Hosting Qofa Bitachuu",
                "transfer-to-afronex": "Gara Afronextti Dabarsuu",
                "marquee-text": "AFRONEX HOSTING PAATEE DOMEENII FI HOOSTINGII",
                "choose-package": "Paakeejii Keessan Filadhaa",
                "choose-package-sub": "Paakeejii hoostingii ykn domeenii fedhii keessaniif ta'u filadhaa. Deebiin keenya toora interneetii irratti akka milkooftaniif kan qophaa'eedha.",
                "hosting-packages": "Paakeejiiwwan Hosting",
                "starter-hosting": "Hosting Jalqabaa (Starter)",
                "popular": "Jaallatamaa",
                "month": "/ji'aan",
                "starter-nvme": "Kuusaa NVMe 5 GB",
                "starter-bandwidth": "Bandwidth 50 GB",
                "starter-emails": "Imeeliiwwan 5",
                "starter-domains": "Domeenii Bilisaa 1",
                "select-starter": "Starter Filadhaa",
                "recommended": "Gorfamaa",
                "best-value": "Gatiin Gaarii",
                "professional-hosting": "Hosting Ogeessaa (Professional)",
                "pro-nvme": "Kuusaa NVMe 15 GB",
                "pro-bandwidth": "Bandwidth 150 GB",
                "pro-emails": "Imeeliiwwan 15",
                "pro-domains": "Domeenii Bilisaa 2",
                "pro-ssl": "Waraqaa SSL Bilisaa",
                "select-pro": "Professional Filadhaa",
                "advanced": "Dabalataa",
                "business-hosting": "Hosting Daldalaa (Business)",
                "biz-nvme": "Kuusaa NVMe 50 GB",
                "biz-bandwidth": "Bandwidth Daangaa Hin Qabne",
                "biz-emails": "Imeeliiwwan Daangaa Hin Qabne",
                "biz-domains": "Domeenii Bilisaa 5",
                "biz-support": "Gargaarsa Dursa Qabu",
                "select-biz": "Business Filadhaa",
                "why-choose": "Maaliif Afronex Host Filattu?",
                "why-choose-sub": "Tajaajila hosting amansiisaa ta'e amaloota fi gargaarsa wal hin Gitneen isiniif ni dhiheessina",
                "lightning-fast": "Saffisa Daangaa Hin Qabne",
                "lightning-fast-desc": "Kuusaa NVMe saffisa kuusaa SSD caalaa dachaa 3 qabu",
                "secure-reliable": "Nageesaa fi Amanamaa",
                "secure-reliable-desc": "Sertifikeetii SSL fi sirna kaffaltii amansiisaa ta'e",
                "support-247": "Gargaarsa 24/7",
                "support-247-desc": "Tajaajila gargaarsaa sa'aatii 24 guutuu Telegram fi imeeliin kennamu",
                "hero-badge": "🚀 HAARA: HOSTING SSD NVMe",
                "hero-title-main": "Daldala Itoophiyaa ",
                "hero-title-sub": "Bifaa fi Adda Ta'eef Hosting",
                "hero-desc": "Kumaatamaan kan lakkaa'aman daldaltoota saffisa, amanamummaa fi tajaajila gaarii Afronexhost filatan wajjiin ta'aa.",
                "view-plans": "Paakeejiiwwan Hosting Miriqi",
                "how-to-buy": "Akkaataa Itti Bitamu",
                "unmatched-value": "Gatiin Adda Ta'e",
                "premium-title": "Martigelin Premium, Kompromiisii Malee",
                "cpanel-access": "To'annoo cPanel Guutuu",
                "cpanel-desc": "Kuusaa odeeffannoo, faayilota fi domeenii keessan salphaatti daashboordii cPanel fayyadamuun to'adhaa.",
                "uptime-guarantee": "Wabii Hojii (Uptime) 99.9%",
                "uptime-desc": "Sirni server keenya tajaajila addaan hin cinne sa'aatii 24 guutuu akka argattu taasisa.",
                "round-clock": "Hordoffii Sa'aatii 24",
                "round-clock-desc": "Tajaajilni keenya daldala keessan balaa irraa eeguuf yeroo hunda hordoffii nageenyaa ni taasisa."
            },
            so: {
                "contact": "La Soo Xiriir",
                "login": "Gal",
                "logout": "Ka bax",
                "dashboard": "Kontroolka",
                "web-hosting": "Martigelinta",
                "shared-hosting": "Martigelinta Wadaaga",
                "how-to": "Sida ay u Shaqeyso",
                "buy-domain-hosting": "Iibso Domain & Martigelin",
                "buy-hosting-only": "Iibso Martigelin Kaliya",
                "transfer-to-afronex": "U Wareeji Afronex",
                "marquee-text": "ADEEGGA MARTIGELINTA IYO DOMAIN-KA AFRONEX",
                "choose-package": "Dooro Xirmadaada Martigelinta",
                "choose-package-sub": "Dooro xirmada ugu habboon ee martigelinta ama domainka ee ku habboon baahiyahaaga. Xalalkayagu waxay u qaabaysan yihiin inay kaa caawiyaan guusha online-ka.",
                "hosting-packages": "Xirmooyinka Martigelinta",
                "starter-hosting": "Martigelinta Bilowga (Starter)",
                "popular": "Ugu Caansan",
                "month": "/bishii",
                "starter-nvme": "Kaydka 5 GB NVMe SSD",
                "starter-bandwidth": "Bandwidth 50 GB ah",
                "starter-emails": "5 Xisaabood oo Iimayl ah",
                "starter-domains": "1 Domain oo Bilaash ah",
                "select-starter": "Dooro Starter-ka",
                "recommended": "Lagu Talinayo",
                "best-value": "Qiimaha Ugu Fiican",
                "professional-hosting": "Martigelinta Xirfadleyda (Professional)",
                "pro-nvme": "Kaydka 15 GB NVMe SSD",
                "pro-bandwidth": "Bandwidth 150 GB ah",
                "pro-emails": "15 Xisaabood oo Iimayl ah",
                "pro-domains": "2 Domain oo Bilaash ah",
                "pro-ssl": "Shahaadada SSL Bilaash ah",
                "select-pro": "Dooro Professional-ka",
                "advanced": "Horumarsan",
                "business-hosting": "Martigelinta Ganacsiga (Business)",
                "biz-nvme": "Kaydka 50 GB NVMe SSD",
                "biz-bandwidth": "Bandwidth aan Xadidnayn",
                "biz-emails": "Iimaylo aan Xadidnayn",
                "biz-domains": "5 Domain oo Bilaash ah",
                "biz-support": "Taageerada Mudnaanta leh",
                "select-biz": "Dooro Business-ka",
                "why-choose": "Maxaad u Dooranaysaa Afronex?",
                "why-choose-sub": "Waxaan bixinaa xalal martigelin oo la isku halleyn karo oo leh astaamo iyo taageero aan la qiyaasi karin",
                "lightning-fast": "Aad u Degdeg Badan",
                "lightning-fast-desc": "Kaydka NVMe oo 3x ka dheereeya SSD-yada caadiga ah",
                "secure-reliable": "Aamin & La Isku Halleyn Karo",
                "secure-reliable-desc": "Shahaadooyinka SSL iyo habka lacag bixinta aamin ah",
                "support-247": "Taageero 24/7 ah",
                "support-247-desc": "Taageerada macaamiisha oo saacad walba ah adoo adeegsanaya Telegram iyo iimayl",
                "hero-badge": "🚀 CUSUB: MARTIGELINTA NVMe SSD",
                "hero-title-main": "Martigelinta Ganacsiyada ",
                "hero-title-sub": "Aadka u Fariidka ah ee Itoobiya",
                "hero-desc": "Ku biir kumanaan ganacsiyo ah oo ku kalsoon madal martigelinta shabakadda ee ugu dhakhsaha badan uguna kalsoonida badan Itoobiya.",
                "view-plans": "Fiiri Xirmooyinka Martigelinta",
                "how-to-buy": "Sida Loo Iibsado",
                "unmatched-value": "Qiimo Aan La Tartami Karin",
                "premium-title": "Martigelinta Qiimaha Sare Leh, Tanaasul La'aan",
                "cpanel-access": "Maamul buuxa oo cPanel ah",
                "cpanel-desc": "U maamul xogtaada, faylashaada, iyo domain-kaaga si fudud adoo adeegsanaya helitaanka maamulka cPanel.",
                "uptime-guarantee": "99.9% Damaanad Uptime ah",
                "uptime-desc": "Kalsoonida server-keena heerka ganacsi wuxuu ilaalinayaa mareegahaaga mid online ah 24/7.",
                "round-clock": "La Socodka Saacad Kasta ah",
                "round-clock-desc": "Baaritaanno amni oo firfircoon iyo koobiyo badbaado ah si loo ilaaliyo ganacsigaaga."
            }
        };

        function toggleLangDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('lang-dropdown');
            dropdown.classList.toggle('hidden');
        }

        function setLanguage(lang) {
            localStorage.setItem('preferred-lang', lang);
            document.documentElement.lang = lang;
            
            // Close dropdown
            const dropdown = document.getElementById('lang-dropdown');
            if (dropdown) dropdown.classList.add('hidden');
            
            // Update active label
            const langNames = {
                en: 'English',
                am: 'አማርኛ',
                om: 'Oromoo',
                so: 'Soomaali'
            };
            const currentLangSpan = document.getElementById('current-lang-name');
            if (currentLangSpan) currentLangSpan.innerText = langNames[lang] || 'English';
            
            // Translate all elements with data-i18n
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if (translations[lang] && translations[lang][key]) {
                    // Check if it has text nodes
                    let textNode = Array.from(element.childNodes).find(node => node.nodeType === Node.TEXT_NODE);
                    if (textNode) {
                        textNode.nodeValue = translations[lang][key];
                    } else {
                        element.innerText = translations[lang][key];
                    }
                }
            });
            
            // Update Marquee text
            const marqueeElements = document.querySelectorAll('.gradient-bg .inline-block span');
            marqueeElements.forEach(span => {
                if (translations[lang] && translations[lang]['marquee-text']) {
                    span.innerText = translations[lang]['marquee-text'];
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            const dropdown = document.getElementById('lang-dropdown');
            if (dropdown) dropdown.classList.add('hidden');
        });

        // Initialize preferred language on load
        window.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('preferred-lang') || 'en';
            setLanguage(savedLang);
        });
    </script>
    
    @yield('scripts')
</body>
</html>
