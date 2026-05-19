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

// Public routes
use App\Http\Controllers\SupportController;

Route::get('/', function () {
    return view('yegara-home');
})->name('home');

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

// Yegara flow routes
Route::get('/order-yegara', function (\Illuminate\Http\Request $request) {
    $order = null;
    if ($request->has('order_id')) {
        $order = \App\Models\Order::with('package')->find($request->order_id);
    }
    $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)->get();
    
    return view('orders.yegara-flow', compact('order', 'paymentMethods'));
})->name('orders.yegara-flow');
Route::post('/order-yegara/place', [OrderController::class, 'yegaraPlaceOrder'])->name('orders.yegara-place');

// Packages route
Route::get('/packages', function () {
    return view('packages.index');
})->name('packages.index');

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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Modal Auth endpoints
Route::post('/ajax-register', [AuthController::class, 'ajaxRegister'])->name('ajax.register');
Route::post('/ajax-login', [AuthController::class, 'ajaxLogin'])->name('ajax.login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
});

// Order routes
Route::prefix('order')->name('orders.')->group(function () {
    Route::get('/step-1', [OrderController::class, 'step1'])->name('step1');
    Route::match(['get', 'post'], '/step-2', [OrderController::class, 'step2'])->name('step2');
    Route::match(['get', 'post'], '/step-3', [OrderController::class, 'step3'])->name('step3');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');
    
    Route::get('/{order}/payment', [OrderController::class, 'step4'])->name('step4');
    Route::get('/{order}/confirm', [PaymentVerificationController::class, 'show'])->name('orders.step5');
    Route::post('/{order}/confirm', [PaymentVerificationController::class, 'submit'])->name('orders.submit');
});

Route::get('/success', [PaymentVerificationController::class, 'success'])->name('orders.success');

// Payment status check routes
Route::get('/payment-status', [PaymentVerificationController::class, 'checkStatus'])->name('payment-status.check');
Route::get('/payment-status/{order_id}', [PaymentVerificationController::class, 'showStatus'])->name('payment-status.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('login');
    })->name('login');
    
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.submit');
    
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
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
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
