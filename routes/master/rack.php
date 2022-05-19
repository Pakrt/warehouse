<?php

use App\Http\Controllers\Master\RackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rack Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Rack routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Rack" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::group(['prefix' => ''], function () {
        Route::resource('rack', RackController::class);
    });
});
