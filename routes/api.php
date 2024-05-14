<?php

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

// 商品一覧取得リクエスト
Route::get('/product', [App\Http\Controllers\ProductController::class, 'searchProducts'])
    ->name('api.product.search');

// 商品情報削除リクエスト
Route::delete('/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])
    ->name('api.product.delete');

// 商品販売リクエスト
Route::post('/product/buy/{id}', [App\Http\Controllers\SaleController::class, 'buy'])
    ->name('api.product.buy');
