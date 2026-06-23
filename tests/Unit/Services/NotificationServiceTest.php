<?php

namespace Tests\Unit\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\PaymentVerification;
use App\Services\NotificationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class NotificationServiceTest extends TestCase
{
    use RefreshDatabase;

    private NotificationService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new NotificationService();
    }

    private function createOrder(array $customerDetails = []): Order
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

        return Order::create([
            'order_number' => 'ORD-2026-000001',
            'package_id' => $package->id,
            'customer_id' => $customer->id,
            'domain_name' => 'example.com',
            'domain_type' => 'register',
            'status' => 'pending',
            'total_amount' => 1500.00,
            'currency' => 'ETB',
            'customer_details' => array_merge([
                'name' => 'Test Customer',
                'email' => 'customer@example.com',
                'phone' => '0911223344',
            ], $customerDetails),
            'payment_method' => 'CBE',
        ]);
    }

    public function test_send_order_confirmation_returns_true(): void
    {
        $order = $this->createOrder();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'customer@example.com')
                    && $context['order_number'] === 'ORD-2026-000001';
            });

        $result = $this->service->sendOrderConfirmation($order);

        $this->assertTrue($result);
    }

    public function test_send_order_confirmation_returns_false_on_exception(): void
    {
        $order = $this->createOrder();
        $order->customer_details = null; // Will cause exception when accessing email

        Log::shouldReceive('error')->once();

        $result = $this->service->sendOrderConfirmation($order);

        $this->assertFalse($result);
    }

    public function test_send_payment_verification_confirmation_returns_true(): void
    {
        $order = $this->createOrder();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Payment verification confirmation')
                    && $context['order_number'] === 'ORD-2026-000001';
            });

        $result = $this->service->sendPaymentVerificationConfirmation($order);

        $this->assertTrue($result);
    }

    public function test_send_payment_verification_confirmation_returns_false_on_exception(): void
    {
        $order = $this->createOrder();
        $order->customer_details = null;

        Log::shouldReceive('error')->once();

        $result = $this->service->sendPaymentVerificationConfirmation($order);

        $this->assertFalse($result);
    }

    public function test_send_payment_approval_notification_returns_true(): void
    {
        $order = $this->createOrder();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Payment approval notification')
                    && $context['order_number'] === 'ORD-2026-000001';
            });

        $result = $this->service->sendPaymentApprovalNotification($order);

        $this->assertTrue($result);
    }

    public function test_send_payment_approval_notification_returns_false_on_exception(): void
    {
        $order = $this->createOrder();
        $order->customer_details = null;

        Log::shouldReceive('error')->once();

        $result = $this->service->sendPaymentApprovalNotification($order);

        $this->assertFalse($result);
    }

    public function test_send_payment_rejection_notification_returns_true(): void
    {
        $order = $this->createOrder();

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Payment rejection notification')
                    && $context['order_number'] === 'ORD-2026-000001'
                    && $context['reason'] === 'Invalid slip';
            });

        $result = $this->service->sendPaymentRejectionNotification($order, 'Invalid slip');

        $this->assertTrue($result);
    }

    public function test_send_payment_rejection_notification_returns_false_on_exception(): void
    {
        $order = $this->createOrder();
        $order->customer_details = null;

        Log::shouldReceive('error')->once();

        $result = $this->service->sendPaymentRejectionNotification($order, 'reason');

        $this->assertFalse($result);
    }

    public function test_send_admin_new_verification_notification_returns_true(): void
    {
        $order = $this->createOrder();
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => 1500.00,
            'currency' => 'ETB',
            'payment_method' => 'CBE',
            'bank_name' => 'CBE',
            'transaction_reference' => 'TXN-123',
            'payment_date' => '2026-05-10',
            'status' => 'pending',
        ]);

        $verification = PaymentVerification::create([
            'payment_id' => $payment->id,
            'order_id' => $order->id,
            'bank_slip_path' => 'slips/test.jpg',
            'customer_name' => 'Test',
            'transaction_reference' => 'TXN-123',
            'payment_date' => '2026-05-10',
            'bank_name' => 'CBE',
            'status' => 'pending',
        ]);

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                return str_contains($message, 'Admin notification')
                    && $context['transaction_reference'] === 'TXN-123';
            });

        $result = $this->service->sendAdminNewVerificationNotification($verification);

        $this->assertTrue($result);
    }

    public function test_send_admin_notification_returns_false_on_exception(): void
    {
        // Create a verification without proper relationships to trigger exception
        $verification = new PaymentVerification();
        $verification->transaction_reference = 'TXN-999';

        Log::shouldReceive('error')->once();

        $result = $this->service->sendAdminNewVerificationNotification($verification);

        $this->assertFalse($result);
    }
}
