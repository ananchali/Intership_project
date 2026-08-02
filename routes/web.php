<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentVerificationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminPaymentMethodController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\LanguageController;

// Public routes
use App\Http\Controllers\SupportController;
use App\Http\Controllers\PackageController;

Route::get('/', function () {
    return view('yegara-home');
})->name('home');

// Business entry point (customers order through a specific business link)
Route::get('/b/{business}', [AdminBusinessController::class, 'enter'])->name('business.enter');

Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support', [SupportController::class, 'submit'])->name('support.submit');

// How to routes
Route::get('/how-to-buy', function () {
    return view('howto.buy');
})->name('howto.buy');

Route::get('/how-to-hosting', function () {
    return view('howto.hosting');
})->name('howto.hosting');

Route::get('/how-to-transfer', function () {
    return view('howto.transfer');
})->name('howto.transfer');

// Contact routes
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [SupportController::class, 'submit'])->name('contact.submit');

// Payment verification routes
Route::get('/payment-verify', function () {
    $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)->get();
    return view('payments.verify', compact('paymentMethods'));
})->name('payment.verify');
Route::post('/payment-verify', [PaymentVerificationController::class, 'submit'])->name('payment.verify.submit');

// Yegara flow routes (requires login so guests cannot order without an account)
Route::get('/order-yegara', function (\Illuminate\Http\Request $request) {
    $order = null;
    if ($request->has('order_id')) {
        $order = \App\Models\Order::with('package')->find($request->order_id);
    }
    $packageForFilter = $request->package_id ? \App\Models\Package::find($request->package_id) : null;
    $packageType = $packageForFilter ? $packageForFilter->type : ($order?->package?->type ?? null);
    $packageProvider = $packageForFilter ? $packageForFilter->provider : ($order?->package?->provider ?? null);
    $packageId = $packageForFilter ? $packageForFilter->id : ($order?->package?->id ?? null);
    $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)
        ->when($packageType, fn($q) => $q->forType($packageType, $packageProvider, $packageId))
        ->get();
    $all = \App\Models\Package::active()->get();
    $grouped = collect();
    $all->groupBy('type')->each(function ($items, $type) use ($grouped) {
        if ($type === 'services') {
            $grouped[$type] = $items->groupBy('provider');
        } else {
            $grouped[$type] = $items;
        }
    });
    $packages = $grouped;
    
    return view('orders.yegara-flow', compact('order', 'paymentMethods', 'packages'));
})->middleware('auth')->name('orders.yegara-flow');
Route::post('/order-yegara/step2-domain', [OrderController::class, 'yegaraStoreDomain'])->middleware('auth')->name('orders.yegara-step2-domain');
Route::post('/order-yegara/step2-level', [OrderController::class, 'yegaraStoreLevel'])->middleware('auth')->name('orders.yegara-step2-level');
Route::post('/order-yegara/place', [OrderController::class, 'yegaraPlaceOrder'])->middleware('auth')->name('orders.yegara-place');
Route::post('/order-yegara/place-service', [OrderController::class, 'yegaraPlaceServiceOrder'])->middleware('auth')->name('orders.yegara-place-service');

// Packages route
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

// Domain routes
Route::get('/domains/register', function () {
    return view('domains.register');
})->name('domains.register');

Route::get('/domains/pricing', function () {
    return view('domains.pricing');
})->name('domains.pricing');

Route::get('/domains/whois', function () {
    return view('domains.whois');
})->name('domains.whois');

