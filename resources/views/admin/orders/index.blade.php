@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('content')
<div class="mb-8">
    <button onclick="history.back()" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors mb-4 bg-transparent border-none cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back
    </button>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Orders Management</h1>
            <p class="text-gray-600 mt-2">View and manage all customer orders and their payment status</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order Info</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Package</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ $order->order_number }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $order->created_at->format('M j, Y H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">{{ $order->package->name ?? 'N/A' }}</div>
                        <div class="text-xs text-gray-500">{{ $order->domain_name ?: 'No domain' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ number_format($order->total_amount) }} {{ $order->currency }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                            @if($order->status === 'completed') bg-green-100 text-green-700 
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-700 
                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-3 justify-end">
                            <a href="{{ route('admin.orders.delete', ['id' => $order->id]) }}" 
                               class="text-red-600 hover:text-red-800 bg-red-50 px-3 py-1 rounded transition-colors font-bold cursor-pointer">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <h3 class="text-lg font-bold text-gray-900">No orders found</h3>
                        <p class="mt-1 text-sm">Customer orders will appear here once they start placing them.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($orders->hasPages())
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endif
@endsection
