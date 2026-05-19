@extends('layouts.admin')

@section('title', 'Add Bank Method')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.payment-methods.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Bank Details
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">Add New Bank Account</h1>
        <p class="text-gray-500 mt-1">Add a new destination for customer transfers</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Method Name (e.g. CBE, Telebirr)</label>
                    <input type="text" name="name" required placeholder="Select or type a name..." 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Account Number / Phone</label>
                    <input type="text" name="account_number" required placeholder="Enter the account number" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50 font-mono">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Account Holder Name</label>
                    <input type="text" name="account_name" required placeholder="The name on the account" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Instructions (optional)</label>
                    <textarea name="instructions" rows="4" placeholder="e.g. Please include your order number in the reference." 
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-3 bg-gray-50"></textarea>
                </div>

                <div class="flex items-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <input type="checkbox" name="is_active" id="is_active" checked 
                           class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-700 cursor-pointer">Make this method active for customers</label>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg hover:bg-blue-700 font-bold text-lg shadow-lg shadow-blue-200 transition-all">
                        Create Payment Method
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
