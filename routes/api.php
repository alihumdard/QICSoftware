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

    // Route::get('/clients', [APIController::class, 'clients']);

    // Route::get('/admin/drivers', [APIController::class, 'drivers']);

    Route::match(['post','get'],'/users', [APIController::class, 'users']);

    Route::match(['post','get'],'/userStore', [APIController::class, 'user_store']);
    
    Route::match(['post','get'],'/tripStore', [APIController::class, 'trip_store']);

    Route::match(['post','get'],'/announcements', [APIController::class, 'announcements']);

    Route::match(['post','get'],'/announcementStore', [APIController::class, 'announcement_store']);

    Route::match(['post','get'],'/notifications', [APIController::class, 'notifications']);

    Route::match(['post','get'],'/notificationStore', [APIController::class, 'notification_store']);
   
    Route::match(['post','get'],'/packages', [APIController::class, 'packages']);

    Route::match(['post','get'],'/packageStore', [APIController::class, 'package_store']);

    Route::match(['post','get'],'/updateTrip_status', [APIController::class, 'update_trip_status']);
    
    Route::match(['post','get'],'/deleteUsers', [APIController::class, 'deleteUsers']);

    Route::match(['post','get'],'/completeWaypoint', [APIController::class, 'complete_waypoint']);
    
    Route::match(['post','get'],'/completeAddress', [APIController::class, 'complete_address']);
    
    Route::match(['post','get'],'/addressesUpdate', [APIController::class, 'update_address_order']);

    Route::match(['post','get'],'/events', [APIController::class, 'events']);
    
    Route::match(['post','get'],'/eventStore', [APIController::class, 'storeEvent']);

    Route::match(['post','get'],'/trip_charts', [APIController::class, 'tripCharts']);

    Route::match(['post','get'],'/tripDetail', [APIController::class, 'tripDetail']);
    
    Route::match(['post','get'],'/quotationStore', [APIController::class, 'quotation_store']);

});

Route::match(['post','get'],'/login', [APIController::class, 'user_login']);

Route::match(['get', 'post'], '/register', [APIController::class, 'register']);
