@extends('layouts.admin')

@section('title', 'Add New Business')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.businesses.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Businesses
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Create New Business</h1>
        <p class="text-gray-500 mt-1">Creates the business and a login account for its owner</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.businesses.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Addis Tech Solutions"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Slug (used in the ordering link)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" required placeholder="e.g. addis-tech"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    <p class="text-xs text-gray-400 mt-1">Customers order through <code class="bg-gray-100 px-1 rounded">{{ url('/b/slug') }}</code></p>
                    @error('slug')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Owner Account</h2>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Name</label>
                    <input type="text" name="owner_name" value="{{ old('owner_name') }}" required placeholder="Owner's full name"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Email (login)</label>
                    <input type="email" name="owner_email" value="{{ old('owner_email') }}" required placeholder="owner@business.com"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_email')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Phone (OTP)</label>
                    <input type="text" name="owner_phone" value="{{ old('owner_phone') }}" required placeholder="0911234567"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Password</label>
                    <input type="password" name="owner_password" required placeholder="Min 8 characters"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="owner_password_confirmation" required placeholder="Repeat password"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
                        Create Business
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
