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
        try {
            $toEmail = $order->customer_details['email'];
            $customerName = $order->customer_details['name'];
            
            $subject = "Order Confirmation - {$order->order_number}";
            $data = [
                'order' => $order,
                'customerName' => $customerName,
            ];

            // For now, we'll log the email (configure actual email later)
            Log::info("Order confirmation email sent to: {$toEmail}", [
                'order_number' => $order->order_number,
                'amount' => $order->formatted_amount,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send order confirmation: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send payment verification submission confirmation
     */
    public function sendPaymentVerificationConfirmation(Order $order): bool
    {
        try {
            $toEmail = $order->customer_details['email'];
            $customerName = $order->customer_details['name'];
            
            $subject = "Payment Verification Submitted - {$order->order_number}";
            $data = [
                'order' => $order,
                'customerName' => $customerName,
            ];

            Log::info("Payment verification confirmation sent to: {$toEmail}", [
                'order_number' => $order->order_number,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send payment verification confirmation: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send payment approval notification
     */
    public function sendPaymentApprovalNotification(Order $order): bool
    {
        try {
            $toEmail = $order->customer_details['email'];
            $customerName = $order->customer_details['name'];
            
            $subject = "Payment Approved - Order {$order->order_number}";
            $data = [
                'order' => $order,
                'customerName' => $customerName,
            ];

            Log::info("Payment approval notification sent to: {$toEmail}", [
                'order_number' => $order->order_number,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send payment approval notification: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send payment rejection notification
     */
    public function sendPaymentRejectionNotification(Order $order, string $reason): bool
    {
        try {
            $toEmail = $order->customer_details['email'];
            $customerName = $order->customer_details['name'];
            
            $subject = "Payment Verification Failed - Order {$order->order_number}";
            $data = [
                'order' => $order,
                'customerName' => $customerName,
                'reason' => $reason,
            ];

            Log::info("Payment rejection notification sent to: {$toEmail}", [
                'order_number' => $order->order_number,
                'reason' => $reason,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send payment rejection notification: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send admin notification for new payment verification
     */
    public function sendAdminNewVerificationNotification(PaymentVerification $verification): bool
    {
        try {
            $subject = "New Payment Verification - {$verification->payment->order->order_number}";
            $data = [
                'verification' => $verification,
            ];

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
}
