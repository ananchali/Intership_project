<?php

namespace App\Services;

use App\Models\PaymentVerification;

class DashboardStatsService
{
    /**
     * Get verification statistics for the admin dashboard.
     */
    public function getVerificationStats(): array
    {
        return [
            'total_verifications' => PaymentVerification::count(),
            'pending_verifications' => PaymentVerification::pending()->count(),
            'approved_today' => PaymentVerification::where('status', 'approved')
                ->whereDate('processed_at', today())->count(),
            'rejected_today' => PaymentVerification::where('status', 'rejected')
                ->whereDate('processed_at', today())->count(),
        ];
    }

    /**
     * Get recent verifications for the admin dashboard.
     */
    public function getRecentVerifications(int $limit = 10)
    {
        return PaymentVerification::with(['payment.order', 'order'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
