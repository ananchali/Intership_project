@extends('layouts.admin')

@section('title', 'Review Verification')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.verifications.pending') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold text-sm bg-blue-50/50 hover:bg-blue-100/50 px-5 py-3 rounded-2xl transition-all group shadow-sm">
        <svg class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Pending Slips
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Order & Payment Info -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-100/40 border border-slate-100 p-8 md:p-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full filter blur-xl"></div>
            <h3 class="text-2xl font-black text-slate-900 mb-8 flex items-center tracking-tight">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 mr-3.5">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                Payment Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-100 pt-8">
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Order Number</p>
                        <p class="text-xl font-bold text-slate-950 mt-1">{{ $verification->payment?->order?->order_number ?? $verification->order?->order_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bank Name</p>
                        <p class="text-xl font-bold text-slate-950 mt-1">{{ $verification->bank_name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Transaction Reference</p>
                        <p class="text-sm font-mono font-bold text-blue-600 bg-blue-50 border border-blue-100/50 px-4 py-2 rounded-xl inline-block mt-2 tracking-wide">{{ $verification->transaction_reference ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Amount</p>
                        <p class="text-3xl font-black text-slate-950 mt-1 tracking-tight text-gradient bg-gradient-to-r from-slate-900 to-slate-700">{{ $verification->payment?->formatted_amount ?? $verification->order?->formatted_amount ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Package</p>
                        <p class="text-xl font-bold text-slate-950 mt-1">{{ $verification->payment?->order?->package?->name ?? $verification->order?->package?->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Payment Date</p>
                        <p class="text-xl font-bold text-slate-950 mt-1">{{ $verification->payment_date ? $verification->payment_date->format('M j, Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Slip -->
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-100/40 border border-slate-100 p-8 md:p-10">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-8">
                <h3 class="text-2xl font-black text-slate-900 flex items-center tracking-tight">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600 mr-3.5">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    Bank Slip Document
                </h3>
                @if($verification->bank_slip_url)
                <a href="{{ $verification->bank_slip_url }}" target="_blank" class="inline-flex justify-center items-center text-blue-600 hover:text-blue-800 font-bold text-sm bg-blue-50 px-5 py-3 rounded-xl transition-all shadow-sm">
                    View Full Size
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                @endif
            </div>
            
            <div class="border-2 border-dashed border-slate-200 rounded-[2rem] overflow-hidden bg-slate-50 p-4 transition-all duration-300 hover:border-blue-400">
                @if($verification->bank_slip_path && str_ends_with(strtolower($verification->bank_slip_path), '.pdf'))
                <div class="p-16 text-center">
                    <svg class="mx-auto h-20 w-20 text-red-500 filter drop-shadow-md" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A1 1 0 0112 2.586L15.414 6A1 1 0 0116 6.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                    <p class="mt-6 text-xl font-bold text-slate-900">PDF Document Submitted</p>
                    <p class="text-sm text-slate-500 mt-1">Please review the bank transaction details inside the PDF file</p>
                    <a href="{{ $verification->bank_slip_url ?? '#' }}" target="_blank" 
                       class="mt-8 inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                        OPEN PDF FILE
                    </a>
                </div>
                @elseif($verification->bank_slip_url)
                <div class="rounded-2xl overflow-hidden shadow-inner max-h-[800px] overflow-y-auto">
                    <img src="{{ $verification->bank_slip_url }}" alt="Bank Slip" 
                         class="w-full h-auto cursor-pointer transition-transform hover:scale-[1.015] duration-300" onclick="window.open(this.src, '_blank')">
                </div>
                @else
                <div class="p-16 text-center text-slate-400">
                    <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="text-xl font-bold text-slate-900">No Slip Uploaded</p>
                    <p class="text-sm text-slate-500 mt-1">There is no image associated with this payment submission</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Actions -->
    <div class="space-y-8">
        <!-- Customer Details -->
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 relative overflow-hidden">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Customer Details</h4>
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="p-2.5 bg-slate-50 rounded-xl text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Full Name</p>
                        <p class="font-bold text-slate-950 mt-0.5">{{ $verification->customer_name ?? $verification->order?->customer_details['name'] ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="p-2.5 bg-slate-50 rounded-xl text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email Address</p>
                        <p class="font-bold text-slate-950 mt-0.5 text-sm truncate" title="{{ $verification->payment?->order?->customer_details['email'] ?? $verification->order?->customer_details['email'] ?? 'N/A' }}">
                            {{ $verification->payment?->order?->customer_details['email'] ?? $verification->order?->customer_details['email'] ?? 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Actions -->
        @if($verification->status === 'pending')
        <div class="bg-white rounded-[2rem] shadow-xl border-2 border-blue-500/30 p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full filter blur-lg"></div>
            <h4 class="text-sm font-black text-blue-600 uppercase tracking-widest mb-6">Review Action</h4>
            
            <form action="{{ route('admin.verifications.process', $verification->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="admin_notes" class="block text-[10px] font-black text-slate-400 uppercase mb-2">Admin Notes / Remarks</label>
                    <textarea id="admin_notes" name="admin_notes" rows="4"
                              class="w-full px-4 py-3 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all bg-slate-50/50 text-sm font-medium text-slate-900"
                              placeholder="Add reason for approval or detailed feedback if rejecting...">{{ old('admin_notes') }}</textarea>
                    @error('admin_notes')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-3">
                    <button type="submit" name="action" value="approve" 
                            onclick="return confirm('APPROVE this payment? This will activate the order.')"
                            class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-4 rounded-xl hover:shadow-lg hover:shadow-emerald-500/30 transition-all font-bold tracking-tight transform hover:-translate-y-0.5 active:translate-y-0">
                        APPROVE PAYMENT
                    </button>
                    <button type="submit" name="action" value="reject"
                            onclick="return confirm('REJECT this payment? A note is required.')"
                            class="w-full bg-slate-50 border border-slate-200 text-rose-600 px-6 py-4 rounded-xl hover:bg-rose-50 hover:border-rose-200/50 transition-all font-bold tracking-tight">
                        REJECT PAYMENT
                    </button>
                </div>
            </form>
        </div>
        @else
        <!-- Processed Status -->
        <div class="rounded-[2rem] p-8 border {{ $verification->status === 'approved' ? 'bg-emerald-50/50 border-emerald-200/50 text-emerald-800' : 'bg-rose-50/50 border-rose-200/50 text-rose-800' }} backdrop-blur-md relative overflow-hidden">
            <p class="text-[10px] font-black opacity-60 uppercase tracking-widest mb-3">Submission Status</p>
            <div class="flex items-center gap-3">
                @if($verification->status === 'approved')
                <div class="p-2 bg-emerald-500 text-white rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                @else
                <div class="p-2 bg-rose-500 text-white rounded-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                @endif
                <span class="text-2xl font-black tracking-tight">
                    {{ strtoupper($verification->status) }}
                </span>
            </div>
            
            @if($verification->admin_notes)
            <div class="mt-6 pt-6 border-t border-slate-100">
                <p class="text-[10px] font-black opacity-55 uppercase tracking-wider mb-2">Process Note:</p>
                <p class="text-sm font-medium italic opacity-90">"{{ $verification->admin_notes }}"</p>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
