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

Route::apiResource('pms','\App\Http\Controllers\API\PmController', [
    "only" => ["store","update","index","edit","destroy"]
]);
Route::apiResource('project_timelines','\App\Http\Controllers\API\ProjectTimeLineController', [
    "only" => ["store","update","index","edit","destroy"]
]);
Route::apiResource('view_weekly_reports','\App\Http\Controllers\API\ViewWeeklyReportController', [
    "only" => ["store","update","index","edit","destroy"]
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
