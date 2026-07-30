<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $users = Customer::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            return redirect()->route('admin.users.index')->with('error', 'No user ID provided.');
        }

        try {
            $user = Customer::findOrFail($id);
            
            // Manually ensure related orders, payments and verifications are handled
            foreach ($user->orders as $order) {
                foreach ($order->payments as $payment) {
                    if ($payment->verification) {
                        $payment->verification->delete();
                    }
                    $payment->delete();
                }
                $order->delete();
            }
            
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User and all related data deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
}
