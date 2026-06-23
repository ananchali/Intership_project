<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Package;

class OrderCreationService
{
    /**
     * Create an order from the given parameters.
     *
     * @param Package $package
     * @param array $customerDetails ['name' => ..., 'email' => ..., 'phone' => ...]
     * @param string $domainName
     * @param string $domainType
     * @param string $paymentMethod
     * @param string|null $customerId
     */
    public function createOrder(
        Package $package,
        array $customerDetails,
        string $domainName,
        string $domainType,
        string $paymentMethod,
        ?string $customerId = null
    ): Order {
        return Order::create([
            'order_number' => Order::generateOrderNumber(),
            'package_id' => $package->id,
            'customer_id' => $customerId,
            'domain_name' => $domainName,
            'domain_type' => $domainType,
            'status' => 'pending',
            'total_amount' => $package->price,
            'currency' => $package->currency,
            'customer_details' => $customerDetails,
            'payment_method' => $paymentMethod,
        ]);
    }
}
