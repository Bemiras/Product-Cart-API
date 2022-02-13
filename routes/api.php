<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for 1 Product catalog API
//Add a new product
Route::post('/products', [ProductController::class, 'store']);
//Update product title and/or price
Route::put('/products/{index}',[ProductController::class, 'update']);
//List all of the products
Route::get('/products', [ProductController::class, 'index']);


/*
Route::get('/products', [ProductController::class, 'index']) ->name('show.products');

Route::get('/products/{id}', [ProductController::class, 'show']) ->name('show.product');
/*;
