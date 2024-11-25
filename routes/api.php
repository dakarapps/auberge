<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

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

Route::controller(AjaxController::class)->group(function () {
    Route::post('get-room-num-list', 'getRoomNumList');
    Route::post('get-room-details', 'getRoomDetails');
    Route::post('get-calendar-events', 'getCalendarEvents');
    Route::post('add-to-cart', 'roomAddAndRemoveToCart');
    Route::post('read-notifications', 'readNotifications');
    Route::get('clean-cache', 'cleanCache');
});