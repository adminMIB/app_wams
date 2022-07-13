<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post( '/register',[\App\Http\Controllers\API\AuthController::class,'register']);
Route::post( '/login',[\App\Http\Controllers\API\AuthController::class,'login']);

// route user login /show data login
Route::get('/user',[\App\Http\Controllers\API\AuthController::class, 'index']);



// rooute roles
Route::apiResource('roles','\App\Http\Controllers\API\RoleController', [
    "only" => ["store","update","index","edit","destroy"]
]);

Route::post( '/logout',[\App\Http\Controllers\API\AuthController::class,'logout']);

//Technical
Route::apiResource('reports','\App\Http\Controllers\API\ReportController', [
    "only" => ["store","index","edit","update","destroy"]
]);

Route::apiResource('createweeklies','\App\Http\Controllers\API\CreateWeekliesController', [
    "only" => ["store","index","edit","update","destroy"]
]);

Route::apiResource('elearning','App\Http\Controllers\API\ElearningController', [
    "only" => ["store","index","edit","destroy"]
   ]);
   Route::post('elearning/{id}',[ElearningController::class,'update'])->name('elearnings.update');      

   // route project timeline
Route::apiResource('ProjectTimeline','\App\Http\Controllers\API\ProjectTimelineController',[
    "only" => ["index", "store", "edit", "update", "destroy"]    
]);
   
// route upload dokumen

Route::apiResource('upload','\App\Http\Controllers\API\UploadController',[
    "only" => ["index", "store","destroy"]    
]);
// route salesorder 
route::apiResource('salesorder', '\App\Http\Controllers\API\SalesOrderController', [
    "only" => ["store", "index"]
]);

// route up dok

route::apiResource('updoc', '\App\Http\Controllers\API\UploadDocumentController', [
    "only" => ["store", "index"]
]);

// route salesopty
Route::apiResource('salesopty','\App\Http\Controllers\API\SalesOptyController', [
    "only" => ["store", "update", "index", "edit", "destroy"]
]);

// route relasi timeline
Route::apiResource('timeline','\App\Http\Controllers\API\TimelineController', [
    "only" => ["store", "index"]
]);

// Route::group(['middleware' => ['auth:sanctum']],function() {
// });
