<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\HandlesAdminDestroy;
use App\Models\Order;
use App\Services\CascadeDeleteService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    use HandlesAdminDestroy;

    protected CascadeDeleteService $cascadeDeleteService;

    public function __construct(CascadeDeleteService $cascadeDeleteService)
    {
        $this->cascadeDeleteService = $cascadeDeleteService;
    }

    public function index()
    {
        $orders = Order::with(['package', 'payments.verification'])
            ->where('status', '!=', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }

    public function destroy(Request $request, $id = null)
    {
        return $this->destroyRecord(
            $request,
            $id,
            Order::class,
            'admin.orders.index',
            'Order',
            fn ($order) => $this->cascadeDeleteService->deleteOrderPayments($order)
        );
    }
}
