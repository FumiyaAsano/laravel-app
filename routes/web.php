<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('product.index'));
});

// 商品一覧画面
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])
    ->name('product.index');

// 商品新規登録画面
Route::get('/product/register', [App\Http\Controllers\ProductController::class, 'viewRegister'])
    ->name('product.register');

// 商品新規登録リクエスト
Route::post('/product/register', [App\Http\Controllers\ProductController::class, 'register']);

// 商品情報詳細画面
Route::get('/product/detail/{id}', [App\Http\Controllers\ProductController::class, 'detail'])
    ->name('product.detail');

// 商品情報編集画面
Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'viewEdit'])
    ->name('product.edit');

// 商品情報編集リクエスト
Route::put('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);

// 商品情報削除リクエスト
Route::delete('/product/delete/{id}', [App\Http\Controllers\ProductController::class, 'delete'])
    ->name('product.delete');

// パスワードリセットを無効化
Auth::routes(['reset' => false]);
