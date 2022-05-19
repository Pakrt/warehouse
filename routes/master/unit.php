<?php

use App\Http\Controllers\Master\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Unit Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Unit routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Unit" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::group(['prefix' => ''], function () {
        Route::resource('unit', UnitController::class);
    });
});
