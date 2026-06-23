<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\PaymentVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentVerificationTest extends TestCase
{
    use RefreshDatabase;

    private function createVerification(array $attrs = []): PaymentVerification
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

        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => 1500.00,
            'currency' => 'ETB',
            'payment_method' => 'CBE',
            'bank_name' => 'Commercial Bank of Ethiopia',
            'transaction_reference' => 'TXN-123456',
            'payment_date' => '2026-05-10',
            'status' => 'pending',
        ]);

        return PaymentVerification::create(array_merge([
            'payment_id' => $payment->id,
            'order_id' => $order->id,
            'bank_slip_path' => 'public/bank_slips/slip-001.jpg',
            'customer_name' => 'Test Customer',
            'transaction_reference' => 'TXN-123456',
            'payment_date' => '2026-05-10',
            'bank_name' => 'Commercial Bank of Ethiopia',
            'additional_notes' => 'Payment for hosting',
            'status' => 'pending',
        ], $attrs));
    }

    public function test_verification_can_be_created(): void
    {
        $verification = $this->createVerification();

        $this->assertDatabaseHas('payment_verifications', ['transaction_reference' => 'TXN-123456']);
        $this->assertEquals('pending', $verification->status);
    }

    public function test_scope_pending(): void
    {
        $this->createVerification(['status' => 'pending']);

        $pending = PaymentVerification::pending()->get();

        $this->assertCount(1, $pending);
        $this->assertEquals('pending', $pending->first()->status);
    }

    public function test_approve_method(): void
    {
        $verification = $this->createVerification(['status' => 'pending']);
        $customer = Customer::first();

        $verification->approve('Approved by admin', $customer->id);

        $verification->refresh();
        $this->assertEquals('approved', $verification->status);
        $this->assertEquals('Approved by admin', $verification->admin_notes);
        $this->assertEquals($customer->id, $verification->processed_by);
        $this->assertNotNull($verification->processed_at);
    }

    public function test_approve_without_notes(): void
    {
        $verification = $this->createVerification(['status' => 'pending']);

        $verification->approve();

        $verification->refresh();
        $this->assertEquals('approved', $verification->status);
        $this->assertNull($verification->admin_notes);
    }

    public function test_reject_method(): void
    {
        $verification = $this->createVerification(['status' => 'pending']);
        $customer = Customer::first();

        $verification->reject('Unclear bank slip', $customer->id);

        $verification->refresh();
        $this->assertEquals('rejected', $verification->status);
        $this->assertEquals('Unclear bank slip', $verification->admin_notes);
        $this->assertEquals($customer->id, $verification->processed_by);
        $this->assertNotNull($verification->processed_at);
    }

    public function test_bank_slip_url_attribute_with_public_prefix(): void
    {
        $verification = $this->createVerification(['bank_slip_path' => 'public/bank_slips/slip.jpg']);

        $url = $verification->bank_slip_url;

        $this->assertStringContainsString('storage/bank_slips/slip.jpg', $url);
        $this->assertStringNotContainsString('public/', $url);
    }

    public function test_bank_slip_url_attribute_without_public_prefix(): void
    {
        $verification = $this->createVerification(['bank_slip_path' => 'bank_slips/slip.jpg']);

        $url = $verification->bank_slip_url;

        $this->assertStringContainsString('storage/bank_slips/slip.jpg', $url);
    }

    public function test_bank_slip_url_returns_null_when_no_path(): void
    {
        $verification = $this->createVerification(['bank_slip_path' => null]);

        $this->assertNull($verification->bank_slip_url);
    }

    public function test_verification_belongs_to_payment_relationship(): void
    {
        $verification = $this->createVerification();

        $this->assertInstanceOf(Payment::class, $verification->payment);
    }

    public function test_verification_belongs_to_order_relationship(): void
    {
        $verification = $this->createVerification();

        $this->assertInstanceOf(Order::class, $verification->order);
    }

    public function test_processed_at_cast_to_datetime(): void
    {
        $verification = $this->createVerification();
        $verification->approve('test', 1);
        $verification->refresh();

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $verification->processed_at);
    }

    public function test_fillable_attributes(): void
    {
        $verification = new PaymentVerification();
        $expected = [
            'payment_id', 'order_id', 'bank_slip_path', 'customer_name',
            'transaction_reference', 'payment_date', 'bank_name',
            'additional_notes', 'status', 'admin_notes', 'processed_by', 'processed_at',
        ];

        $this->assertEquals($expected, $verification->getFillable());
    }
}
