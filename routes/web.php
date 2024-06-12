<?php

use App\Http\Controllers\MasterData\CustomerController;
use App\Http\Controllers\OptyController;
use App\Http\Controllers\Reimbursement\PersonelTeamController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // customers
    Route::resource('master-data/customers', CustomerController::class)->except('create');

     // Reimbursement
    Route::resource('reimbursement/personal-teams', PersonelTeamController::class)->except('create');

    // opty
    Route::resource('opty', OptyController::class);
});
