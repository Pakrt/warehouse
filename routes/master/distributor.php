<?php

use App\Http\Controllers\Master\DistributorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Distributor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Distributor routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Distributor" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'master'], function () {
    Route::group(['prefix' => ''], function () {
        Route::resource('distributor', DistributorController::class);

        // Route::get('distributor/delete/{id}',
        //   [DistributorController::class, 'destroy'])
        //   ->name('distributor.delete'); 
    });
});
