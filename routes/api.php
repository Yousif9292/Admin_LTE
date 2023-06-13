<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
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
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/logout', [AuthController::class, 'logoutUser'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
//    categories Routes
    Route::post('/auth/categories', [CategoryController::class, 'index']);
    Route::get('/auth/categories/store', [CategoryController::class, 'store']);
    Route::get('/auth/categories/show/{category}', [CategoryController::class, 'show']);
    Route::get('/auth/categories/update/{category}', [CategoryController::class, 'update']);
    Route::get('/auth/categories/destory/{category}', [CategoryController::class, 'destroy']);

    // products routes
    Route::get('/auth/products', [ProductController::class, 'index']);
    Route::Post('/auth/products/create', [ProductController::class, 'store']);
    Route::get('/auth/products/show/{product}', [ProductController::class, 'show']);
    Route::get('/auth/products/update/{product}', [ProductController::class, 'update']);
    Route::Post('/auth/products/destory/{product}', [ProductController::class, 'destroy']);
});

// Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/auth/categories', [CategoryController::class, 'index']);
// Route::get('/auth/store', [CategoryController::class, 'store']);
// Route::get('/auth/show/{category}', [CategoryController::class, 'show']);
// Route::get('/auth/update/{category}', [CategoryController::class, 'update']);
// Route::get('/auth/destory/{category}', [CategoryController::class, 'destroy']);
