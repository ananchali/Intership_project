@extends('layouts.yegara')

@section('title', 'Payment Verification')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Verification Header -->
    <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
        <div class="text-center mb-8">
            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-white" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="50" fill="#000000"/>
                    <path d="M50 10 C30 10, 10 30, 10 50 C10 70, 30 90, 50 90 C70 90, 90 70, 90 50 C90 35, 75 15, 60 12" fill="#8B4513"/>
                    <circle cx="35" cy="40" r="8" fill="#654321"/>
                    <circle cx="65" cy="40" r="8" fill="#FF0000"/>
                    <path d="M25 60 Q50 70, 75 60" stroke="#C0C0C0" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Verification</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Upload your bank slip or enter transaction details to verify your payment and activate your service
            </p>
        </div>
        
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Verification Form -->
        <form id="verifyForm" action="{{ route('payment.verify.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- Order Information -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Order Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="order_id" class="block text-sm font-medium text-gray-700 mb-2">Order ID / Invoice Number *</label>
                        <input type="text" id="order_id" name="order_id" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., INV-2024-001" 
                               value="{{ old('order_id', request()->get('order_id') ?? session('order_id') ?? '') }}">
                        <p class="mt-1 text-xs text-gray-500">Auto-filled from your order selection</p>
                    </div>
                    
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Payment Amount (ETB) *</label>
                        <input type="number" id="amount" name="amount" required step="0.01"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., 1500.00" 
                               value="{{ old('amount', request()->get('amount') ?? session('amount') ?? '') }}">
                        <p class="mt-1 text-xs text-gray-500">Auto-filled from your package selection</p>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm-6 4h2"/>
                </svg>
                Payment Verification
            </h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Bank Name *</label>
                        <select id="bank_name" name="bank_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                {{ request()->get('bank_name') || session('bank_name') ? 'disabled' : '' }}>
                            <option value="">Select Bank</option>
                            @forelse($paymentMethods as $method)
                                @php $hasDetails = $method->account_number && $method->account_name; @endphp
                                <option value="{{ $method->name }}" {{ (old('bank_name') ?? request()->get('bank_name') ?? session('bank_name')) == $method->name ? 'selected' : '' }} {{ $hasDetails ? '' : 'disabled' }}>
                                    @if($method->icon) <img src="{{ $method->icon_url }}" alt="" class="h-4 w-4 inline-block mr-1"> @endif
                                    {{ $method->name }}{{ $hasDetails ? '' : ' (not configured)' }}
                                </option>
                            @empty
                                <option value="" disabled>No payment methods available</option>
                            @endforelse
                        </select>
                        @if(request()->get('bank_name') || session('bank_name'))
                            <input type="hidden" name="bank_name" value="{{ request()->get('bank_name') ?? session('bank_name') }}">
                        @endif
                    </div>
                    
                    <div>
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700 mb-2">Transaction Date *</label>
                        <input type="date" id="transaction_date" name="transaction_date" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('transaction_date') }}">
                        <p class="mt-1 text-xs text-gray-500">Date when you made the payment</p>
                    </div>
                </div>
            </div>

            <!-- Transaction Reference -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Transaction Reference
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="transaction_ref" class="block text-sm font-medium text-gray-700 mb-2">Transaction Reference Number *</label>
                        <input type="text" id="transaction_ref" name="transaction_number" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., FT2501667SR1" value="{{ old('transaction_number', old('transaction_ref')) }}">
                        <p class="mt-1 text-xs text-gray-500">Found on your payment receipt or bank statement</p>
                    </div>
                    
                    <div>
                        <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">Account Holder Name *</label>
                        <input type="text" id="account_name" name="account_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Name as it appears on bank account" value="{{ old('account_name') }}">
                        <p class="mt-1 text-xs text-gray-500">Must match your bank account name</p>
                    </div>
                </div>
            </div>

            <!-- Bank Slip Upload -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 4.9V4a2 2 0 00-2-2H6a2 2 0 00-2 2v2.9z"/>
                    </svg>
                    Upload Bank Slip (Optional)
                </h2>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 4.9V4a2 2 0 00-2-2H6a2 2 0 00-2 2v2.9z"/>
                    </svg>
                    <p class="text-gray-600 mb-4">Drag and drop your bank slip here or click to browse</p>
                    <input type="file" id="bank_slip" name="bank_slip" accept="image/*,.pdf"
                           class="hidden" onchange="handleFileSelect(this)">
                    <button type="button" onclick="document.getElementById('bank_slip').click()"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        Choose File
                    </button>
                    <div id="filePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">Selected file:</p>
                        <div class="bg-white border border-gray-200 rounded p-3">
                            <span id="fileName" class="text-sm font-medium text-gray-900"></span>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-xs text-gray-500">
                    Accepted formats: JPG, PNG, GIF, PDF (Max file size: 5MB)
                </p>
            </div>

            <!-- Additional Information -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-4h-3v4a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h3V4z"/>
                    </svg>
                    Additional Information
                </h2>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description / Notes</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Any additional information about your payment...">{{ old('description') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Optional: Add any notes that might help verify your payment faster</p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-12 py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg w-full md:w-auto">
                    Submit Payment Verification
                </button>
                <p class="mt-4 text-sm text-gray-600">
                    Your account will be activated within 10 minutes after successful verification
                </p>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="bg-white rounded-lg shadow-sm p-8">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Need Help?</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.003 9.003 0 00-9-9c0 1.652.316 3.224.874 4.418l6.626 6.626A10.003 10.003 0 0022 12c0-4.418-4.03-8-9-8a9.003 9.003 0 00-9 9c0 1.652-.316 3.224-.874 4.418l6.626-6.626A10.003 10.003 0 002 12z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Live Chat</h4>
                <p class="text-gray-600 text-sm mb-3">Get instant help via Telegram</p>
                <a href="https://t.me/yegara" target="_blank" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Chat Now
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Email Support</h4>
                <p class="text-gray-600 text-sm mb-3">Send us an email anytime</p>
                <a href="mailto:support@yegara.com" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Email Us
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 19 7.5 19s3.332-.523 4.5-1.247V6.253z"/>
                    </svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-2">Knowledgebase</h4>
                <p class="text-gray-600 text-sm mb-3">Browse helpful articles</p>
                <a href="{{ route('howto.buy') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Browse Articles
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function handleFileSelect(input) {
    var file = input.files[0];
    var preview = document.getElementById('filePreview');
    var fileName = document.getElementById('fileName');
    var errorEl = document.getElementById('bank_slip_error');
    var container = input.closest('.border-2');
    
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            showError('bank_slip', 'File size must be less than 2MB', container);
            input.value = '';
            return;
        }
        var allowed = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
        if (!allowed.includes(file.type)) {
            showError('bank_slip', 'Only JPG, PNG, GIF, and PDF files are allowed', container);
            input.value = '';
            return;
        }
        clearError('bank_slip', container);
        fileName.textContent = file.name;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}

