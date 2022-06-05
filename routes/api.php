<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Country\CountryController;
use App\Http\Controllers\Api\Order\OrderController;

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

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::resource('cart', CartController::class, ['parameters' => ['cart' => 'variation']]);
    Route::get('empty-cart', [CartController::class, 'empty']);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('countries', CountryController::class)->only('index');
});
