<?php

use App\Http\Controllers\Stock\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| StockIn Routes
|--------------------------------------------------------------------------
|
| Here is where you can register StockIn routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "StockIn" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'stock'], function () {
    Route::resource('stock', StockController::class)
    ->except('show');
          
});
