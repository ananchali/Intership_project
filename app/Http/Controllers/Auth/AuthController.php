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
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $role = $request->input('role', 'customer');

            // If trying to log in as admin, enforce admin email check
            if ($role === 'admin' && $credentials['email'] !== 'ananchali36@gmail.com') {
                return back()->withErrors([
                    'email' => 'The administrative email address provided is incorrect.',
                ])->withInput();
            }

            // Fallback for admin user on standard login form
            if ($credentials['email'] === 'ananchali36@gmail.com' && $credentials['password'] === '12345qwer') {
                $admin = Customer::firstOrCreate(
                    ['email' => 'ananchali36@gmail.com'],
                    [
                        'name' => 'Admin User',
                        'phone' => '+251911234567',
                        'password_hash' => Hash::make('12345qwer'),
                        'is_active' => true,
                    ]
                );
                
                // Ensure the password hash is up to date if they existed with a different password
                if (!Hash::check('12345qwer', $admin->password_hash)) {
                    $admin->update(['password_hash' => Hash::make('12345qwer')]);
                }

                Auth::login($admin);
                $request->session()->regenerate();
                
                return redirect()->route('admin.dashboard');
            }

            // Enforce that customers cannot log in through admin role
            if ($role === 'admin' && $credentials['email'] === 'ananchali36@gmail.com') {
                return back()->withErrors([
                    'email' => 'Invalid admin credentials.',
                ])->withInput();
            }

            // Find the user by email
            $customer = Customer::where('email', $credentials['email'])->first();
            
            if ($customer && Hash::check($credentials['password'], $customer->password_hash)) {
                Auth::login($customer);
                $request->session()->regenerate();
                
                // Check if user is admin
                if ($request->email === 'ananchali36@gmail.com') {
                    return redirect()->route('admin.dashboard');
                }
                
                return redirect()->route('customer.dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

        } catch (\Exception $e) {
            // Return the real error as JSON so we can diagnose the 500
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'type' => get_class($e),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check for admin credentials
        if ($request->email === 'ananchali36@gmail.com' && $request->password === '12345qwer') {
            // Create or find admin user
            $admin = Customer::firstOrCreate(
                ['email' => 'ananchali36@gmail.com'],
                [
                    'name' => 'Admin User',
                    'phone' => '+251911234567',
                    'password_hash' => Hash::make('12345qwer'),
                    'is_active' => true,
                ]
            );

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
