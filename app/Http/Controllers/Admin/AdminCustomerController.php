<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\HandlesAdminDestroy;
use App\Models\Customer;
use App\Services\CascadeDeleteService;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    use HandlesAdminDestroy;

    protected CascadeDeleteService $cascadeDeleteService;

    public function __construct(CascadeDeleteService $cascadeDeleteService)
    {
        $this->cascadeDeleteService = $cascadeDeleteService;
    }

    public function index()
    {
        $users = Customer::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(Request $request, $id = null)
    {
        return $this->destroyRecord(
            $request,
            $id,
            Customer::class,
            'admin.users.index',
            'User',
            fn ($user) => $this->cascadeDeleteService->deleteAllOrdersForParent($user)
        );
    }
}
