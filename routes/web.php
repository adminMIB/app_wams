<?php

use App\Http\Controllers\Auth\RoleAndPremission\RoleController;
use App\Http\Controllers\MasterData\CustomerController;
use App\Http\Controllers\OptyController;
use App\Http\Controllers\MasterData\PersonelTeamController;
use App\Http\Controllers\MasterData\PrincipalController;
use App\Http\Controllers\Reimbursement\ReimbursementController;
use App\Http\Controllers\Reimbursement\TransactionMakerReimbursementController;
use App\Http\Controllers\OptyMakerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMakerController;
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

    // masterData
    // customers
    Route::resource('master-data/customers', CustomerController::class)->except('create');

    // personelTeams
    Route::resource('master-data/personel-teams', PersonelTeamController::class)->except('create');

    // Principal
    Route::resource('master-data/principals', PrincipalController::class)->except('create');

    // opty
    Route::resource('opty', OptyController::class);
    Route::post('move-optyTo-project/{opty_id}', [OptyController::class, 'move_to_project']);


    // opty maker
    Route::get('opty-maker/{id}', [OptyMakerController::class, 'edit'])->name('opty-maker.edit');
    Route::post('opty-maker/{id}/update', [OptyMakerController::class, 'update'])->name('opty-maker.update');
    Route::post('opty-maker/{opty_id}', [OptyMakerController::class, 'store'])->name('opty-maker.store');

    // project
    Route::resource('project', ProjectController::class)->except(['create', 'store', 'destroy']);
    Route::post('project/check-projectID', [ProjectController::class, 'check_id_project']);
    Route::get('incomplete-projects', [ProjectController::class, 'data_incomplete']);

    // project maker
    Route::resource('project-maker', ProjectMakerController::class)->except(['index', 'show']);
    Route::post('project-maker/move', [ProjectMakerController::class, 'moveTransaction']);

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
