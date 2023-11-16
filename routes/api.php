<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::match(['post','get'],'/users', [APIController::class, 'users']);

    Route::match(['post','get'],'/userStore', [APIController::class, 'user_store']);
        
    Route::match(['post','get'],'/deleteUsers', [APIController::class, 'deleteUsers']);
    
    Route::match(['post','get'],'/quotationStore', [APIController::class, 'quotation_store']);

    Route::match(['post','get'],'/invoiceStore', [APIController::class, 'invoice_store']);
    
    Route::match(['post','get'],'/contractStore', [APIController::class, 'contract_store']);
    
    Route::match(['post','get'],'/qouteStatus', [APIController::class, 'update_qoute_status']);
    
    Route::match(['post','get'],'/contractStatus', [APIController::class, 'update_contract_status']);

    Route::match(['post','get'],'/invoiceStatus', [APIController::class, 'update_invoice_status']);

    Route::match(['post','get'],'/quoteDetail', [APIController::class, 'quote_detail']);
   
    Route::match(['post','get'],'/invoiceDetail', [APIController::class, 'invoice_detail']);

    Route::match(['post','get'],'/contractDetail', [APIController::class, 'contract_detail']);

    Route::match(['post','get'],'/dashboardCharts', [APIController::class, 'dashboardCharts']);

    Route::match(['post','get'],'/templateStore', [APIController::class, 'template_store']);
      
    Route::match(['post','get'],'/comments', [APIController::class, 'comments']); 

    Route::match(['post','get'],'/commentStore', [APIController::class, 'comment_store']);  
    
    Route::match(['post','get'],'/sendMail', [APIController::class, 'sendMail_invoice']);  

    Route::match(['post','get'],'/transectionStore', [APIController::class, 'transectional_store']);  

});

Route::match(['post','get'],'/login', [APIController::class, 'user_login']);

Route::match(['get', 'post'], '/register', [APIController::class, 'register']);
