<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\OptionValueController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;

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
Route::middleware('language')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::get('addresses', [AddressController::class, 'index']);

        Route::apiResource('users', UserController::class);

        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('options', OptionController::class)->except(['update', 'destroy']);

        Route::apiResource('option-values', OptionValueController::class)->except(['update', 'destroy']);

        Route::apiResource('products', ProductController::class);
    });
});
