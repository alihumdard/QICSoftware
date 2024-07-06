<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
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



Route::middleware('check.userAuthCheck')->group(function () {

    // roles management ....
    Route::match(['post', 'get'], '/superAdmins', [UserController::class, 'superAdmins'])->name('superAdmins');
    Route::match(['post', 'get'], '/admins', [UserController::class, 'admins'])->name('admins');
    Route::match(['post', 'get'], '/users', [UserController::class, 'users'])->name('users');
    Route::match(['post', 'get'], '/edit/{id}', [UserController::class, 'user_edit']);
    Route::match(['post', 'get'], '/user_store', [UserController::class, 'user_store']);
    Route::match(['post', 'get'], '/change_status', [UserController::class, 'change_status']);
    Route::get('/get_users/{id}', [UserController::class, 'get_users']);

    // quotations module...
    Route::match(['post', 'get'], '/quotations', [UserController::class, 'quotations'])->name('quotations');
    Route::match(['post', 'get'], '/add_quotation', [UserController::class, 'add_quotation'])->name('add_quotation');
    Route::match(['post', 'get'], '/create_quotation', [UserController::class, 'create_quotation'])->name('create_quotation');
    Route::match(['post', 'get'], '/generate_pdf_quote', [PDFController::class, 'generate_pdf_quote'])->name('generate_pdf_quote');

    // contracts module ...
    Route::match(['post', 'get'], '/contracts', [UserController::class, 'contracts'])->name('contracts');
    Route::match(['post', 'get'], '/add_contract', [UserController::class, 'add_contract'])->name('add_contract');

    // invoices module ...
    Route::match(['post', 'get'], '/invoices', [UserController::class, 'invoices'])->name('invoices');
    Route::match(['post', 'get'], '/add_invoice', [UserController::class, 'add_invoice'])->name('add_invoice');

    //other modules 
    Route::match(['post', 'get'], '/settings', [UserController::class, 'settings'])->name('settings');
    Route::match(['post', 'get'], '/lang_change', [UserController::class, 'lang_change']);
    Route::match(['post', 'get'], '/currencies', [UserController::class, 'currencies'])->name('currencies');
    Route::match(['post', 'get'], '/locations', [UserController::class, 'locations'])->name('locations');
    Route::match(['post', 'get'], '/services', [UserController::class, 'services'])->name('services');
    Route::match(['post', 'get'], '/revenue', [UserController::class, 'revenue'])->name('revenue');
    Route::match(['post', 'get'], '/transactional', [UserController::class, 'transactionals'])->name('transactional');
    Route::match(['post', 'get'], '/demomail', [UserController::class, 'demomail']);
    Route::match(['post', 'get'], '/reSubscription', [UserController::class, 're_subscription'])->name('re-subscription');
});

// basic routes of login and registeration ...
Route::get('/', [UserController::class, 'index'])->name('dashboard');
Route::match(['post', 'get'], '/login', [UserController::class, 'user_login']);
Route::match(['post', 'get'], '/forgot_password', [UserController::class, 'forgot_password']);
Route::match(['post', 'get'], '/set_password', [UserController::class, 'set_password']);
Route::match(['post', 'get'], '/register', [UserController::class, 'user_register']);
Route::match(['post', 'get'], '/logout', [UserController::class, 'logout']);
Route::match(['post', 'get'], '/verify/{hash}', [UserController::class, 'verify'])->name('verify');

Route::get('/pdftemplate', function () {
    $data = [
        [
            'quantity' => 1,
            'description' => '1 Year Subscription',
            'price' => '129.00'
        ]
    ];
    return view('pdf.templates.qoute.first',['data' => $data]);
});
