<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afronex Hosting Clone</title>
    @vite(['resources/css/app.css', 'resources/css/glassmorphism.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg-color: #F9FAFB;
            --text-main: #111827;
            --text-muted: #6B7280;
            --border: #E5E7EB;
            --radius: 12px;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--text-main);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow);
        }

        .mobile-menu-toggle {
            display: none;
            background: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.5rem;
            cursor: pointer;
            color: white;
        }

        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            left: -100%;
            width: 80%;
            max-width: 300px;
            height: 100vh;
            background: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: left 0.3s ease;
            overflow-y: auto;
        }

        .mobile-nav.active {
            left: 0;
        }

        .mobile-nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .mobile-nav-overlay.active {
            display: block;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary);
        }

        .logo-icon {
            background: var(--primary);
            padding: 8px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-auth {
            display: flex;
            gap: 0.75rem;
        }

        .btn-login {
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: var(--bg-color);
        }

        .btn-signup {
            padding: 0.5rem 1.25rem;
            background: var(--primary);
            color: white;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-signup:hover {
            background: var(--primary-hover);
        }

        /* Main Container */
        .main-container {
            padding: 3rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .alert {
            padding: 1rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            text-align: center;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Stepper */
        .stepper {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--bg-color);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .step.active .step-number {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step.completed .step-number {
            background: #10B981;
            border-color: #10B981;
            color: white;
        }

        .step-label {
            font-weight: 500;
        }

        .step.active .step-label {
            color: var(--primary);
            font-weight: 600;
        }

        .step-divider {
            width: 40px;
            height: 2px;
            background: var(--border);
            margin: 0 0.25rem;
            align-self: center;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: white;
            color: var(--text-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg-color);
        }

        /* Footer */
        .footer {
            background: #1F2937;
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand h3 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .footer-brand p {
            color: #9CA3AF;
            font-size: 0.9rem;
            max-width: 300px;
            line-height: 1.6;
        }

        .footer-links h4 {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #9CA3AF;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
            color: #6B7280;
            font-size: 0.85rem;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle { display: block; }
            .nav-links, .btn-auth { display: none; }
            .footer-content { flex-direction: column; }
            .stepper { flex-wrap: wrap; }
            .card { margin: 1rem; padding: 1.5rem; }
            .main-container { padding: 1rem 0; }
            .mobile-nav { display: block; }
            .mobile-nav-overlay { display: none; }
            .mobile-nav-overlay.active { display: block; }
        }

        @media (max-width: 480px) {
            .container { padding: 0 1rem; }
            .card { margin: 0.5rem; padding: 1rem; }
            .page-title { font-size: 1.5rem; }
            .page-subtitle { font-size: 0.9rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <header class="header">
        <div class="container nav-container">
            <button class="mobile-menu-toggle" onclick="toggleMobileNav()">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                Afronex Hosting
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="#hosting">Hosting</a>
                <a href="#domains">Domains</a>
                <a href="{{ route('support') }}">Support</a>
                @include('partials.language_switcher')
            </div>
            <div class="btn-auth">
                <a href="{{ route('admin.login') }}" class="btn-login">Login</a>
                <a href="{{ route('orders.step1') }}" class="btn-signup">Get Started</a>
            </div>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="logo-icon">
                        <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-lg">Afronex Hosting</span>
                </a>
                <button onclick="toggleMobileNav()" class="text-gray-500 hover:text-gray-700">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="{{ route('home') }}" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Home</a>
                <a href="#hosting" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Hosting</a>
                <a href="#domains" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Domains</a>
                <a href="{{ route('support') }}" class="block py-3 px-4 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">Support</a>
                <div class="pt-4 border-t mt-4">
                    <a href="{{ route('admin.login') }}" class="block py-3 px-4 text-center bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors mb-3">Login</a>
                    <a href="{{ route('orders.step1') }}" class="block py-3 px-4 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Get Started</a>
                </div>
            </nav>
        </div>
    </div>
    
    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" onclick="toggleMobileNav()"></div>

    <main class="container main-container">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Afronex Hosting</h3>
                    <p>Your trusted partner for cloud hosting and domain registration. We provide reliable infrastructure to power your digital projects.</p>
                </div>
                <div class="footer-links">
                    <h4>Hosting</h4>
                    <ul>
                        <li><a href="#">Web Hosting</a></li>
                        <li><a href="#">VPS Hosting</a></li>
                        <li><a href="#">Cloud Servers</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="{{ route('support') }}">Help Center</a></li>
                        <li><a href="{{ route('support') }}">Contact Us</a></li>
                        <li><a href="#">Knowledge Base</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Afronex Hosting Clone. Built with confidence and security.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    
    <script>
        function toggleMobileNav() {
            const mobileNav = document.getElementById('mobileNav');
            const overlay = document.querySelector('.mobile-nav-overlay');
            
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');
        }
        
        // Close mobile nav when clicking outside
        document.addEventListener('click', function(event) {
            const mobileNav = document.getElementById('mobileNav');
            const toggle = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth <= 768 && !mobileNav.contains(event.target) && !toggle.contains(event.target)) {
                mobileNav.classList.remove('active');
                document.querySelector('.mobile-nav-overlay').classList.remove('active');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('mobileNav').classList.remove('active');
                document.querySelector('.mobile-nav-overlay').classList.remove('active');
            }
        });
    </script>
</body>
</html>
