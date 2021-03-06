<?php

use App\Http\Controllers\Master\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Category routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Category" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::group(['prefix' => ''], function () {
        Route::resource('category', CategoryController::class);
    });
});
