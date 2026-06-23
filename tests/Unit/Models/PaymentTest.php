<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private function createOrderWithPayment(array $paymentAttrs = []): Payment
    {
        $package = Package::create([
            'name' => 'Basic Hosting',
            'price' => 1500.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['5GB Storage'],
            'is_active' => true,
        ]);

        $customer = Customer::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '0911223344',
            'password_hash' => bcrypt('password'),
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'ORD-2026-000001',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'example.com',
            'domain_type' => 'register',
            'status' => 'pending',
            'total_amount' => 1500.00,
            'currency' => 'ETB',
            'customer_details' => ['name' => 'Test', 'email' => 'test@example.com', 'phone' => '0911223344'],
            'payment_method' => 'CBE',
        ]);

        return Payment::create(array_merge([
            'order_id' => $order->id,
            'amount' => 1500.00,
            'currency' => 'ETB',
            'payment_method' => 'CBE',
            'bank_name' => 'Commercial Bank of Ethiopia',
            'transaction_reference' => 'TXN-123456',
            'payment_date' => '2026-05-10',
            'status' => 'pending',
        ], $paymentAttrs));
    }

    public function test_payment_can_be_created(): void
    {
        $payment = $this->createOrderWithPayment();

        $this->assertDatabaseHas('payments', ['transaction_reference' => 'TXN-123456']);
        $this->assertEquals('pending', $payment->status);
        $this->assertEquals(1500.00, $payment->amount);
    }

    public function test_formatted_amount_attribute(): void
    {
        $payment = $this->createOrderWithPayment(['amount' => 3500.75, 'currency' => 'ETB']);

        $this->assertEquals('3,500.75 ETB', $payment->formatted_amount);
    }

    public function test_scope_by_status(): void
    {
        $this->createOrderWithPayment(['status' => 'pending']);

        $order = Order::first();
        Payment::create([
            'order_id' => $order->id,
            'amount' => 2000.00,
            'currency' => 'ETB',
            'payment_method' => 'CBE',
            'bank_name' => 'CBE',
            'transaction_reference' => 'TXN-789',
            'payment_date' => '2026-05-11',
            'status' => 'verified',
        ]);

        $pending = Payment::byStatus('pending')->get();
        $verified = Payment::byStatus('verified')->get();

        $this->assertCount(1, $pending);
        $this->assertCount(1, $verified);
    }

    public function test_scope_pending(): void
    {
        $this->createOrderWithPayment(['status' => 'pending']);

        $order = Order::first();
        Payment::create([
            'order_id' => $order->id,
            'amount' => 2000.00,
            'currency' => 'ETB',
            'payment_method' => 'CBE',
            'bank_name' => 'CBE',
            'transaction_reference' => 'TXN-999',
            'payment_date' => '2026-05-11',
            'status' => 'verified',
        ]);

        $pending = Payment::pending()->get();

        $this->assertCount(1, $pending);
        $this->assertEquals('TXN-123456', $pending->first()->transaction_reference);
    }

    public function test_mark_as_verified(): void
    {
        $payment = $this->createOrderWithPayment(['status' => 'pending']);
        $customer = Customer::first();

        $payment->markAsVerified('Looks good', $customer->id);

        $payment->refresh();
        $this->assertEquals('verified', $payment->status);
        $this->assertEquals('Looks good', $payment->verification_notes);
        $this->assertEquals($customer->id, $payment->verified_by);
        $this->assertNotNull($payment->verified_at);
    }

    public function test_mark_as_rejected(): void
    {
        $payment = $this->createOrderWithPayment(['status' => 'pending']);
        $customer = Customer::first();

        $payment->markAsRejected('Invalid slip', $customer->id);

        $payment->refresh();
        $this->assertEquals('rejected', $payment->status);
        $this->assertEquals('Invalid slip', $payment->verification_notes);
        $this->assertEquals($customer->id, $payment->verified_by);
        $this->assertNotNull($payment->verified_at);
    }

    public function test_payment_belongs_to_order_relationship(): void
    {
        $payment = $this->createOrderWithPayment();

        $this->assertInstanceOf(Order::class, $payment->order);
    }

    public function test_payment_has_one_verification_relationship(): void
    {
        $payment = $this->createOrderWithPayment();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $payment->verification());
    }

    public function test_payment_date_cast_to_datetime(): void
    {
        $payment = $this->createOrderWithPayment(['payment_date' => '2026-05-15 10:00:00']);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $payment->payment_date);
    }

    public function test_fillable_attributes(): void
    {
        $payment = new Payment();
        $expected = [
            'order_id', 'amount', 'currency', 'payment_method', 'bank_name',
            'transaction_reference', 'payment_date', 'status', 'verification_notes',
            'verified_by', 'verified_at',
        ];

        $this->assertEquals($expected, $payment->getFillable());
    }
}
