<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private function createPackage(array $attributes = []): Package
    {
        return Package::create(array_merge([
            'name' => 'Basic Hosting',
            'description' => 'A basic hosting package',
            'price' => 1500.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['5GB Storage'],
            'is_active' => true,
        ], $attributes));
    }

    private function createCustomer(array $attributes = []): Customer
    {
        return Customer::create(array_merge([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '0911223344',
            'password_hash' => bcrypt('password'),
            'is_active' => true,
        ], $attributes));
    }

    private function createOrder(array $attributes = []): Order
    {
        $package = $this->createPackage();
        $customer = $this->createCustomer();

        return Order::create(array_merge([
            'order_number' => 'ORD-2026-000001',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'example.com',
            'domain_type' => 'register',
            'status' => 'pending',
            'total_amount' => 1500.00,
            'currency' => 'ETB',
            'customer_details' => [
                'name' => 'Test Customer',
                'email' => 'test@example.com',
                'phone' => '0911223344',
            ],
            'payment_method' => 'CBE',
        ], $attributes));
    }

    public function test_order_can_be_created(): void
    {
        $order = $this->createOrder();

        $this->assertDatabaseHas('orders', ['order_number' => 'ORD-2026-000001']);
        $this->assertEquals('pending', $order->status);
        $this->assertEquals(1500.00, $order->total_amount);
    }

    public function test_customer_details_cast_to_array(): void
    {
        $order = $this->createOrder();

        $this->assertIsArray($order->customer_details);
        $this->assertEquals('Test Customer', $order->customer_details['name']);
        $this->assertEquals('test@example.com', $order->customer_details['email']);
    }

    public function test_formatted_amount_attribute(): void
    {
        $order = $this->createOrder(['total_amount' => 2500.50, 'currency' => 'ETB']);

        $this->assertEquals('2,500.50 ETB', $order->formatted_amount);
    }

    public function test_scope_by_status(): void
    {
        $this->createOrder(['order_number' => 'ORD-2026-000001', 'status' => 'pending']);

        $package = Package::first();
        $customer = Customer::first();
        Order::create([
            'order_number' => 'ORD-2026-000002',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'example2.com',
            'domain_type' => 'register',
            'status' => 'completed',
            'total_amount' => 2000.00,
            'currency' => 'ETB',
            'customer_details' => ['name' => 'Customer 2', 'email' => 'c2@test.com', 'phone' => '0912345678'],
            'payment_method' => 'CBE',
        ]);

        $pendingOrders = Order::byStatus('pending')->get();
        $completedOrders = Order::byStatus('completed')->get();

        $this->assertCount(1, $pendingOrders);
        $this->assertCount(1, $completedOrders);
    }

    public function test_scope_by_customer(): void
    {
        $order = $this->createOrder();

        $customer = Customer::first();
        $results = Order::byCustomer($customer->id)->get();

        $this->assertCount(1, $results);
        $this->assertEquals($order->id, $results->first()->id);
    }

    public function test_generate_order_number_format(): void
    {
        $orderNumber = Order::generateOrderNumber();

        $this->assertMatchesRegularExpression('/^ORD-\d{4}-\d{6}$/', $orderNumber);
        $this->assertStringContainsString('ORD-' . date('Y'), $orderNumber);
    }

    public function test_generate_order_number_increments(): void
    {
        $this->createOrder(['order_number' => 'ORD-2026-000005']);

        $nextOrderNumber = Order::generateOrderNumber();

        $this->assertEquals('ORD-' . date('Y') . '-000006', $nextOrderNumber);
    }

    public function test_order_belongs_to_customer_relationship(): void
    {
        $order = $this->createOrder();

        $this->assertInstanceOf(Customer::class, $order->customer);
        $this->assertEquals('Test Customer', $order->customer->name);
    }

    public function test_order_belongs_to_package_relationship(): void
    {
        $order = $this->createOrder();

        $this->assertInstanceOf(Package::class, $order->package);
        $this->assertEquals('Basic Hosting', $order->package->name);
    }

    public function test_order_has_many_payments_relationship(): void
    {
        $order = $this->createOrder();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $order->payments());
    }

    public function test_fillable_attributes(): void
    {
        $order = new Order();
        $expected = [
            'order_number', 'package_id', 'domain_name', 'domain_type',
            'status', 'total_amount', 'currency', 'customer_details',
            'payment_method', 'customer_id',
        ];

        $this->assertEquals($expected, $order->getFillable());
    }
}
