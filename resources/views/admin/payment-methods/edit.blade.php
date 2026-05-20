@extends('layouts.admin')

@section('title', 'Edit Bank Method')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 bg-black/40 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-2xl">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-blue-400 hover:text-blue-300 font-extrabold flex items-center transition-colors text-sm uppercase tracking-wider">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Bank Details
        </a>
        <h1 class="text-3xl font-black text-white mt-4 tracking-tight">Edit: {{ $paymentMethod->name }}</h1>
        <p class="text-slate-400 mt-1 font-semibold">Update the account details for this transfer method</p>
    </div>

    <div class="bg-black/40 backdrop-blur-md rounded-3xl shadow-2xl border border-white/10 p-8 md:p-10">
        @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 rounded-2xl">
            <ul class="list-disc list-inside text-rose-400 text-sm font-semibold space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Method Name</label>
                    <input type="text" name="name" value="{{ old('name', $paymentMethod->name) }}" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Account Number / Phone</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $paymentMethod->account_number) }}" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all font-mono">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Account Holder Name</label>
                    <input type="text" name="account_name" value="{{ old('account_name', $paymentMethod->account_name) }}" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-300 uppercase tracking-widest mb-2">Instructions (optional)</label>
                    <textarea name="instructions" rows="4" 
                              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white placeholder-slate-500 font-semibold transition-all">{{ old('instructions', $paymentMethod->instructions) }}</textarea>
                </div>

                <div class="flex items-center bg-white/5 p-5 rounded-2xl border border-white/10">
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $paymentMethod->is_active) ? 'checked' : '' }} 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-white/10 bg-black/40 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-bold text-slate-300 cursor-pointer">Method is Active</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-6 py-4 rounded-2xl font-black text-lg shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all transform hover:-translate-y-0.5">
                        Update Bank Method
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
