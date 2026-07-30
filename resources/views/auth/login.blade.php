@extends('layouts.yegara')

@section('title', 'Login - Afronexhost')

@section('content')
<div class="min-h-screen flex items-stretch bg-gray-50">
    <!-- Left Side: Branding/Image -->
    <div class="hidden lg:flex w-1/2 relative text-white overflow-hidden bg-black/40 backdrop-blur-md border-r border-white/5">
        <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-15 mix-blend-overlay">
        <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 p-16 flex flex-col justify-between w-full">
            <div>
                <a href="{{ route('home') }}" class="flex items-center gap-3 group inline-flex">
                    <div class="w-12 h-12 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="text-2xl font-black text-white tracking-tight">AFRONEX<span class="text-blue-400">HOST</span></span>
                </a>
            </div>
            <div>
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-md">Welcome Back to <br>Excellence.</h1>
                <p class="text-xl text-blue-200 max-w-md font-light">Manage your hosting, domains, and billing all in one powerful dashboard.</p>
            </div>
            <div class="text-blue-300 text-sm">
                &copy; {{ date('Y') }} Afronexhost. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Right Side: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative">
        <!-- Floating shapes for mobile background -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10 animate-blob lg:hidden"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -z-10 animate-blob animation-delay-2000 lg:hidden"></div>

        <div class="w-full max-w-md z-10">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="w-16 h-16 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center border-2 border-transparent group-hover:border-blue-100 transition-all">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                </a>
                <h2 class="text-2xl font-black text-gray-900 mt-4 tracking-tight">AFRONEX<span class="text-blue-600">HOST</span></h2>
            </div>

            <!-- Callout Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-purple-500/10 text-blue-600 border border-blue-100 rounded-full text-xs font-black tracking-wide uppercase mb-4 shadow-sm animate-pulse">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Secure Gateway
                </div>
                <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight leading-snug">
                    Register or log in to secure your hosting package
                </h3>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-blue-900/10 p-8 md:p-12 border border-white">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Sign In</h2>
                    <p class="text-gray-500 font-semibold">Access your secure customer account</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
                        <ul class="list-disc pl-5 space-y-1 font-medium">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Standard Real World Sign In Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="relative group">
                        <label for="login-email" class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}" required
                                   class="w-full pl-11 pr-5 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="you@example.com">
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="flex justify-between items-center mb-2">
                            <label for="login-password" class="block text-sm font-bold text-gray-700">Password</label>
                            <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">Forgot Password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" id="login-password" name="password" required
                                   class="w-full pl-11 pr-12 py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-medium text-gray-900"
                                   placeholder="••••••••">
                            <button type="button" onclick="togglePassword('login-password', this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 focus:ring-2 cursor-pointer transition-colors">
                        <label for="remember" class="ml-3 text-sm font-medium text-gray-600 cursor-pointer select-none">Remember me for 30 days</label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg py-4 rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex justify-center items-center gap-2 group/btn">
                        Sign In
                        <svg class="w-5 h-5 opacity-70 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="mt-8 text-center text-sm text-gray-600 font-semibold">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-extrabold text-blue-600 hover:text-blue-800 transition-colors">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const open = btn.querySelector('.eye-open');
        const closed = btn.querySelector('.eye-closed');
        if (input.type === 'password') {
            input.type = 'text';
            open.classList.add('hidden');
            closed.classList.remove('hidden');
        } else {
            input.type = 'password';
            open.classList.remove('hidden');
            closed.classList.add('hidden');
        }
    }
</script>
@endsection
