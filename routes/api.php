<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('refresh', [AuthController::class, "refresh"]);
    Route::post('me', [AuthController::class, "me"]);
});

Route::group(['middleware' => 'auth:api'], function ($router) {

    Route::apiResource('/categories', CategoryController::class)->except(['create', 'edit']);
    Route::apiResource('/products', ProductController::class)->except(['create', 'edit']);
    Route::apiResource('/payments', PaymentController::class)->except(['create', 'edit']);
    Route::apiResource('/orders', OrderController::class)->except(['create', 'edit']);
});
