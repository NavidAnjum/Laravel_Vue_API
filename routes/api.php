<?php

use App\Http\Controllers\APISettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/pr_numbers_list',[APISettingController::class,'pr_numbers_list']);

Route::get('/name_of_raw_material',[APISettingController::class,'raw_mat_name']);
Route::get('/pr_number',[APISettingController::class,'pr_number']);
Route::get('/po_number',[APISettingController::class,'po_number']);

Route::get('/lc_buyer',[APISettingController::class,'lc_buyer']);
Route::get('/supplier',[APISettingController::class,'supplier']);
Route::get('/name_of_mats',[APISettingController::class,'name_of_mats']);



Route::get('/po_number_list',[APISettingController::class,'po_number_list']);
Route::post('/pr_creation',[APISettingController::class,'store']);
Route::post('/po_creation',[APISettingController::class,'po_creation']);
Route::post('/po_receive',[APISettingController::class,'po_receive']);
Route::post('/name_of_raw_material',[APISettingController::class,'name_of_raw_material']);
Route::post('/name_of_material',[APISettingController::class,'name_of_material']);


Route::post('/name_of_lc_buyer',[APISettingController::class,'name_of_lc_buyer']);

Route::post('/name_of_supplier',[APISettingController::class,'name_of_supplier']);

