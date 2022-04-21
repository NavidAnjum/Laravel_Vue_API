<?php

use App\Http\Controllers\APISettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Raw_MaterialController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('login');
});

Route::post('/login',[AuthController::class,'login']);
Route::get('/login',function (){

        return view('login');

});
Route::get('dashboard',[AuthController::class,'dashboard']);
Route::get('{id?}/dashboard',[AuthController::class,'dashboard']);



Route::get('/{org}/po_creation',function (){
        return view('layout/setting/po_creation');
})->middleware('auth');

//Route::post('/po_creation',[SettingController::class,'pr_creation']);


Route::get('/{org}/pr_creation',function (){
    if (Auth::check()) {
        return view('layout/setting/pr_creation');
    }
});
//Route::get('pr',function (){
//    $id=\App\Models\PRCreation::get()->where('pr_number','1');
//    if(count($id)===0){
//        return $id;
//    }
//});
//Route::post('/pr_creation',[SettingController::class,'pr_creation'])->middleware('auth');
Route::get('/{org}/po_receive',[SettingController::class,'po_receive_get'])->middleware('auth');
//Route::post('/po_receive',[SettingController::class,'po_receive_store'])->middleware('auth');

Route::get('/{org}/type_of_raw_material',[SettingController::class,'name_of_raw_material'])->middleware('auth');
Route::get('/{org}/name_of_material',[SettingController::class,'name_of_material'])->middleware('auth');
Route::get('/{org}/seller',[SettingController::class,'seller'])->middleware('auth');


Route::get('{org}/barcode',[SettingController::class,'barcode'])->middleware('auth');

Route::get('{org}/pdf/{po_number}', [PdfController::class, 'index'])->middleware('auth');
Route::get('/barcode/{po_number}', [PdfController::class, 'barcode'])->middleware('auth');

Route::get('/{org}/raw_material', [Raw_MaterialController::class, 'export'])->middleware('auth');
Route::get('raw_material_report', [Raw_MaterialController::class, 'index'])->middleware('auth');






//Route::get('/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {
//
//    $fpdf->AddPage();
//    $fpdf->SetFont('Courier', 'B', 18);
//    $fpdf->Cell(50, 25, 'Hello World!');
//    $fpdf->Output();
//    exit;
//
//});
Route::get('{id?}/logout',[AuthController::class,'logout'])->middleware('auth');
Route::get('/logout',[AuthController::class,'logout'])->middleware('auth');

//api

Route::get('/{org}/api/pr_numbers_list',[APISettingController::class,'pr_numbers_list']);

Route::get('/{org}/api/name_of_raw_material',[APISettingController::class,'raw_mat_name']);
Route::get('/{org}/api/pr_number',[APISettingController::class,'pr_number']);
Route::get('/{org}/api/po_number',[APISettingController::class,'po_number']);

Route::get('/{org}/api/supplier',[APISettingController::class,'supplier']);
Route::get('/{org}/api/name_of_mats',[APISettingController::class,'name_of_mats']);


Route::get('/{org}/api/po_number_list',[APISettingController::class,'po_number_list']);
Route::post('/{org}/api/pr_creation',[APISettingController::class,'store']);
Route::post('/{org}/api/po_creation',[APISettingController::class,'po_creation']);
Route::post('/{org}/api/po_receive',[APISettingController::class,'po_receive']);

Route::get('/{org}/lc_buyer',[SettingController::class,'lc_buyer'])->middleware('auth');
Route::post('/ZSML/api/name_of_lc_buyer',[APISettingController::class,'name_of_lc_buyer']);
Route::post('/ZSML/api/type_of_raw_material',[APISettingController::class,'type_of_raw_material']);
Route::post('/ZSML/api/name_of_material',[APISettingController::class,'name_of_material']);
Route::post('/ZSML/api/name_of_supplier',[APISettingController::class,'name_of_supplier']);


Route::middleware(['ysml'])->group(function (){
    Route::post('/YSML/api/name_of_lc_buyer',[APISettingController::class,'org_name_of_lc_buyer']);
    //type of raw material
    Route::post('/YSML/api/type_of_raw_material',[APISettingController::class,'org_type_of_raw_material']);
    //name of raw material
    Route::post('/YSML/api/name_of_material',[APISettingController::class,'org_name_of_raw_material']);

    Route::post('/YSML/api/name_of_supplier',[APISettingController::class,'org_name_of_supplier']);

});

Route::middleware(['zusml'])->group(function (){
    Route::post('/ZuSML/api/name_of_lc_buyer',[APISettingController::class,'org_name_of_lc_buyer']);
    //type of raw material
    Route::post('/ZuSML/api/type_of_raw_material',[APISettingController::class,'org_type_of_raw_material']);
    //name of raw material
    Route::post('/ZuSML/api/name_of_material',[APISettingController::class,'org_name_of_raw_material']);

    Route::post('/ZuSML/api/name_of_supplier',[APISettingController::class,'org_name_of_supplier']);

});

