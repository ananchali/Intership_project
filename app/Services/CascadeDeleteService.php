<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;

class CascadeDeleteService
{
    /**
     * Delete all payments and their verifications for a given order.
     */
    public function deleteOrderPayments(Order $order): void
    {
        foreach ($order->payments as $payment) {
            $this->deletePaymentVerifications($payment);
            $payment->delete();
        }
    }

    /**
     * Delete verifications associated with a payment.
     */
    public function deletePaymentVerifications(Payment $payment): void
    {
        if ($payment->verification) {
            $payment->verification->delete();
        }
    }

    /**
     * Delete an order and all its related payment data.
     */
    public function deleteOrderWithRelations(Order $order): void
    {
        $this->deleteOrderPayments($order);
        $order->delete();
    }

    /**
     * Delete all orders (and their related data) for a given model that has orders.
     *
     * @param \Illuminate\Database\Eloquent\Model $parent Model with an `orders` relationship
     */
    public function deleteAllOrdersForParent($parent): void
    {
        foreach ($parent->orders as $order) {
            $this->deleteOrderWithRelations($order);
        }
    }
}
