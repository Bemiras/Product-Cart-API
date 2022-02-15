<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

//Routes for 1 Product catalog API
    //Add a new product
    Route::post('/products', [ProductController::class, 'store']);
    //Update product title and/or price
    Route::put('/products/{id}',[ProductController::class, 'update']);
    //List all of the products
    Route::get('/products', [ProductController::class, 'index']);

//Routes for 2 Cart API
    //Add a product to the cart
    Route::post('cart', [CartController::class, 'store']);
    //List all the products in the cart
    Route::get('cart/{index}', [CartController::class, 'show']);
});
