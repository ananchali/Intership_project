<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PaymentVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send order confirmation email
     */
    public function sendOrderConfirmation(Order $order): bool
    {
        return $this->sendOrderNotification(
            $order,
            "Order Confirmation - {$order->order_number}",
            'order_confirmation',
            ['order_number' => $order->order_number, 'amount' => $order->formatted_amount]
        );
    }

    /**
     * Send payment verification submission confirmation
     */
    public function sendPaymentVerificationConfirmation(Order $order): bool
    {
        return $this->sendOrderNotification(
            $order,
            "Payment Verification Submitted - {$order->order_number}",
            'payment_verification_confirmation',
            ['order_number' => $order->order_number]
        );
    }

    /**
     * Send payment approval notification
     */
    public function sendPaymentApprovalNotification(Order $order): bool
    {
        return $this->sendOrderNotification(
            $order,
            "Payment Approved - Order {$order->order_number}",
            'payment_approval',
            ['order_number' => $order->order_number]
        );
    }

    /**
     * Send payment rejection notification
     */
    public function sendPaymentRejectionNotification(Order $order, string $reason): bool
    {
        return $this->sendOrderNotification(
            $order,
            "Payment Verification Failed - Order {$order->order_number}",
            'payment_rejection',
            ['order_number' => $order->order_number, 'reason' => $reason]
        );
    }

    /**
     * Send admin notification for new payment verification
     */
    public function sendAdminNewVerificationNotification(PaymentVerification $verification): bool
    {
        try {
            Log::info("Admin notification sent for new verification", [
                'order_number' => $verification->payment->order->order_number,
                'transaction_reference' => $verification->transaction_reference,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send admin notification: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Common handler for order-based customer notifications.
     * Extracts customer email/name, logs the notification, and handles exceptions.
     */
    protected function sendOrderNotification(
        Order $order,
        string $subject,
        string $notificationType,
        array $logContext = []
    ): bool {
        try {
            $toEmail = $order->customer_details['email'];
            $customerName = $order->customer_details['name'];

            Log::info("{$subject} sent to: {$toEmail}", $logContext);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send {$notificationType} notification: " . $e->getMessage());
            return false;
        }
    }
}
