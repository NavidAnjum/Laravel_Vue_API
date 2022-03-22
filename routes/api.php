<?php

use App\Http\Controllers\APISettingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/name_of_raw_material',[APISettingController::class,'raw_mat_name']);
Route::get('/pr_number',[APISettingController::class,'pr_number']);


Route::post('/pr_creation',[APISettingController::class,'store']);
Route::post('/name_of_raw_material',[APISettingController::class,'name_of_raw_material']);

