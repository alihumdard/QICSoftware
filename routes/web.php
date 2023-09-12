<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserAuthCheck;
use App\Http\Middleware\CheckSubscription;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('check.userAuthCheck','check.subscription')->group(function () {

Route::match(['post','get'],'/client', [UserController::class, 'clients']);
Route::match(['post','get'],'/drivers', [UserController::class, 'drivers']);

Route::match(['post','get'],'/quotations', [UserController::class, 'quotations'])->name('quotations');
Route::match(['post','get'],'/contracts', [UserController::class, 'contracts'])->name('contracts');
Route::match(['post','get'],'/invoices', [UserController::class, 'invoices'])->name('invoices');
Route::match(['post','get'],'/add_quotation', [UserController::class, 'add_quotation'])->name('add_quotation');
Route::match(['post','get'],'/add_contract', [UserController::class, 'add_contract'])->name('add_contract');
Route::match(['post','get'],'/add_invoice', [UserController::class, 'add_invoice'])->name('add_invoice');

Route::match(['post','get'],'/calender', [UserController::class, 'calender']);
Route::match(['post','get'],'/calendar_maintable', [UserController::class, 'calendar_maintable']);
Route::match(['post','get'],'/users', [UserController::class, 'users']);
Route::match(['post','get'],'/announcements', [UserController::class, 'announcements']);
Route::match(['post','get'],'/packages', [UserController::class, 'packages']);
Route::match(['post','get'],'/notifications', [UserController::class, 'notifications']);
Route::match(['post','get'],'/settings', [UserController::class, 'settings']);
Route::match(['post','get'],'/edit/{id}', [UserController::class, 'user_edit']);
Route::match(['post','get'],'/user_store', [UserController::class, 'user_store']);
Route::match(['post','get'],'/lang_change', [UserController::class, 'lang_change']);



Route::match(['post','get'],'/driver_map', [UserController::class, 'driver_map']);
Route::match(['post','get'],'/announcements_alerts', [UserController::class, 'announcements_alerts']);
Route::match(['post','get'],'/pdf_templates', [UserController::class, 'pdf_templates']);
Route::match(['post','get'],'/change_status', [UserController::class, 'change_status']);
Route::get('/get_drivers/{id}', [UserController::class, 'get_drivers']);

})->withoutMiddleware([CheckSubscription::class])->group(function () {
    Route::match(['post','get'],'/subscription', [UserController::class, 'subscription']);
    Route::match(['post','get'],'/payment_success', [UserController::class, 'payment_success']);
    Route::match(['post','get'],'/payment_cancel', [UserController::class, 'payment_cancel']);

});

    Route::get('/', [UserController::class, 'index']);
    Route::match(['post','get'],'/login', [UserController::class, 'user_login']);
    Route::match(['post','get'],'/forgot_password', [UserController::class, 'forgot_password']);
    Route::match(['post','get'],'/set_password', [UserController::class, 'set_password']);
    Route::match(['post','get'],'/register', [UserController::class, 'user_register']);
    Route::match(['post','get'],'/logout', [UserController::class, 'logout']);
    Route::match(['post','get'],'/home', [UserController::class, 'home']);
    Route::match(['post', 'get'], '/verify/{hash}', [UserController::class, 'verify'])->name('verify');
    Route::match(['post','get'],'/paypal/pay', [UserController::class, 'pay'])->name('paypal.pay');;

    Route::get('/subscription-expired', function () {
        return view('subscription_expired');
    });

    Route::get('/subscription-expired_driver', function () {
        return view('sub_expired_driver');
    });

// Route::match(['get', 'post'],'/', 'index');

// Route::get('/client', 'clients')->middleware(CheckSubscription::class);

// Route::get('/drivers', 'drivers')->middleware(CheckSubscription::class);

// Route::get('/routes', 'routes');

// Route::get('/calender', 'calender');

// Route::get('/calendar_maintable', 'calendar_maintable');

// Route::get('/users', 'users');

// Route::match(['get', 'post'],'/announcements', 'announcements');

// Route::get('/notifications', 'notifications');

// Route::get('/settings', 'settings');

// Route::get('/edit/{id}', 'user_edit');

// Route::post('/user_store', 'user_store');
// Route::post('/lang_change', 'lang_change');

// Route::post('/login', 'user_login');

// Route::match(['get', 'post'], '/forgot_password', 'forgot_password');

// Route::match(['get', 'post'], '/set_password', 'set_password');

// Route::match(['get', 'post'], '/register', 'user_register');

// Route::match(['get', 'post'], '/logout', 'logout');

// Route::match(['get', 'post'], '/create_trip', 'create_trip');

// Route::match(['get', 'post'], '/driver_map', 'driver_map');

// Route::match(['get', 'post'], '/announcements_alerts', 'announcements_alerts');

// Route::match(['get', 'post'], '/pdf_templates', 'pdf_templates');

// Route::match(['get', 'post'], '/change_status', 'change_status');

// Route::match(['get', 'post'], '/home', 'home');

// Route::match(['get', 'post'], '/subscription', 'subscription');

// Route::match(['get', 'post'], '/paypal/pay', 'pay')->name('paypal.pay');

// Route::match(['get', 'post'], '/payment_success',  'payment_success');

// Route::match(['get', 'post'], '/payment_cancel', 'payment_cancel');