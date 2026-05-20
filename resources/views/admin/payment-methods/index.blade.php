@extends('layouts.admin')

@section('title', 'Manage Bank Details')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="mb-6 flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-2xl font-semibold text-sm">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="mb-6 flex items-center gap-3 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-2xl font-semibold text-sm">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    {{ session('error') }}
</div>
@endif

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 bg-black/40 backdrop-blur-md p-8 rounded-3xl border border-white/10 shadow-2xl">
    <div>
        <h1 class="text-3xl font-black text-white tracking-tight">Bank Accounts & Methods</h1>
        <p class="text-slate-400 mt-2 font-medium">{{ $methods->count() }} payment method(s) — manage where customers transfer their payments</p>
    </div>
    <a href="{{ route('admin.payment-methods.create') }}" class="flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white px-6 py-3.5 rounded-2xl font-black shadow-lg shadow-blue-500/20 hover:shadow-blue-500/35 transition-all transform hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
        Add New Bank
    </a>
</div>

<div class="bg-black/40 backdrop-blur-md rounded-3xl shadow-2xl border border-white/10 overflow-hidden">
    @if($methods->isEmpty())
    <div class="flex flex-col items-center justify-center py-24 px-8 text-center">
        <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-blue-600/20 to-purple-600/20 border border-white/10 flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
        </div>
        <h3 class="text-xl font-black text-white mb-2">No Bank Methods Yet</h3>
        <p class="text-slate-400 font-medium max-w-sm mb-8">Add your first bank or payment method so customers know where to send their transfers.</p>
        <a href="{{ route('admin.payment-methods.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3.5 rounded-2xl font-black shadow-lg transition-all hover:-translate-y-0.5">
            + Add First Bank
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-white/5">
            <thead class="bg-white/5">
                <tr>
                    <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Method Name</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Account Information</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Instructions</th>
                    <th class="px-8 py-5 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-5 text-right text-xs font-black text-slate-400 uppercase tracking-widest">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 bg-transparent">
                @foreach($methods as $method)
                <tr class="hover:bg-white/5 transition-all duration-200 group">
                    <td class="px-8 py-6 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-gradient-to-tr from-blue-600/30 to-purple-600/30 rounded-2xl flex items-center justify-center text-blue-400 border border-blue-500/20 font-black text-lg group-hover:scale-105 transition-transform flex-shrink-0">
                                {{ strtoupper(substr($method->name, 0, 1)) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-black text-white group-hover:text-blue-400 transition-colors">{{ $method->name }}</div>
                                <div class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5">Bank / Payment Method</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 whitespace-nowrap">
                        <div class="text-sm font-bold text-slate-200 font-mono tracking-wider">{{ $method->account_number }}</div>
                        <div class="text-xs text-slate-400 font-semibold mt-1">{{ $method->account_name }}</div>
                    </td>
                    <td class="px-8 py-6 max-w-xs">
                        @if($method->instructions)
                            <p class="text-xs text-slate-400 font-medium truncate max-w-[200px]" title="{{ $method->instructions }}">{{ $method->instructions }}</p>
                        @else
                            <span class="text-xs text-slate-600 italic">—</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 whitespace-nowrap">
                        <span class="px-3.5 py-1.5 inline-flex text-xs leading-5 font-black rounded-full uppercase tracking-wider {{ $method->is_active ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400' : 'bg-rose-500/10 border border-rose-500/30 text-rose-400' }}">
                            {{ $method->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-2 justify-end">
                            <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="text-blue-400 hover:text-white bg-blue-500/10 border border-blue-500/20 hover:bg-blue-600 hover:border-blue-600 px-4 py-2 rounded-xl transition-all font-bold flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $method->id }}, '{{ addslashes($method->name) }}')"
                                class="text-rose-400 hover:text-white bg-rose-500/10 border border-rose-500/20 hover:bg-rose-600 hover:border-rose-600 px-4 py-2 rounded-xl transition-all font-bold flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-[#0f0f0f] border border-white/10 rounded-3xl p-8 shadow-2xl max-w-md w-full mx-4 z-10">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 bg-rose-500/10 border border-rose-500/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-black text-white">Delete Bank Method?</h3>
                <p class="text-slate-400 text-sm mt-1">This action cannot be undone.</p>
            </div>
        </div>
        <p class="text-slate-300 font-medium mb-8">You are about to permanently delete <strong id="deleteMethodName" class="text-white"></strong>. Any orders referencing this method will lose the bank link.</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 px-5 py-3 bg-white/5 border border-white/10 text-slate-300 hover:text-white hover:bg-white/10 rounded-2xl font-bold transition-all">Cancel</button>
            <a id="deleteConfirmLink" href="#" class="flex-1 px-5 py-3 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white rounded-2xl font-black text-center shadow-lg transition-all">Delete</a>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    document.getElementById('deleteMethodName').textContent = name;
    document.getElementById('deleteConfirmLink').href = `/admin/payment-methods/${id}/delete`;
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection

