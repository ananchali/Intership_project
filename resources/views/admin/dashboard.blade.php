@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Dashboard Overview</h1>
    <p class="text-slate-500 mt-3 font-medium">Real-time status of payment verifications</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/5 hover:-translate-y-1.5 group">
        <div class="flex items-center">
            <div class="p-4 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div class="ml-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Verifications</p>
                <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_verifications'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-amber-500/5 hover:-translate-y-1.5 group">
        <div class="flex items-center">
            <div class="p-4 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl text-white shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pending Slips</p>
                <p class="text-3xl font-black text-amber-500 mt-1">{{ $stats['pending_verifications'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-500/5 hover:-translate-y-1.5 group">
        <div class="flex items-center">
            <div class="p-4 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Approved Today</p>
                <p class="text-3xl font-black text-emerald-500 mt-1">{{ $stats['approved_today'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 transition-all duration-300 hover:shadow-2xl hover:shadow-rose-500/5 hover:-translate-y-1.5 group">
        <div class="flex items-center">
            <div class="p-4 bg-gradient-to-br from-rose-400 to-red-500 rounded-2xl text-white shadow-lg shadow-rose-500/30 group-hover:scale-110 transition-transform">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="ml-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rejected Today</p>
                <p class="text-3xl font-black text-rose-500 mt-1">{{ $stats['rejected_today'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Verifications Table -->
<div class="bg-white/80 backdrop-blur-md rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
    <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
        <h3 class="text-xl font-black text-slate-900 tracking-tight">Recent Verifications</h3>
        <a href="{{ route('admin.verifications.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-bold tracking-tight transition-colors group/link">
            View All History 
            <svg class="h-4 w-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Order Details</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Amount</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Submitted Date</th>
                    <th class="px-10 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                @forelse($recentVerifications as $verification)
                <tr class="hover:bg-slate-50/40 transition-all duration-300 group">
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $verification->payment?->order?->order_number ?? $verification->order?->order_number ?? 'N/A' }}</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">{{ $verification->customer_name ?? $verification->order?->customer_details['name'] ?? 'N/A' }}</div>
                    </td>
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900">{{ $verification->payment?->formatted_amount ?? $verification->order?->formatted_amount ?? 'N/A' }}</div>
                    </td>
                    <td class="px-10 py-7">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase shadow-sm
                            @if($verification->status === 'pending') bg-amber-50 text-amber-600 border border-amber-200/80
                            @elseif($verification->status === 'approved') bg-emerald-50 text-emerald-600 border border-emerald-200/80
                            @else bg-rose-50 text-rose-600 border border-rose-200/80 @endif">
                            {{ $verification->status }}
                        </span>
                    </td>
                    <td class="px-10 py-7 text-sm text-slate-500 font-medium">
                        {{ $verification->created_at->format('M j, Y') }}
                    </td>
                    <td class="px-10 py-7 text-right">
                        <a href="{{ route('admin.verifications.show', $verification->id) }}" 
                           class="inline-flex items-center px-6 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-blue-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-sm hover:shadow-md">
                            Review
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-10 py-20 text-center text-slate-400">
                        <div class="flex flex-col items-center">
                            <div class="p-6 bg-slate-50 rounded-full mb-6 text-slate-200">
                                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="font-black text-slate-900 text-lg">No verifications found</p>
                            <p class="text-sm mt-2">Everything is processed for now!</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
