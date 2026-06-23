<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return redirect()->route('orders.step1');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'],
        ], [
            'phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)',
            'password.regex' => 'Password must be at least 8 characters and contain uppercase, lowercase, number, and special character',
            'password.min' => 'Password must be at least 8 characters long',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password_hash' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $adminEmail = config('auth.admin_email');
        $role = $request->input('role', 'customer');

        // If trying to log in as admin, enforce admin email check
        if ($role === 'admin' && $adminEmail && $credentials['email'] !== $adminEmail) {
            return back()->withErrors([
                'email' => 'The administrative email address provided is incorrect.',
            ])->withInput();
        }

        // Find the user by email and verify password
        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer && Hash::check($credentials['password'], $customer->password_hash)) {
            Auth::login($customer);
            $request->session()->regenerate();

            // Redirect admin to admin dashboard
            if ($adminEmail && $customer->email === $adminEmail) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $adminEmail = config('auth.admin_email');

        // Only the configured admin email may use this endpoint
        if (!$adminEmail || $request->email !== $adminEmail) {
            return back()->withErrors([
                'email' => 'Invalid admin credentials.',
            ]);
        }

        // Authenticate via hashed password in database
        $admin = Customer::where('email', $adminEmail)->first();

        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            Auth::login($admin);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid admin credentials.',
        ]);
    }

    public function ajaxRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password_hash' => Hash::make($request->password),
            'is_active' => true,
        ]);

        return response()->json(['success' => true]);
    }

    public function ajaxLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $customer = Customer::where('email', $request->email)->first();
        
        if ($customer && Hash::check($request->password, $customer->password_hash)) {
            Auth::login($customer);
            $request->session()->regenerate();
            
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
