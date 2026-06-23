<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    private function createCustomer(array $attributes = []): Customer
    {
        return Customer::create(array_merge([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '0911223344',
            'password_hash' => bcrypt('secret123'),
            'is_active' => true,
        ], $attributes));
    }

    public function test_customer_can_be_created(): void
    {
        $customer = $this->createCustomer();

        $this->assertDatabaseHas('customers', ['email' => 'john@example.com']);
        $this->assertEquals('John Doe', $customer->name);
    }

    public function test_password_hash_is_hidden(): void
    {
        $customer = $this->createCustomer();
        $array = $customer->toArray();

        $this->assertArrayNotHasKey('password_hash', $array);
    }

    public function test_is_active_cast_to_boolean(): void
    {
        $customer = $this->createCustomer(['is_active' => 1]);

        $this->assertIsBool($customer->is_active);
        $this->assertTrue($customer->is_active);
    }

    public function test_scope_active_returns_only_active_customers(): void
    {
        $this->createCustomer(['email' => 'active@test.com', 'is_active' => true]);
        $this->createCustomer(['email' => 'inactive@test.com', 'is_active' => false]);

        $activeCustomers = Customer::active()->get();

        $this->assertCount(1, $activeCustomers);
        $this->assertEquals('active@test.com', $activeCustomers->first()->email);
    }

    public function test_get_auth_password_returns_password_hash(): void
    {
        $customer = $this->createCustomer();

        $this->assertEquals($customer->password_hash, $customer->getAuthPassword());
    }

    public function test_get_auth_password_name(): void
    {
        $customer = new Customer();

        $this->assertEquals('password_hash', $customer->getAuthPasswordName());
    }

    public function test_customer_has_many_orders_relationship(): void
    {
        $customer = $this->createCustomer();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $customer->orders());
    }

    public function test_customer_has_many_through_payments_relationship(): void
    {
        $customer = $this->createCustomer();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasManyThrough::class, $customer->payments());
    }

    public function test_customer_orders_count(): void
    {
        $customer = $this->createCustomer();
        $package = Package::create([
            'name' => 'Test Package',
            'price' => 1000.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['Feature 1'],
            'is_active' => true,
        ]);

        Order::create([
            'order_number' => 'ORD-2026-000001',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'test1.com',
            'domain_type' => 'register',
            'status' => 'pending',
            'total_amount' => 1000.00,
            'currency' => 'ETB',
            'customer_details' => ['name' => 'John', 'email' => 'john@example.com', 'phone' => '0911223344'],
            'payment_method' => 'CBE',
        ]);

        Order::create([
            'order_number' => 'ORD-2026-000002',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'test2.com',
            'domain_type' => 'register',
            'status' => 'pending',
            'total_amount' => 1000.00,
            'currency' => 'ETB',
            'customer_details' => ['name' => 'John', 'email' => 'john@example.com', 'phone' => '0911223344'],
            'payment_method' => 'CBE',
        ]);

        $this->assertCount(2, $customer->orders);
    }

    public function test_fillable_attributes(): void
    {
        $customer = new Customer();
        $expected = ['name', 'email', 'phone', 'password_hash', 'is_active'];

        $this->assertEquals($expected, $customer->getFillable());
    }

    public function test_table_name(): void
    {
        $customer = new Customer();

        $this->assertEquals('customers', $customer->getTable());
    }
}
