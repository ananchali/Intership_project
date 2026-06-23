<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\BankSlipHelper;
use App\Models\PaymentVerification;
use App\Services\DashboardStatsService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected DashboardStatsService $dashboardStatsService;

    public function __construct(DashboardStatsService $dashboardStatsService)
    {
        $this->dashboardStatsService = $dashboardStatsService;
    }

    public function dashboard()
    {
        $stats = $this->dashboardStatsService->getVerificationStats();
        $recentVerifications = $this->dashboardStatsService->getRecentVerifications();

        return view('admin.dashboard', compact('stats', 'recentVerifications'));
    }

    public function verifications()
    {
        $verifications = PaymentVerification::with(['payment.order', 'order', 'processedByUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.verifications.index', compact('verifications'));
    }

    public function pending()
    {
        $verifications = PaymentVerification::with(['payment.order', 'order', 'processedByUser'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(20);

        return view('admin.verifications.pending', compact('verifications'));
    }

    public function show(PaymentVerification $verification)
    {
        $verification->load(['payment.order', 'order', 'processedByUser']);
        return view('admin.verifications.show', compact('verification'));
    }

    public function showSlip(PaymentVerification $verification)
    {
        $pathStr = $verification->bank_slip_path;
        $path = BankSlipHelper::storagePath($pathStr);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function process(Request $request, PaymentVerification $verification)
    {
        \Log::info('Verification process started', [
            'verification_id' => $verification->id,
            'action' => $request->input('action'),
            'admin_notes' => $request->input('admin_notes')
        ]);

        $action = $request->input('action');
        
        if ($action === 'approve') {
            $requiredFields = [
                'order_number' => $verification->order?->order_number ?? $verification->payment?->order?->order_number,
                'bank_name' => $verification->bank_name,
                'transaction_reference' => $verification->transaction_reference,
                'total_amount' => $verification->payment?->formatted_amount ?? $verification->order?->formatted_amount,
                'package' => $verification->payment?->order?->package?->name ?? $verification->order?->package?->name,
                'payment_date' => $verification->payment_date,
                'bank_slip' => $verification->bank_slip_path,
            ];

            $missingFields = [];
            foreach ($requiredFields as $field => $value) {
                if (empty($value) || $value === 'N/A' || $value === null) {
                    $missingFields[] = ucfirst(str_replace('_', ' ', $field));
                }
            }

            if (!empty($missingFields)) {
                $verification->reject(
                    'Auto-rejected: Missing required payment information: ' . implode(', ', $missingFields),
                    auth()->id()
                );

                return redirect()->route('admin.verifications.pending')
                    ->with('error', 'Payment auto-rejected. Missing required information: ' . implode(', ', $missingFields));
            }

            $verification->approve(
                $request->admin_notes,
                auth()->id()
            );

            $order = $verification->order;
            if ($order) {
                $order->update(['status' => 'verified']);
            }

            return redirect()->route('admin.verifications.pending')
                ->with('success', 'Payment verified successfully!');
        } 
        
        if ($action === 'reject') {
            $request->validate([
                'admin_notes' => 'required|string|max:1000',
            ], [
                'admin_notes.required' => 'Please provide a reason for rejection in the notes field.'
            ]);

            $verification->reject(
                $request->admin_notes,
                auth()->id()
            );

            return redirect()->route('admin.verifications.pending')
                ->with('success', 'Payment rejected successfully!');
        }

        return back()->with('error', 'Invalid action.');
    }
}
