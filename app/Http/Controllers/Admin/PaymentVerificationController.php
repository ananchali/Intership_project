<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentVerification;
use App\Models\Order;
use App\Services\DashboardStatsService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentVerificationController extends Controller
{
    protected NotificationService $notificationService;
    protected DashboardStatsService $dashboardStatsService;

    public function __construct(
        NotificationService $notificationService,
        DashboardStatsService $dashboardStatsService
    ) {
        $this->notificationService = $notificationService;
        $this->dashboardStatsService = $dashboardStatsService;
    }

    public function index()
    {
        $verifications = PaymentVerification::with(['payment.order', 'processedByUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.verifications.index', compact('verifications'));
    }

    public function pending()
    {
        $verifications = PaymentVerification::with(['payment.order', 'processedByUser'])
            ->pending()
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.verifications.pending', compact('verifications'));
    }

    public function show(PaymentVerification $verification)
    {
        $verification->load(['payment.order', 'processedByUser']);
        return view('admin.verifications.show', compact('verification'));
    }

    public function approve(Request $request, PaymentVerification $verification)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $verification->approve(
            $request->admin_notes,
            Auth::id()
        );

        $order = $verification->payment->order;
        $order->update(['status' => 'verified']);

        $this->notificationService->sendPaymentApprovalNotification($order);

        return redirect()->route('admin.verifications.pending')
            ->with('success', 'Payment verified successfully!');
    }

    public function reject(Request $request, PaymentVerification $verification)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $verification->reject(
            $request->admin_notes,
            Auth::id()
        );

        $this->notificationService->sendPaymentRejectionNotification(
            $verification->payment->order,
            $request->admin_notes
        );

        return redirect()->route('admin.verifications.pending')
            ->with('success', 'Payment rejected successfully!');
    }

    public function dashboard()
    {
        $stats = $this->dashboardStatsService->getVerificationStats();
        $recentVerifications = $this->dashboardStatsService->getRecentVerifications();

        return view('admin.dashboard', compact('stats', 'recentVerifications'));
    }
}
