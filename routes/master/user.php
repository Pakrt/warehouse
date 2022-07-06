<?php

use App\Http\Controllers\Master\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "User" middleware group. Now create something great!
|
*/
Route::get('/change-password', [UserController::class, 'changePassword'])
    ->name('users.changePassword');
Route::group(['prefix' => 'master'], function () {
    Route::resource('user', UserController::class);
});
