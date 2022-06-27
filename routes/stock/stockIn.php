<?php

use App\Http\Controllers\Stock\StockInController;
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
    Route::get('stockIn/createAuto', [StockInController::class, 'createAuto'])
      ->name('stockIn.createAuto');
    Route::post('stockIn/algen', [StockInController::class, 'algen'])
      ->name('stockIn.algen');
    Route::post('stockIn/formManual', [StockInController::class, 'formManual'])
      ->name('stockIn.formManual');
    Route::get('stockIn/chooseRack', [StockInController::class, 'chooseRack'])
      ->name('stockIn.chooseRack');
    
    Route::resource('stockIn', StockInController::class)
    ->except('show');
          
});
