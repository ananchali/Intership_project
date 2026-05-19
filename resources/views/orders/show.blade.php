<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Payment Verification System</title>
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

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Order Details</h2>
                    <p class="text-gray-600">Order Number: <span class="font-mono font-semibold">{{ $order->order_number }}</span></p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'paid') bg-blue-100 text-blue-800
                        @elseif($order->status === 'verified') bg-green-100 text-green-800
                        @elseif($order->status === 'activated') bg-purple-100 text-purple-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Package Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Package Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">{{ $order->package->name }}</p>
                        <p class="text-gray-600 text-sm mb-2">{{ $order->package->description }}</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $order->formatted_amount }}</p>
                    </div>
                </div>

                <!-- Domain Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Domain Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">{{ $order->domain_name }}</p>
                        <p class="text-gray-600 text-sm">
                            @if($order->domain_type === 'register') New Registration
                            @elseif($order->domain_type === 'transfer') Transfer
                            @else Own Domain
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Customer Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Customer Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">{{ $order->customer_details['name'] }}</p>
                        <p class="text-gray-600 text-sm">{{ $order->customer_details['email'] }}</p>
                        <p class="text-gray-600 text-sm">{{ $order->customer_details['phone'] }}</p>
                    </div>
                </div>

                <!-- Payment Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Payment Method</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="font-medium text-gray-900">
                            @if($order->payment_method === 'bank') Bank Deposit
                            @elseif($order->payment_method === 'mobile') Mobile Banking
                            @else Other
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Actions -->
        @if($order->status === 'pending')
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Complete Your Payment</h3>
            <p class="text-gray-600 mb-4">
                Please make a deposit to our bank account and then submit your payment details below.
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <h4 class="font-semibold text-blue-900 mb-2">Bank Account Details</h4>
                <p class="text-blue-800">Bank: Commercial Bank of Ethiopia</p>
                <p class="text-blue-800">Account Name: Your Company Name</p>
                <p class="text-blue-800">Account Number: 1000123456</p>
                <p class="text-blue-800">Amount: {{ $order->formatted_amount }}</p>
            </div>
            <a href="{{ route('payments.create', $order->id) }}" 
               class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                Submit Payment Details
            </a>
        </div>
        @endif

        <!-- Payment Status -->
        @if($order->payments->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Status</h3>
            @foreach($order->payments as $payment)
            <div class="border rounded-lg p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="font-medium text-gray-900">Transaction Reference: {{ $payment->transaction_reference }}</p>
                        <p class="text-gray-600 text-sm">Bank: {{ $payment->bank_name }}</p>
                        <p class="text-gray-600 text-sm">Payment Date: {{ $payment->payment_date->format('M j, Y') }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($payment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($payment->status === 'verified') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                
                @if($payment->verification)
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-sm text-gray-600">
                        <strong>Verification Status:</strong> 
                        <span class="@if($payment->verification->status === 'pending') text-yellow-600
                        @elseif($payment->verification->status === 'approved') text-green-600
                        @else text-red-600 @endif">
                            {{ ucfirst($payment->verification->status) }}
                        </span>
                    </p>
                    @if($payment->verification->admin_notes)
                    <p class="text-sm text-gray-600 mt-1">
                        <strong>Admin Notes:</strong> {{ $payment->verification->admin_notes }}
                    </p>
                    @endif
                </div>
                @endif

                <div class="mt-3">
                    <a href="{{ route('payments.status', $order->id) }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm">
                        View Payment Details →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html>
