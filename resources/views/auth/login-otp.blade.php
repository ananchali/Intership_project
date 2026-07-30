@extends('layouts.yegara')

@section('title', 'Verify OTP - Afronexhost')

@section('content')
<div class="min-h-screen flex items-stretch bg-gray-50">
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
                <h1 class="text-5xl font-black mb-6 leading-tight drop-shadow-md">Almost There, <br>One More Step.</h1>
                <p class="text-xl text-blue-200 max-w-md font-light">Please enter the OTP sent to your phone to complete login.</p>
            </div>
            <div class="text-blue-300 text-sm">
                &copy; {{ date('Y') }} Afronexhost. All rights reserved.
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative">
        <div class="w-full max-w-md z-10">
            <div class="lg:hidden text-center mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="w-16 h-16 rounded-full overflow-hidden shadow-md bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Afronex Logo" class="w-full h-full object-cover">
                    </div>
                </a>
                <h2 class="text-2xl font-black text-gray-900 mt-4 tracking-tight">AFRONEX<span class="text-blue-600">HOST</span></h2>
            </div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-purple-500/10 text-blue-600 border border-blue-100 rounded-full text-xs font-black tracking-wide uppercase mb-4 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Secure Verification
                </div>
                <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight leading-snug">
                    Phone Verification
                </h3>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-blue-900/10 p-8 md:p-12 border border-white">
                <div class="mb-8 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2 tracking-tight">Enter OTP</h2>
                    <p class="text-gray-500 font-semibold">A 6-digit code was sent to <strong>{{ $masked }}</strong></p>
                </div>

                @if(session('debug_otp'))
                    <div class="mb-6 p-4 rounded-xl bg-yellow-50 border border-yellow-200 text-yellow-800 text-sm text-center font-bold">
                        DEV MODE — OTP: <span class="text-2xl tracking-widest">{{ session('debug_otp') }}</span>
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

                <form action="{{ route('login.otp.verify') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="otp" class="block text-sm font-bold text-gray-700 mb-2">OTP Code</label>
                        <input type="text" id="otp" name="otp" maxlength="6" required
                               inputmode="numeric" autocomplete="one-time-code"
                               class="w-full text-center text-2xl tracking-[0.5em] py-4 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none font-bold text-gray-900"
                               placeholder="000000">
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg py-4 rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex justify-center items-center gap-2 group/btn">
                        Verify & Sign In
                        <svg class="w-5 h-5 opacity-70 group-hover/btn:opacity-100 group-hover/btn:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <form action="{{ route('login') }}" method="GET" class="inline">
                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 font-semibold underline">
                            Back to Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('otp')?.addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });
</script>
@endsection