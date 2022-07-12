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

// Route::group(['middleware' => ['auth:sanctum']],function() {
// });
