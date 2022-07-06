<?php

use App\Http\Controllers\Stock\StockOutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| StockOut Routes
|--------------------------------------------------------------------------
|
| Here is where you can register StockOut routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "StockOut" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'stock'], function () {
    Route::resource('stockOut', StockOutController::class)
    ->except('show');
    Route::get('stockOut/stockRackCheck', [StockOutController::class, 'stockRackCheck'])
    ->name('stockOut.stockRackCheck');
});
