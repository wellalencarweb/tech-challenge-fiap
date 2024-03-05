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
         * @uses GetClientByCriteriaController
         */
        Route::get('', 'GetClientByCriteriaController');

        /**
         * @uses UpdateClientController
         */
        Route::put('{id}', 'UpdateClientController');

        /**
         * @uses DeleteClientController
         */
        Route::delete('{id}', 'DeleteClientController');
    });

    Route::prefix('products')->namespace('App\Http\Controllers\Product')->group(function () {
        /**
         * @uses CreateProductController
         */
        Route::post('', 'CreateProductController');

        /**
         * @uses GetProductController
         */
        Route::get('{id}', 'GetProductController');

        /**
         * @uses GetProductByCriteriaController
         */
        Route::get('', 'GetProductByCriteriaController');

        /**
         * @uses UpdateProductController
         */
        Route::put('{id}', 'UpdateProductController');

        /**
         * @uses DeleteProductController
         */
        Route::delete('{id}', 'DeleteProductController');
    });

    Route::prefix('orders')->namespace('App\Http\Controllers\Order')->group(function () {
        /**
         * @uses CreateOrderController
         */
        Route::post('', 'CreateOrderController');

        /**
         * @uses GetOrderByCriteriaController
         */
        Route::get('', 'GetOrderByCriteriaController');

    });
});





