@extends('layouts.admin')

@section('title', 'Manage Servers')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Servers & Packages</h1>
        <p class="text-gray-600 mt-2">Add, edit or remove hosting and domain packages</p>
    </div>
    <a href="{{ route('admin.packages.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
        + Add New Package
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Package Details</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Price</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($packages as $package)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $package->name }}</div>
                    <div class="text-xs text-gray-500 mt-1 max-w-xs truncate">{{ $package->description }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $package->type === 'hosting' ? 'bg-purple-100 text-purple-700' : 'bg-indigo-100 text-indigo-700' }}">
                        {{ ucfirst($package->type) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                    {{ number_format($package->price) }} <span class="text-gray-400 font-normal">{{ $package->currency }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $package->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $package->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex items-center space-x-3 justify-end">
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1 rounded transition-colors font-bold">Edit</a>
                        <a href="{{ route('admin.packages.delete', ['id' => $package->id]) }}" 
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
