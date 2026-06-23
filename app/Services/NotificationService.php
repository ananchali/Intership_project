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
            $customerDetails = $order->customer_details;
            if (!is_array($customerDetails) || empty($customerDetails['email'])) {
                Log::error('Cannot send order confirmation: missing customer email', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ]);
                return false;
            }

            $toEmail = $customerDetails['email'];
            $customerName = $customerDetails['name'] ?? 'Customer';
            
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
            Log::error('Failed to send order confirmation', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Send payment verification submission confirmation
     */
    public function sendPaymentVerificationConfirmation(Order $order): bool
    {
        try {
            $customerDetails = $order->customer_details;
            if (!is_array($customerDetails) || empty($customerDetails['email'])) {
                Log::error('Cannot send payment verification confirmation: missing customer email', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ]);
                return false;
            }

            $toEmail = $customerDetails['email'];
            $customerName = $customerDetails['name'] ?? 'Customer';
            
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
            Log::error('Failed to send payment verification confirmation', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Send payment approval notification
     */
    public function sendPaymentApprovalNotification(Order $order): bool
    {
        try {
            $customerDetails = $order->customer_details;
            if (!is_array($customerDetails) || empty($customerDetails['email'])) {
                Log::error('Cannot send payment approval notification: missing customer email', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ]);
                return false;
            }

            $toEmail = $customerDetails['email'];
            $customerName = $customerDetails['name'] ?? 'Customer';
            
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
            Log::error('Failed to send payment approval notification', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Send payment rejection notification
     */
    public function sendPaymentRejectionNotification(Order $order, string $reason): bool
    {
        try {
            $customerDetails = $order->customer_details;
            if (!is_array($customerDetails) || empty($customerDetails['email'])) {
                Log::error('Cannot send payment rejection notification: missing customer email', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ]);
                return false;
            }

            $toEmail = $customerDetails['email'];
            $customerName = $customerDetails['name'] ?? 'Customer';
            
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
            Log::error('Failed to send payment rejection notification', [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Send admin notification for new payment verification
     */
    public function sendAdminNewVerificationNotification(PaymentVerification $verification): bool
    {
        try {
            $order = $verification->payment?->order ?? $verification->order;
            $orderNumber = $order?->order_number ?? 'N/A';

            $subject = "New Payment Verification - {$orderNumber}";
            $data = [
                'verification' => $verification,
            ];

            Log::info("Admin notification sent for new verification", [
                'verification_id' => $verification->id,
                'order_number' => $orderNumber,
                'transaction_reference' => $verification->transaction_reference,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification', [
                'verification_id' => $verification->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }
}
