<?php

use App\Http\Controllers\Master\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Supplier Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Supplier routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Supplier" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::group(['prefix' => ''], function () {
        Route::resource('supplier', SupplierController::class);
    });
});
