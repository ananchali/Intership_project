@extends('layouts.yegara')

@section('title', 'Submit Payment - Payment Verification System')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-md p-8 border border-gray-100 hover:shadow-lg transition-all duration-300">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Confirm Payment</h2>
        
        <!-- Order Summary -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <h3 class="font-semibold text-blue-900 mb-4">Order Summary</h3>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-blue-700 font-semibold">Order Number</p>
                    <p class="font-mono font-bold text-blue-900 text-lg">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-semibold">Amount Due</p>
                    <p class="font-black text-blue-900 text-lg">{{ $order->formatted_amount }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-semibold">Package</p>
                    <p class="font-medium text-gray-800">{{ $order->package->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-700 font-semibold">Domain</p>
                    <p class="font-mono font-medium text-gray-800">{{ $order->domain_name }}</p>
                </div>
            </div>
        </div>

        <!-- Bank Information -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
            <h3 class="font-semibold text-yellow-900 mb-4">Bank Account Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div>
                    <p class="text-yellow-800 font-bold mb-2">Available Banks:</p>
                    <ul class="text-yellow-700 space-y-1">
                        <li>• Commercial Bank of Ethiopia</li>
                        <li>• Awash Bank</li>
                        <li>• Dashen Bank</li>
                        <li>• Bank of Abyssinia</li>
                    </ul>
                </div>
                <div>
                    <p class="text-yellow-800 font-bold mb-2">Account Details:</p>
                    <p class="text-yellow-700">Account Name: Your Company Ltd</p>
                    <p class="text-yellow-700">Account Number: 1000123456789</p>
                    <p class="text-yellow-700">Branch: Main Branch</p>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Bank Name *
                        </label>
                        <select id="bank_name" name="bank_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Bank</option>
                            <option value="Commercial Bank of Ethiopia">Commercial Bank of Ethiopia</option>
                            <option value="Awash Bank">Awash Bank</option>
                            <option value="Dashen Bank">Dashen Bank</option>
                            <option value="Bank of Abyssinia">Bank of Abyssinia</option>
                            <option value="Wegagen Bank">Wegagen Bank</option>
                            <option value="United Bank">United Bank</option>
                            <option value="Hibret Bank">Hibret Bank</option>
                            <option value="Zemen Bank">Zemen Bank</option>
                            <option value="Bunna Bank">Bunna Bank</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="transaction_reference" class="block text-sm font-medium text-gray-700 mb-2">
                            Transaction Reference Number *
                        </label>
                        <input type="text" id="transaction_reference" name="transaction_reference" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="FT2501667SR1">
                    </div>

                    <div>
                        <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Payment Date *
                        </label>
                        <input type="date" id="payment_date" name="payment_date" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               max="{{ now()->format('Y-m-d') }}">
                    </div>

                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Account Holder Name *
                        </label>
                        <input type="text" id="customer_name" name="customer_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="{{ $order->customer_details['name'] }}"
                               value="{{ $order->customer_details['name'] }}">
                    </div>
                </div>
            </div>

            <!-- Bank Slip Upload -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Bank Slip</h3>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="mt-4">
                        <label for="bank_slip" class="cursor-pointer">
                            <span class="mt-2 block text-sm font-semibold text-blue-600 hover:text-blue-800">
                                Click to upload bank slip or drag and drop
                            </span>
                            <span class="mt-1 block text-xs text-gray-500">
                                PNG, JPG, PDF up to 5MB
                            </span>
                        </label>
                        <input id="bank_slip" name="bank_slip" type="file" class="sr-only" required
                               accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <p class="mt-2 text-sm text-green-600 font-medium" id="file-name"></p>
                </div>
            </div>

            <!-- Additional Notes -->
            <div>
                <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Additional Notes (Optional)
                </label>
                <textarea id="additional_notes" name="additional_notes" rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Any additional information about your payment..."></textarea>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-1">
                    ← Back to Order
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-md">
                    Submit Payment Details
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // File upload preview
    document.getElementById('bank_slip').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || '';
        document.getElementById('file-name').textContent = fileName ? `Selected: ${fileName}` : '';
    });

    // Set max date to today
    document.getElementById('payment_date').max = new Date().toISOString().split('T')[0];
</script>
@endsection
