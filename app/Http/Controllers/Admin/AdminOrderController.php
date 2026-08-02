<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['package', 'payments.verification', 'business'])
            ->when($this->businessId(), fn($q) => $q->where('business_id', $this->businessId()))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            return redirect()->route('admin.orders.index')->with('error', 'No order ID provided.');
        }

        try {
            $order = Order::findOrFail($id);

            $businessId = $this->businessId();
            if ($businessId && $order->business_id !== $businessId) {
                abort(403);
            }
            
            // Manually ensure related payments and verifications are handled
            foreach ($order->payments as $payment) {
                if ($payment->verification) {
                    $payment->verification->delete();
                }
                $payment->delete();
            }
            
            $order->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Order and all related payment data deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Error deleting order: ' . $e->getMessage());
        }
    }

    private function businessId(): ?int
    {
        $user = auth()->user();
        if (!$user || $user->isSuperAdmin()) {
            return null;
        }
        return $user->business_id;
    }
}
