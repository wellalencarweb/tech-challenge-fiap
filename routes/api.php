<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('clients')->namespace('App\Http\Controllers\Client')->group(function () {
        /**
         * @uses CreateClientControllerApi
         */
        Route::post('', 'CreateClientControllerApi');

        /**
         * @uses GetClientControllerApi
         */
        Route::get('{id}', 'GetClientControllerApi');

        /**
         * @uses GetClientByCriteriaControllerApi
         */
        Route::get('', 'GetClientByCriteriaControllerApi');

        /**
         * @uses UpdateClientControllerApi
         */
        Route::put('{id}', 'UpdateClientControllerApi');

        /**
         * @uses DeleteClientControllerApi
         */
        Route::delete('{id}', 'DeleteClientControllerApi');
    });

    Route::prefix('products')->namespace('App\Http\Controllers\Product')->group(function () {
        /**
         * @uses CreateProductControllerApi
         */
        Route::post('', 'CreateProductControllerApi');

        /**
         * @uses GetProductControllerApi
         */
        Route::get('{id}', 'GetProductControllerApi');

        /**
         * @uses GetProductByCriteriaControllerApi
         */
        Route::get('', 'GetProductByCriteriaControllerApi');

        /**
         * @uses UpdateProductControllerApi
         */
        Route::put('{id}', 'UpdateProductControllerApi');

        /**
         * @uses DeleteProductControllerApi
         */
        Route::delete('{id}', 'DeleteProductControllerApi');
    });

    Route::prefix('orders')->namespace('App\Http\Controllers\Order')->group(function () {
        /**
         * @uses CreateOrderControllerApi
         */
        Route::post('', 'CreateOrderControllerApi');

        /**
         * @uses GetOrderByCriteriaControllerApi
         */
        Route::get('', 'GetOrderByCriteriaControllerApi');

    });
});





