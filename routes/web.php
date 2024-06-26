<?php

use App\Http\Controllers\Auth\RoleAndPremission\RoleController;
use App\Http\Controllers\MasterData\CustomerController;
use App\Http\Controllers\OptyController;
use App\Http\Controllers\MasterData\PersonelTeamController;
use App\Http\Controllers\Reimbursement\ReimbursementController;
use App\Http\Controllers\Reimbursement\TransactionMakerReimbursementController;

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
     // personelTeams
    Route::resource('master-data/personel-teams', PersonelTeamController::class)->except('create');

    // opty
    Route::resource('opty', OptyController::class);

    // reimbursement
    Route::resource('reimbursement', ReimbursementController::class);
        // maker
        Route::get('reimbursement/{id}/details', [TransactionMakerReimbursementController::class, 'showDetails'])->name('reimbursement.details');
        Route::post('/reimbursement-maker-move-transaction/{id}/update', [TransactionMakerReimbursementController::class, 'moveTransactionMakerReimbursmenet'])
    ->name('reimbursement-maker-move-transaction.update');
        Route::resource('reimbursement-maker', TransactionMakerReimbursementController::class);

        Route::get('/export-project-internal/{id}', [ReimbursementController::class, 'export'])->name('export-project-internal');



    // role
    Route::resource('roles', RoleController::class);

});
