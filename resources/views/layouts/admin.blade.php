<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/css/glassmorphism.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-gradient: linear-gradient(135deg, #2563eb, #7c3aed);
            --secondary: #7c3aed;
        }
        body { 
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #1a202c;
            line-height: 1.6;
        }
        .sidebar-active {
            background: var(--primary-gradient);
            color: white !important;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
        }
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1000;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            cursor: pointer;
        }
        
        /* Sidebar Collapsed Styles */
        #sidebar.collapsed {
            width: 5rem !important;
        }
        #sidebar.collapsed .sidebar-text,
        #sidebar.collapsed .sidebar-header-text,
        #sidebar.collapsed .sidebar-section-title {
            display: none;
        }
        #sidebar.collapsed .nav-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }
        #sidebar.collapsed .nav-item svg {
            margin-right: 0;
        }
        #sidebar.collapsed .logout-container {
            width: 5rem !important;
            padding: 1.5rem 0.5rem;
        }
        #sidebar.collapsed .logout-text {
            display: none;
        }
        #sidebar.collapsed .logout-button {
            justify-content: center;
            padding: 1rem 0;
        }
        #sidebar.collapsed .logout-button svg {
            margin-right: 0;
        }
        #sidebar.collapsed .logo-container {
            padding: 1.5rem 0;
            justify-content: center;
        }
        #sidebar.collapsed .logo-container svg {
            margin-right: 0;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }
            .sidebar-overlay.active {
                display: block;
            }
            #sidebar {
                position: fixed;
                left: -320px;
                transition: left 0.3s ease;
                z-index: 1000;
                height: 100vh;
            }
            #sidebar.mobile-active {
                left: 0;
            }
        }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Mobile Menu Toggle -->
    <button onclick="toggleSidebar()" class="mobile-menu-toggle">
        <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-80 bg-black border-r border-white/10 hidden md:block flex-shrink-0 z-50 transition-all duration-300 relative flex flex-col h-screen overflow-y-auto" id="sidebar">
            <!-- Sidebar Toggle -->
            <div class="p-4 border-b border-white/10 flex justify-center items-center">
                <button onclick="toggleSidebar()" class="p-2 rounded-xl hover:bg-white/5 transition-all text-slate-400 hover:text-white hidden md:block" title="Toggle Sidebar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <div class="p-8 border-b border-white/10 flex flex-col items-center justify-center logo-container transition-all gap-4">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden shadow-lg bg-white flex items-center justify-center flex-shrink-0 border border-slate-800 transition-all transform hover:scale-105">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="sidebar-header-text">
                        <h2 class="text-xl font-black text-white tracking-tight">Admin CP</h2>
                        <a href="{{ route('home') }}" class="text-[10px] text-blue-400 font-bold uppercase tracking-widest hover:text-blue-300 flex items-center mt-1 transition-colors">
                            View Site
                        </a>
                    </div>
                </div>
                <div class="sidebar-header-text">
                    @include('partials.language_switcher')
                </div>
            </div>
            
            <nav class="mt-10 px-6 space-y-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0 md:mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>
                <a href="{{ route('admin.packages.index') }}" class="nav-item flex items-center px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('admin.packages.*') ? 'sidebar-active' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0 md:mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-7 0V4"></path></svg>
                    <span class="sidebar-text">Packages</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="nav-item flex items-center px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('admin.orders.*') ? 'sidebar-active' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0 md:mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="sidebar-text">Orders</span>
                </a>
                <a href="{{ route('admin.payment-methods.index') }}" class="nav-item flex items-center px-5 py-4 rounded-2xl font-bold transition-all group {{ request()->routeIs('admin.payment-methods.*') ? 'sidebar-active' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5 flex-shrink-0 md:mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 03 3z"></path></svg>
                    <span class="sidebar-text">Bank Details</span>
                </a>
            </nav>
            
            <div class="mt-auto w-full p-8 border-t border-white/10 bg-black logout-container transition-all">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button flex items-center w-full px-5 py-4 text-rose-500 font-bold hover:bg-rose-950/20 rounded-2xl transition-all group">
                        <svg class="h-5 w-5 md:mr-4 text-rose-400 group-hover:text-rose-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="logout-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 h-screen overflow-y-auto bg-slate-50">
            <div class="p-12 max-w-7xl mx-auto">
                @if(session('success'))
                <div class="mb-8 bg-emerald-50 border-l-4 border-emerald-500 p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-emerald-800 font-bold">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-8 bg-rose-50 border-l-4 border-rose-500 p-6 rounded-2xl shadow-sm">
                    <p class="text-sm text-rose-800 font-bold">{{ session('error') }}</p>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (window.innerWidth <= 768) {
                // Mobile behavior: slide in/out
                sidebar.classList.toggle('mobile-active');
                overlay.classList.toggle('active');
            } else {
                // Desktop behavior: collapse width
                sidebar.classList.toggle('collapsed');
            }
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-menu-toggle');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (window.innerWidth <= 768 && overlay.classList.contains('active') && !sidebar.contains(event.target) && !toggle.contains(event.target)) {
                sidebar.classList.remove('mobile-active');
                overlay.classList.remove('active');
            }
        });
    </script>

</body>
</html>

