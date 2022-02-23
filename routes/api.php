<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\QueController;

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
// Part one
Route::post('/one', [QueController::class, 'one']);
Route::get('/two', [QueController::class, 'two']);
Route::post('/three', [QueController::class, 'three']);
Route::post('/four', [QueController::class, 'four']);
Route::get('/five', [QueController::class, 'five']);


// Part Two
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);   
});
Route::middleware('user')->group(function () {

	Route::post('/make_order', [OrderController::class, 'make_order']);
	Route::get('/my_orders', [OrderController::class, 'my_orders']);
	
});
