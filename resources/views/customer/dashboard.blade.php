@extends('layouts.yegara')

@section('title', 'Customer Dashboard - Afronexhost')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Header Section -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/60 backdrop-blur-xl p-8 rounded-3xl border border-white shadow-xl shadow-blue-900/5">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-purple-600 flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-blue-500/20">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Welcome back, {{ $user->name }}!</h1>
                <p class="text-gray-500 font-semibold mt-1">Manage your active hosting packages, domains, and payment streams</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="self-start md:self-center">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-3.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-2xl transition-all shadow-sm hover:shadow-red-600/5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-8 p-5 rounded-2xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
            <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Continue Order Banner -->
    @if(isset($selectedPackage))
    <div class="relative bg-gradient-to-r from-blue-900 to-purple-900 rounded-[2.5rem] shadow-xl shadow-blue-900/10 p-8 md:p-10 mb-10 text-white overflow-hidden border border-blue-950">
        <div class="absolute top-0 right-0 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10 animate-blob animation-delay-2000"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <span class="inline-block px-3.5 py-1 bg-white/10 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-widest text-blue-200 mb-3 border border-white/10">Incomplete Step</span>
                <h2 class="text-3xl font-black mb-2 tracking-tight">Continue Your Hosting Order</h2>
                <p class="text-blue-100 max-w-xl font-medium">You selected the <strong class="text-white">{{ $selectedPackage->name }}</strong> hosting package. Finish setting up your domain to secure this offer.</p>
            </div>
            <a href="{{ route('orders.yegara-flow', ['step' => 2, 'package_id' => $selectedPackage->id]) }}" 
               class="mt-4 md:mt-0 bg-white hover:bg-blue-50 text-blue-900 font-extrabold px-8 py-4 rounded-2xl transition-all shadow-lg hover:shadow-white/20 flex items-center gap-2 group whitespace-nowrap">
                Choose Domain
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
    @endif

    <!-- Orders Management Section -->
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <h2 class="text-2xl font-black text-gray-900 tracking-tight">Your Server Subscriptions</h2>
                <p class="text-sm font-semibold text-gray-500 mt-1">Status details and verification trackers for all orders</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-black tracking-wider uppercase">
                        <th class="px-8 py-5 text-left">Order Number</th>
                        <th class="px-8 py-5 text-left">Package Details</th>
                        <th class="px-8 py-5 text-left">Domain Name</th>
                        <th class="px-8 py-5 text-left">Billed Amount</th>
                        <th class="px-8 py-5 text-left">Status Badge</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($orders as $order)
                    <tr class="hover:bg-blue-50/20 transition-colors group">
                        <td class="px-8 py-6">
                            <span class="text-sm font-bold text-gray-900 font-mono bg-gray-100 px-3 py-1.5 rounded-lg">#{{ $order->order_number }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-gray-900">{{ $order->package?->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500 font-semibold mt-1">Hosting Plan</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-sm font-bold text-gray-900 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                {{ $order->domain_name }}
                            </div>
                            <div class="text-[10px] text-blue-600 font-black uppercase tracking-wider mt-1">{{ $order->domain_type }}</div>
                        </td>
                        <td class="px-8 py-6 text-sm font-bold text-gray-900">{{ $order->formatted_amount }}</td>
                        <td class="px-8 py-6">
                            @if($order->status === 'verified' || $order->status === 'active')
                                <span class="px-3.5 py-1.5 inline-flex text-xs leading-5 font-black rounded-full bg-emerald-100/70 border border-emerald-200 text-emerald-800 uppercase tracking-wider">
                                    {{ $order->status }}
                                </span>
                            @elseif($order->status === 'pending')
                                <span class="px-3.5 py-1.5 inline-flex text-xs leading-5 font-black rounded-full bg-amber-100/70 border border-amber-200 text-amber-800 uppercase tracking-wider animate-pulse">
                                    {{ $order->status }}
                                </span>
                            @else
                                <span class="px-3.5 py-1.5 inline-flex text-xs leading-5 font-black rounded-full bg-gray-100 border border-gray-200 text-gray-600 uppercase tracking-wider">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            @if($order->status === 'pending')
                                <a href="{{ route('orders.yegara-flow', ['step' => 4, 'order_id' => $order->id, 'payment_method' => $order->payment_method]) }}" 
                                   class="inline-flex items-center gap-1.5 text-blue-600 hover:text-white font-extrabold text-sm bg-blue-50 hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-600 px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-blue-500/10">
                                    Verify Payment
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            @else
                                <span class="inline-flex items-center gap-1 text-gray-400 text-xs font-black uppercase tracking-wider bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-lg select-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Provisioned
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-16 text-center text-gray-500">
                            <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-gray-400 border border-gray-100">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-black text-gray-900 mb-1">No Active Subscriptions Yet</h3>
                            <p class="text-sm font-semibold text-gray-500 max-w-sm mx-auto mb-6">Create a secure hosting bundle or domain register to launch your site now.</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-extrabold px-6 py-3.5 rounded-2xl hover:shadow-lg hover:shadow-blue-500/20 transition-all">
                                Get Started
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
