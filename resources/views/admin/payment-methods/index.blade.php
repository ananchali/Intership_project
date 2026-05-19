@extends('layouts.admin')

@section('title', 'Manage Bank Details')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Bank Accounts & Methods</h1>
        <p class="text-gray-600 mt-2">Manage where customers transfer their payments</p>
    </div>
    <a href="{{ route('admin.payment-methods.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
        + Add New Method
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Method Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Account Information</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($methods as $method)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                            {{ substr($method->name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">{{ $method->name }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">Acc: {{ $method->account_number }}</div>
                    <div class="text-xs text-gray-500">Name: {{ $method->account_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $method->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $method->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center space-x-3 justify-end">
                        <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1 rounded transition-colors font-bold">Edit</a>
                        <a href="{{ route('admin.payment-methods.delete', ['id' => $method->id]) }}" 
                           class="text-red-600 hover:text-red-800 bg-red-50 px-3 py-1 rounded transition-colors font-bold cursor-pointer">
                            Delete
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
