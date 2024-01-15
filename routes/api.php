<?php

use App\Http\Controllers\Admin\Api\AuthController;
use App\Http\Controllers\Admin\Api\Category\CategoryController;
use App\Http\Controllers\Admin\Api\Product\ProductController;
use App\Http\Controllers\Admin\Api\Product\ProductTagController;
use App\Http\Controllers\Admin\Api\Tag\TagController;
use App\Http\Controllers\Admin\Api\User\UserController;
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

Route::post('login', [AuthController::class, 'login']);


Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/user', [UserController::class, 'user']);
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('all-products', 'index');
        Route::get('show/{id}', 'show');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('all-categories', 'index');
        Route::get('show/{id}', 'show');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });
    Route::prefix('tags')->controller(TagController::class)->group(function () {
        Route::get('all-tags', 'index');
        Route::get('show/{id}', 'show');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });
    Route::prefix('product-tag')->controller(ProductTagController::class)->group(function () {
        Route::get('all', 'index');
        Route::get('show/{id}', 'show');
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });
});