function showError(field, message, container) {
    var el = container || document.querySelector('[name="' + field + '"]')?.closest('div');
    if (!el) el = document.getElementById(field + '_error')?.parentNode;
    var existing = el.querySelector('.field-error');
    if (existing) existing.remove();
    var err = document.createElement('p');
    err.className = 'field-error mt-1.5 text-xs font-semibold text-red-600 flex items-center gap-1';
    err.innerHTML = '<svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg> ' + message;
    el.appendChild(err);
    el.querySelector('input, select, textarea')?.classList.add('border-red-400', 'bg-red-50');
}

function clearError(field, container) {
    var el = container || document.querySelector('[name="' + field + '"]')?.closest('div');
    if (!el) el = document.getElementById(field + '_error')?.parentNode;
    var existing = el.querySelector('.field-error');
    if (existing) existing.remove();
    el.querySelector('input, select, textarea')?.classList.remove('border-red-400', 'bg-red-50');
}

// Real-time validation on blur
document.querySelectorAll('#verifyForm input, #verifyForm select, #verifyForm textarea').forEach(function(el) {
    el.addEventListener('blur', function() {
        var container = this.closest('div');
        if (!this.value && this.hasAttribute('required')) {
            var label = container.querySelector('label')?.textContent?.replace('*', '').trim() || this.name;
            showError(this.name, label + ' is required', container);
        } else {
            clearError(this.name, container);
        }
        if (this.name === 'transaction_number' || this.name === 'bank_slip') {
            var tn = document.querySelector('[name="transaction_number"]');
            var bs = document.querySelector('[name="bank_slip"]');
            if ((!tn || !tn.value) && (!bs || !bs.files || !bs.files[0])) {
                // one of them must be filled - show on whichever is empty
            }
        }
    });
});

// Pre-submit check for transaction ref OR bank slip
document.getElementById('verifyForm').addEventListener('submit', function(e) {
    var tn = document.querySelector('[name="transaction_number"]');
    var bs = document.querySelector('[name="bank_slip"]');
    if ((!tn || !tn.value.trim()) && (!bs || !bs.files || !bs.files[0])) {
        e.preventDefault();
        showError('transaction_number', 'Either a transaction reference number or a bank slip is required');
        return false;
    }
    // Check all required
    var valid = true;
    this.querySelectorAll('[required]').forEach(function(el) {
        if (!el.value) {
            var container = el.closest('div');
            var label = container.querySelector('label')?.textContent?.replace('*', '').trim() || el.name;
            showError(el.name, label + ' is required', container);
            valid = false;
        }
    });
    if (!valid) {
        e.preventDefault();
        return false;
    }
});
</script>
@endsection
