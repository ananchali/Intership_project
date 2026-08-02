<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ensure user is an admin user (not a regular customer)
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $orders = Order::with(['package', 'verification'])
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $selectedPackage = null;
        if ($request->has('package_id')) {
            $selectedPackage = \App\Models\Package::find($request->package_id);
        }

        return view('customer.dashboard', compact('user', 'orders', 'selectedPackage'));
    }
}
