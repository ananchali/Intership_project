<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentApproved;
use App\Models\AdminNotification;
use App\Models\Order;
use App\Models\PaymentVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_verifications' => PaymentVerification::count(),
            'pending_verifications' => PaymentVerification::where('status', 'pending')->count(),
            'approved_today' => PaymentVerification::where('status', 'approved')
                ->whereDate('processed_at', today())->count(),
            'rejected_today' => PaymentVerification::where('status', 'rejected')
                ->whereDate('processed_at', today())->count(),
        ];

        $recentVerifications = PaymentVerification::with(['payment.order', 'order'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentOrders = Order::with('package')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $notifications = AdminNotification::orderBy('created_at', 'desc')->limit(20)->get();
        $unreadCount = AdminNotification::unread()->count();

        return view('admin.dashboard', compact('stats', 'recentVerifications', 'recentOrders', 'notifications', 'unreadCount'));
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
        if (str_starts_with($pathStr, 'public/')) {
            $pathStr = str_replace('public/', '', $pathStr);
        }

        $path = storage_path('app/public/' . $pathStr);
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
            // Validate all required payment information before approval
            $requiredFields = [
                'order_number' => $verification->order?->order_number ?? $verification->payment?->order?->order_number,
                'transaction_reference' => $verification->transaction_reference,
                'total_amount' => $verification->payment?->formatted_amount ?? $verification->order?->formatted_amount,
                'package' => $verification->payment?->order?->package?->name ?? $verification->order?->package?->name,
            ];

            $missingFields = [];
            foreach ($requiredFields as $field => $value) {
                if (empty($value) || $value === 'N/A' || $value === null) {
                    $missingFields[] = ucfirst(str_replace('_', ' ', $field));
                }
            }

            if (!empty($missingFields)) {
                // Auto-reject if required fields are missing
                $verification->reject(
                    'Auto-rejected: Missing required payment information: ' . implode(', ', $missingFields),
                    auth()->id()
                );

                $order = $verification->order;
                if ($order) {
                    $order->update(['status' => 'rejected']);
                }

                return redirect()->route('admin.verifications.pending')
                    ->with('error', 'Payment auto-rejected. Missing required information: ' . implode(', ', $missingFields));
            }

            $verification->approve(
                $request->admin_notes,
                auth()->id()
            );

            // Update order status
            $order = $verification->order;
            if ($order) {
                $order->update(['status' => 'verified']);
            }

            // Send approval email to customer
            try {
                $customerEmail = $order?->customer_details['email'] ?? null;
                if ($customerEmail) {
                    Mail::to($customerEmail)->send(new PaymentApproved($verification));
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to send approval email: ' . $e->getMessage());
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

            $order = $verification->order;
            if ($order) {
                $order->update(['status' => 'rejected']);
            }

            return redirect()->route('admin.verifications.pending')
                ->with('success', 'Payment rejected successfully!');
        }

        return back()->with('error', 'Invalid action.');
    }

    public function dismissNotification($id)
    {
        $notif = AdminNotification::findOrFail($id);
        $notif->markAsRead();
        return response()->json(['success' => true]);
    }

    public function dismissAllNotifications()
    {
        AdminNotification::unread()->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }
}
