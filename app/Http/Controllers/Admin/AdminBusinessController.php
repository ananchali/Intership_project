<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminBusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::with('owner')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.businesses.index', compact('businesses'));
    }

    public function create()
    {
        return view('admin.businesses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:businesses,slug'],
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'email', 'max:255', 'unique:customers,email', 'unique:businesses,owner_email'],
            'owner_phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'owner_password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'owner_phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)',
            'owner_password.min' => 'Password must be at least 8 characters long',
        ]);

        $business = Business::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'owner_name' => $request->owner_name,
            'owner_email' => $request->owner_email,
            'owner_phone' => $request->owner_phone,
            'is_active' => true,
            'status' => Business::STATUS_APPROVED,
        ]);

        Customer::create([
            'name' => $request->owner_name,
            'email' => $request->owner_email,
            'phone' => $request->owner_phone,
            'phone_verified_at' => now(),
            'password_hash' => Hash::make($request->owner_password),
            'is_active' => true,
            'role' => Customer::ROLE_BUSINESS_OWNER,
            'business_id' => $business->id,
        ]);

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Business and its owner account created successfully.');
    }

    public function edit(Business $business)
    {
        $owner = $business->owner;
        return view('admin.businesses.edit', compact('business', 'owner'));
    }

    public function update(Request $request, Business $business)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:businesses,slug,' . $business->id],
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'owner_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_active' => ['sometimes', 'boolean'],
        ], [
            'owner_phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)',
            'owner_password.min' => 'Password must be at least 8 characters long',
        ]);

        $business->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'owner_name' => $request->owner_name,
            'owner_phone' => $request->owner_phone,
            'is_active' => $request->boolean('is_active'),
        ]);

        $owner = $business->owner;
        if ($owner) {
            $owner->update([
                'name' => $request->owner_name,
                'phone' => $request->owner_phone,
                'is_active' => $request->boolean('is_active'),
            ]);

            if ($request->filled('owner_password')) {
                $owner->update(['password_hash' => Hash::make($request->owner_password)]);
            }
        }

        return redirect()->route('admin.businesses.index')
            ->with('success', 'Business updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        $id = $id ?: $request->query('id');
        if (!$id) {
            return redirect()->route('admin.businesses.index')->with('error', 'No business ID provided.');
        }

        try {
            $business = Business::findOrFail($id);
            $owner = $business->owner;

            if ($owner) {
                $owner->delete();
            }

            $business->delete();

            return redirect()->route('admin.businesses.index')
                ->with('success', 'Business and its owner account deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.businesses.index')
                ->with('error', 'Error deleting business: ' . $e->getMessage());
        }
    }

    public function enter($slug)
    {
        $business = Business::where('slug', $slug)->approved()->active()->firstOrFail();
        session(['business_id' => $business->id]);

        return redirect()->route('home')
            ->with('success', 'Welcome to ' . $business->name . '! Browse our packages and place your order.');
    }

    public function approve(Business $business)
    {
        $business->update([
            'status' => Business::STATUS_APPROVED,
            'is_active' => true,
        ]);

        return redirect()->route('admin.businesses.index')
            ->with('success', $business->name . ' has been approved and is now live.');
    }

    public function reject(Business $business)
    {
        $business->update([
            'status' => Business::STATUS_REJECTED,
            'is_active' => false,
        ]);

        return redirect()->route('admin.businesses.index')
            ->with('success', $business->name . ' has been rejected.');
    }
}