use App\Http\Controllers\CustomerDashboardController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/vendor/register', [AuthController::class, 'showVendorRegister'])->name('vendor.register');
Route::post('/vendor/register', [AuthController::class, 'vendorRegister'])->name('vendor.register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Modal Auth endpoints
Route::post('/ajax-register', [AuthController::class, 'ajaxRegister'])->name('ajax.register');
Route::post('/ajax-login', [AuthController::class, 'ajaxLogin'])->name('ajax.login');

// OTP routes
Route::post('/otp/send', [AuthController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');

// Login OTP (2FA)
Route::get('/login/otp', [AuthController::class, 'showLoginOtp'])->name('login.otp');
Route::post('/login/otp', [AuthController::class, 'loginVerifyOtp'])->name('login.otp.verify');
Route::post('/login/otp/resend', [AuthController::class, 'resendLoginOtp'])->name('login.otp.resend');
Route::post('/ajax-login-otp', [AuthController::class, 'ajaxLoginVerifyOtp'])->name('ajax.login.otp');
Route::post('/ajax-login-otp/resend', [AuthController::class, 'ajaxResendLoginOtp'])->name('ajax.login.otp.resend');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// Order routes (requires login so guests cannot order without an account)
Route::prefix('order')->middleware('auth')->name('orders.')->group(function () {
    Route::get('/step-1', [OrderController::class, 'step1'])->name('step1');
    Route::match(['get', 'post'], '/step-2', [OrderController::class, 'step2'])->name('step2');
    Route::match(['get', 'post'], '/step-3', [OrderController::class, 'step3'])->name('step3');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');
    
    Route::get('/{order}/payment', [OrderController::class, 'step4'])->name('step4');
    Route::get('/{order}/confirm', [PaymentVerificationController::class, 'show'])->name('orders.step5');
    Route::post('/{order}/confirm', [PaymentVerificationController::class, 'submit'])->name('orders.submit');
});

Route::get('/success', [PaymentVerificationController::class, 'success'])->name('orders.success')->middleware('auth');

// Payment status check routes
Route::get('/payment-status', [PaymentVerificationController::class, 'checkStatus'])->name('payment-status.check');
Route::get('/payment-status/{order_id}', [PaymentVerificationController::class, 'showStatus'])->name('payment-status.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.submit');
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Business Management (super admin only)
        Route::get('businesses/delete-record', [AdminBusinessController::class, 'destroy'])->middleware('super_admin')->name('businesses.delete');
        Route::resource('businesses', AdminBusinessController::class)->only(['index', 'create', 'store', 'edit', 'update'])->middleware('super_admin');
        Route::post('businesses/{business}/approve', [AdminBusinessController::class, 'approve'])->middleware('super_admin')->name('businesses.approve');
        Route::post('businesses/{business}/reject', [AdminBusinessController::class, 'reject'])->middleware('super_admin')->name('businesses.reject');
        
        // Package Management
        Route::get('packages/delete-record', [AdminPackageController::class, 'destroy'])->name('packages.delete');
        Route::resource('packages', AdminPackageController::class);
        
        // Order Management
        Route::get('orders/delete-record', [AdminOrderController::class, 'destroy'])->name('orders.delete');
        Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
        
        // User Management
        Route::get('users/delete-record', [AdminCustomerController::class, 'destroy'])->name('users.delete');
        Route::get('users', [AdminCustomerController::class, 'index'])->name('users.index');
        
        // Payment Method Management
        Route::get('payment-methods/{id}/delete', [AdminPaymentMethodController::class, 'destroy'])->name('payment-methods.delete');
        Route::resource('payment-methods', AdminPaymentMethodController::class);

        Route::get('/verifications', [AdminController::class, 'verifications'])->name('verifications.index');
        Route::get('/verifications/pending', [AdminController::class, 'pending'])->name('verifications.pending');
        Route::get('/verifications/{verification}', [AdminController::class, 'show'])->name('verifications.show');
        Route::get('/verifications/{verification}/slip', [AdminController::class, 'showSlip'])->name('verifications.slip');
        Route::post('/verifications/{verification}/process', [AdminController::class, 'process'])->name('verifications.process');
        Route::post('/notifications/{id}/dismiss', [AdminController::class, 'dismissNotification'])->name('notifications.dismiss');
        Route::post('/notifications/dismiss-all', [AdminController::class, 'dismissAllNotifications'])->name('notifications.dismiss-all');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

// Language switching route
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');
