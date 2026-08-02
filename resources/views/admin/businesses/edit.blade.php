@extends('layouts.admin')

@section('title', 'Edit Business')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.businesses.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Businesses
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Edit Business</h1>
        <p class="text-gray-500 mt-1">Update business and owner details</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.businesses.update', $business->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Business Name</label>
                    <input type="text" name="name" value="{{ old('name', $business->name) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $business->slug) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('slug')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Owner Account</h2>
                    <p class="text-sm text-gray-500 mb-4">Owner email: <strong>{{ $business->owner_email }}</strong></p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Name</label>
                    <input type="text" name="owner_name" value="{{ old('owner_name', $business->owner_name) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Owner Phone (OTP)</label>
                    <input type="text" name="owner_phone" value="{{ old('owner_phone', $business->owner_phone) }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_phone')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">New Password <span class="text-gray-400 font-normal">(leave blank to keep current)</span></label>
                    <input type="password" name="owner_password" placeholder="Min 8 characters"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                    @error('owner_password')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="owner_password_confirmation" placeholder="Repeat new password"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                </div>

                <div>
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $business->is_active) ? 'checked' : '' }}
                               class="h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <span class="text-sm font-bold text-gray-700">Business active</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold shadow-lg shadow-blue-200 transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
