@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="mb-12">
    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Dashboard Overview</h1>
    <p class="text-slate-500 mt-3 font-medium">Real-time status of payment verifications</p>
</div>

<!-- Notifications Panel -->
<div id="notifications-panel" class="mb-8 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="relative">
                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                @if($unreadCount > 0)
                <span id="notif-badge" class="absolute -top-1.5 -right-1.5 h-4 w-4 bg-rose-500 text-white text-[9px] font-black flex items-center justify-center rounded-full">{{ $unreadCount }}</span>
                @endif
            </div>
            <h2 class="text-base font-black text-slate-900">Notifications</h2>
        </div>
        @if($unreadCount > 0)
        <button onclick="dismissAll()" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors">Dismiss All</button>
        @endif
    </div>
    <div id="notif-list" class="divide-y divide-slate-50">
        @forelse($notifications as $notif)
        <div id="notif-{{ $notif->id }}" class="px-8 py-4 flex items-center justify-between gap-4 {{ $notif->is_read ? 'opacity-50' : 'bg-blue-50/30' }}">
            <div class="flex items-center gap-4 min-w-0">
                <div class="flex-shrink-0 {{ $notif->is_read ? 'bg-slate-100' : 'bg-blue-100' }} rounded-xl p-2.5">
                    <svg class="h-4 w-4 {{ $notif->is_read ? 'text-slate-400' : 'text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ $notif->title }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ $notif->message }}</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $notif->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($notif->link)
                <a href="{{ $notif->link }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 whitespace-nowrap">View</a>
                @endif
                <button onclick="dismissNotif({{ $notif->id }})" class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
        @empty
        <div class="px-8 py-10 text-center">
            <p class="text-sm text-slate-400 font-medium">No notifications yet</p>
        </div>
        @endforelse
    </div>
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
<!-- Recent Orders Table -->
<div class="bg-white/80 backdrop-blur-md rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden mt-8">
    <div class="px-10 py-8 border-b border-slate-100 flex justify-between items-center">
        <h3 class="text-xl font-black text-slate-900 tracking-tight">Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-bold tracking-tight transition-colors group/link">
            View All Orders
            <svg class="h-4 w-4 ml-2 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead class="bg-slate-50/50">
                <tr>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Order #</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Customer</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Package</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Amount</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-10 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-100">
                @forelse($recentOrders as $order)
                <tr class="hover:bg-slate-50/40 transition-all duration-300">
                    <td class="px-10 py-7 text-sm font-bold text-blue-600">{{ $order->order_number }}</td>
                    <td class="px-10 py-7 text-sm text-slate-900 font-medium">{{ $order->customer_details['name'] ?? 'N/A' }}</td>
                    <td class="px-10 py-7 text-sm text-slate-600">{{ $order->package->name ?? 'N/A' }}</td>
                    <td class="px-10 py-7 text-sm font-bold text-slate-900">{{ number_format($order->total_amount) }} {{ $order->currency }}</td>
                    <td class="px-10 py-7">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase shadow-sm
                            @if($order->status === 'pending') bg-amber-50 text-amber-600 border border-amber-200/80
                            @elseif($order->status === 'verified') bg-emerald-50 text-emerald-600 border border-emerald-200/80
                            @else bg-rose-50 text-rose-600 border border-rose-200/80 @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-10 py-7 text-sm text-slate-500">{{ $order->created_at->format('M j, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-10 py-20 text-center text-slate-400">
                        <div class="flex flex-col items-center">
                            <div class="p-6 bg-slate-50 rounded-full mb-6 text-slate-200">
                                <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="font-black text-slate-900 text-lg">No orders found</p>
                            <p class="text-sm mt-2">Orders will appear here once customers place them.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function dismissNotif(id) {
    fetch('/admin/notifications/' + id + '/dismiss', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                var el = document.getElementById('notif-' + id);
                if (el) { el.style.transition = 'opacity 0.3s'; el.style.opacity = '0'; setTimeout(function() { el.remove(); updateBadge(); }, 300); }
            }
        });
}
function dismissAll() {
    fetch('/admin/notifications/dismiss-all', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                document.getElementById('notif-list').innerHTML = '<div class="px-8 py-10 text-center"><p class="text-sm text-slate-400 font-medium">No notifications yet</p></div>';
                updateBadge();
            }
        });
}
function updateBadge() {
    var badge = document.getElementById('notif-badge');
    if (badge) badge.remove();
}
</script>
@endsection
