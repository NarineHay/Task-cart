<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GetUsersController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api' ]], function () {

    Route::apiResources([
        'users' => GetUsersController::class,
        'product' => ProductController::class,
        'category' => CategoryController::class,

    ]);

    Route::post('add-to-cart', [CartController::class, 'add_to_cart']);
    Route::post('delete-product-from-cart', [CartController::class, 'delete_product_from_cart']);


});

Route::post('login', [LoginController::class, 'login']);


