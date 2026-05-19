@extends('layouts.admin')

@section('title', 'Pending Verifications')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Pending Verifications</h1>
    <p class="text-slate-500 mt-3 font-medium">Review and verify customer payment submissions</p>
</div>

<div class="bg-white/80 backdrop-blur-md rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Order & Package</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Customer Info</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Payment Details</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Amount</th>
                    <th class="px-10 py-6 text-right text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                @forelse($verifications as $verification)
                <tr class="hover:bg-slate-50/40 transition-all duration-300 group">
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                            {{ $verification->payment?->order?->order_number ?? $verification->order?->order_number ?? 'N/A' }}
                        </div>
                        <div class="text-[10px] text-blue-600 font-bold mt-1.5 uppercase tracking-wider">
                            {{ $verification->payment?->order?->package?->name ?? $verification->order?->package?->name ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900">
                            {{ $verification->customer_name ?? $verification->order?->customer_details['name'] ?? 'N/A' }}
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-1">
                            {{ $verification->payment?->order?->customer_details['email'] ?? $verification->order?->customer_details['email'] ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900">{{ $verification->bank_name }}</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">Ref: <span class="font-mono">{{ $verification->transaction_reference }}</span></div>
                    </td>
                    <td class="px-10 py-7">
                        <div class="text-sm font-bold text-slate-900">
                            {{ $verification->payment?->formatted_amount ?? $verification->order?->formatted_amount ?? 'N/A' }}
                        </div>
                        <div class="text-xs text-slate-400 font-medium mt-1">
                            {{ $verification->created_at->format('M j, Y') }}
                        </div>
                    </td>
                    <td class="px-10 py-7 text-right">
                        <a href="{{ route('admin.verifications.show', $verification->id) }}" 
                           class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all font-bold text-xs tracking-tight transform hover:-translate-y-0.5 active:translate-y-0">
                            Review Details
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
                            <h3 class="text-lg font-black text-slate-900">No pending verifications</h3>
                            <p class="mt-2 text-sm font-medium">Everything is processed! Nice work.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($verifications->hasPages())
<div class="mt-8">
    {{ $verifications->links() }}
</div>
@endif
@endsection

