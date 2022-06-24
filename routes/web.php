<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Stock\StockInController;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/master/category.php';
require __DIR__.'/master/supplier.php';
require __DIR__.'/master/distributor.php';
require __DIR__.'/master/unit.php';
require __DIR__.'/master/user.php';
require __DIR__.'/master/item.php';
require __DIR__.'/master/rack.php';

// Route::get('/stock/stockIn/createAuto', [StockInController::class, 'createAuto'])
//     ->name('stockIn.createAuto');
require __DIR__.'/stock/stockIn.php';