<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Payment - Payment Verification System</title>
    <script>
        // Silence Tailwind CDN production warning
        const originalWarn = console.warn;
        console.warn = (...args) => {
            if (args[0] && typeof args[0] === 'string' && args[0].includes('cdn.tailwindcss.com')) return;
            originalWarn.apply(console, args);
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">Payment Verification System</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Confirm Payment</h2>
            
            <!-- Order Summary -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-blue-900 mb-2">Order Summary</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-blue-700">Order Number</p>
                        <p class="font-mono font-medium text-blue-900">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Amount Due</p>
                        <p class="font-bold text-blue-900">{{ $order->formatted_amount }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Package</p>
                        <p class="font-medium text-blue-900">{{ $order->package->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Domain</p>
                        <p class="font-medium text-blue-900">{{ $order->domain_name }}</p>
                    </div>
                </div>
            </div>

            <!-- Bank Information -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-yellow-900 mb-2">Bank Account Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-yellow-800"><strong>Available Banks:</strong></p>
                        <ul class="text-yellow-700 mt-1 space-y-1">
                            <li>• Commercial Bank of Ethiopia</li>
                            <li>• Awash Bank</li>
                            <li>• Dashen Bank</li>
                            <li>• Bank of Abyssinia</li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-yellow-800"><strong>Account Details:</strong></p>
                        <p class="text-yellow-700">Account Name: Your Company Ltd</p>
                        <p class="text-yellow-700">Account Number: 1000123456789</p>
                        <p class="text-yellow-700">Branch: Main Branch</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <div class="space-y-6">
                    <!-- Payment Details -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Bank Name *
                                </label>
                                <select id="bank_name" name="bank_name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="FT2501667SR1">
                            </div>

                            <div>
                                <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Date *
                                </label>
                                <input type="date" id="payment_date" name="payment_date" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       max="{{ now()->format('Y-m-d') }}">
                            </div>

                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Account Holder Name *
                                </label>
                                <input type="text" id="customer_name" name="customer_name" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="{{ $order->customer_details['name'] }}"
                                       value="{{ $order->customer_details['name'] }}">
                            </div>
                        </div>
                    </div>

                    <!-- Bank Slip Upload -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Bank Slip</h3>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4">
                                <label for="bank_slip" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-gray-900">
                                        Click to upload bank slip or drag and drop
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        PNG, JPG, PDF up to 5MB
                                    </span>
                                </label>
                                <input id="bank_slip" name="bank_slip" type="file" class="sr-only" required
                                       accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                            <p class="mt-2 text-xs text-gray-500" id="file-name"></p>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div>
                        <label for="additional_notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional Notes (Optional)
                        </label>
                        <textarea id="additional_notes" name="additional_notes" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Any additional information about your payment..."></textarea>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('orders.show', $order->id) }}" class="text-gray-600 hover:text-gray-900">
                        ← Back to Order
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Submit Payment Details
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('bank_slip').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || '';
            document.getElementById('file-name').textContent = fileName ? `Selected: ${fileName}` : '';
        });

        // Set max date to today
        document.getElementById('payment_date').max = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>
