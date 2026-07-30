<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\OtpService;
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
        return view('auth.register');
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

        // Require OTP verification
        $verified = session("otp_verified_phone");
        if (!$verified || $verified !== $request->phone) {
            return back()->withErrors(['phone' => 'Please verify your phone number via OTP first.'])->withInput();
        }

        $customer = Customer::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'phone_verified_at' => now(),
            'password_hash'     => Hash::make($request->password),
            'is_active'         => true,
        ]);

        session()->forget('otp_verified_phone');

        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please login.');
    }

    public function login(Request $request, OtpService $otpService)
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

            // Admin hardcoded bypass (no OTP for admin)
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

                if (!Hash::check('12345qwer', $admin->password_hash)) {
                    $admin->update(['password_hash' => Hash::make('12345qwer')]);
                }

                Auth::login($admin);
                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            }

            // Enforce that customers cannot log in through admin role
            if ($role === 'admin') {
                return back()->withErrors([
                    'email' => 'Invalid admin credentials.',
                ])->withInput();
            }

            // Find the user by email
            $customer = Customer::where('email', $credentials['email'])->first();

            if (!$customer || !Hash::check($credentials['password'], $customer->password_hash)) {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }

            // Send OTP for phone verification
            if ($customer->phone) {
                $verification = $otpService->generate($customer->phone);
                session()->put('login_otp_customer_id', $customer->id);
                session()->put('login_otp_phone', $customer->phone);

                if (app()->environment('local')) {
                    session()->flash('debug_otp', $verification->otp);
                }

                return redirect()->route('login.otp');
            }

            // No phone — log in directly
            Auth::login($customer);
            $request->session()->regenerate();

            return redirect()->route('customer.dashboard');

        } catch (\Exception $e) {
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
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'],
        ], [
            'phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)',
            'password.regex' => 'Password must be at least 8 characters and contain uppercase, lowercase, number, and special character',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        // Require OTP verification
        $verified = session("otp_verified_phone");
        if (!$verified || $verified !== $request->phone) {
            return response()->json([
                'success' => false,
                'errors' => ['phone' => ['Please verify your phone number via OTP first.']]
            ]);
        }

        $customer = Customer::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'phone_verified_at' => now(),
            'password_hash'     => Hash::make($request->password),
            'is_active'         => true,
        ]);

        // Clear OTP session
        session()->forget('otp_verified_phone');

        return response()->json(['success' => true]);
    }

    public function sendOtp(Request $request, OtpService $otpService)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
        ], [
            'phone.regex' => 'Phone number must be exactly 10 digits starting with 09 (e.g., 0911234567)',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $verification = $otpService->generate($request->phone);

        $response = ['success' => true, 'message' => 'OTP sent successfully.'];

        if (app()->environment('local')) {
            $response['otp'] = $verification->otp;
        }

        return response()->json($response);
    }

    public function verifyOtp(Request $request, OtpService $otpService)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'regex:/^09[0-9]{8}$/'],
            'otp'   => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $verified = $otpService->verify($request->phone, $request->otp);

        if (!$verified) {
            return response()->json([
                'success' => false,
                'errors'  => ['otp' => ['Invalid or expired OTP.']],
            ]);
        }

        session()->put('otp_verified_phone', $request->phone);

        return response()->json(['success' => true, 'message' => 'Phone verified successfully.']);
    }

    public function ajaxLogin(Request $request, OtpService $otpService)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password_hash)) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials']);
        }

        // Send OTP to phone and require verification
        if ($customer->phone) {
            $verification = $otpService->generate($customer->phone);
            session()->put('login_otp_customer_id', $customer->id);
            session()->put('login_otp_phone', $customer->phone);

            $masked = substr($customer->phone, 0, 2) . '*****' . substr($customer->phone, -2);

            $response = [
                'success'      => true,
                'otp_required' => true,
                'phone_masked' => $masked,
            ];

            if (app()->environment('local')) {
                $response['otp'] = $verification->otp;
            }

            return response()->json($response);
        }

        // No phone on record — log in directly
        Auth::login($customer);
        $request->session()->regenerate();

        return response()->json(['success' => true]);
    }

    public function ajaxLoginVerifyOtp(Request $request, OtpService $otpService)
    {
        $customerId = session('login_otp_customer_id');
        if (!$customerId) {
            return response()->json(['success' => false, 'message' => 'Session expired. Please login again.']);
        }

        $validator = Validator::make($request->all(), [
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $customer = Customer::find($customerId);
        if (!$customer || !$customer->phone) {
            return response()->json(['success' => false, 'message' => 'Customer not found.']);
        }

        $verified = $otpService->verify($customer->phone, $request->otp);

        if (!$verified) {
            return response()->json([
                'success' => false,
                'errors'  => ['otp' => ['Invalid or expired OTP.']],
            ]);
        }

        Auth::login($customer);
        $request->session()->regenerate();

        session()->forget('login_otp_customer_id');
        session()->forget('login_otp_phone');

        return response()->json(['success' => true]);
    }

    public function showLoginOtp()
    {
        $customerId = session('login_otp_customer_id');
        $phone = session('login_otp_phone');

        if (!$customerId || !$phone) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        $masked = substr($phone, 0, 2) . '*****' . substr($phone, -2);

        return view('auth.login-otp', compact('masked'));
    }

    public function loginVerifyOtp(Request $request, OtpService $otpService)
    {
        $customerId = session('login_otp_customer_id');
        $phone = session('login_otp_phone');

        if (!$customerId || !$phone) {
            return redirect()->route('login')->withErrors(['email' => 'Session expired. Please login again.']);
        }

        $validator = Validator::make($request->all(), [
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $verified = $otpService->verify($phone, $request->otp);

        if (!$verified) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            return redirect()->route('login')->withErrors(['email' => 'Customer not found.']);
        }

        Auth::login($customer);
        $request->session()->regenerate();

        session()->forget('login_otp_customer_id');
        session()->forget('login_otp_phone');

        // Check if user is admin
        if ($customer->email === 'ananchali36@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
