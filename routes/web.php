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

Route::get('/{org}/lc_buyer',[SettingController::class,'lc_buyer'])->middleware('auth');
Route::get('/{org}/pr_list',function (){
    return view('layout.setting.pr_list');
})->middleware('auth');
Route::get('/{org}/po_list',function (){
    return view('layout.setting.po_list');

})->middleware('auth');

Route::post('/ZSML/api/name_of_lc_buyer',[APISettingController::class,'name_of_lc_buyer']);
Route::post('/ZSML/api/type_of_raw_material',[APISettingController::class,'type_of_raw_material']);
Route::post('/ZSML/api/name_of_material',[APISettingController::class,'name_of_material']);
Route::post('/ZSML/api/name_of_supplier',[APISettingController::class,'name_of_supplier']);
Route::get('/ZSML/barcode/{po_number}', [PdfController::class, 'barcode']);

Route::get('/{org}/pr_creation',function (){
     if (Auth::check()) {
         return view('layout/setting/pr_creation');
     }
});

Route::get('/ZSML/api/pr_creation_update/{id}',[APISettingController::class,'pr_creation_update'])->middleware('auth');
Route::get('/ZSML/api/po_creation_update/{id}',[APISettingController::class,'po_creation_update'])->middleware('auth');

Route::get('/ZSML/api/get_type_of_raw_material',[APISettingController::class,'zsml_type_of_raw_material']);
Route::get('/ZSML/api/pr_numbers_list',[APISettingController::class,'pr_numbers_list']);

Route::get('/ZSML/api/pr_number',[APISettingController::class,'pr_number']);
Route::post('/ZSML/api/pr_creation',[APISettingController::class,'store']);
Route::post('/ZSML/api/pr_number_update',[APISettingController::class,'pr_number_update']);
Route::post('/ZSML/api/po_number_update',[APISettingController::class,'po_number_update']);

Route::post('/ZSML/api/pr_creation_approve',[APISettingController::class,'pr_creation_approve']);
Route::post('/ZSML/api/pr_creation_remove',[APISettingController::class,'pr_creation_remove']);
Route::post('/ZSML/api/po_creation_approve',[APISettingController::class,'po_creation_approve']);
Route::post('/ZSML/api/po_creation_remove',[APISettingController::class,'po_creation_remove']);


Route::get('/ZSML/api/lc_buyer',[APISettingController::class,'zsml_lc_buyer']);

Route::get('/ZSML/api/name_of_mats',[APISettingController::class,'name_of_mats']);

Route::get('/ZSML/api/supplier',[APISettingController::class,'supplier']);
Route::get('/ZSML/api/po_number',[APISettingController::class,'po_number']);
Route::post('/ZSML/api/po_creation',[APISettingController::class,'po_creation']);
Route::post('/ZSML/api/po_creation_update',[APISettingController::class,'po_creation_update']);


Route::get('/ZSML/api/get_po_info/{po_number}',[APISettingController::class,'get_po_info']);

Route::get('/ZSML/api/po_number_list',[APISettingController::class,'po_number_list']);
Route::get('/ZSML/api/po_number_list',[APISettingController::class,'po_number_list']);

Route::post('/ZSML/api/po_receive',[APISettingController::class,'po_receive']);
Route::get('/ZSML/barcode',[SettingController::class,'barcode'])->middleware('auth');
Route::get('/ZSML/pdf/{po_number}', [PdfController::class, 'index'])->middleware('auth');
Route::get('/ZSML/raw_material', [Raw_MaterialController::class, 'export'])->middleware('auth');
Route::get('/ZSML/api/pr_pending_list',[SettingController::class,'pr_pending_list'])->middleware('auth');
Route::get('/ZSML/api/po_pending_list',[SettingController::class,'po_pending_list'])->middleware('auth');
Route::get('/ZSML/api/po_list',[SettingController::class,'po_list'])->middleware('auth');

Route::get('/ZSML/api/po_receive_list',[APISettingController::class,'po_receive_list'])->middleware('auth');

Route::get('/{org}/pr_pending_list',[SettingController::class,'pr_pending_list_view'])->middleware('auth');
Route::get('/{org}/po_pending_list',[SettingController::class,'po_pending_list_view'])->middleware('auth');
Route::get('/ZSML/api/pr_list',[SettingController::class,'pr_list'])->middleware('auth');
Route::post('/ZSML/api/pr_update',[SettingController::class,'pr_update'])->middleware('auth');

//Routes For LC Buyer

//Route::get('/{org}/lc_buyer',[SettingController::class,'lc_buyer'])->middleware('auth');
Route::get('/{org}/lc_buyer_list',[SettingController::class,'lc_buyer_list'])->middleware('auth');
Route::get('/{org}/lc_buyer_update/{lc_buyer_id}',[SettingController::class,'lc_buyer_update'])->middleware('auth');
Route::post('/{org}/update_lc_buyer/{lc_buyer_id}',[SettingController::class,'update_lc_buyer_data_to_database'])->middleware('auth');

//Routes For Types of Raw Material

Route::get('/{org}/type_of_raw_material_list',[SettingController::class,'type_of_raw_material_list'])->middleware('auth');
Route::get('/{org}/type_of_raw_material_update/{type_of_raw_material_id}',[SettingController::class,'type_of_raw_material_update'])->middleware('auth');
Route::post('/{org}/update_type_of_raw_material/{type_of_raw_material_id}',[SettingController::class,'update_type_of_raw_material_data_to_database'])->middleware('auth');

//Routes For Name of Material

Route::get('/{org}/name_of_material_list',[SettingController::class,'name_of_material_list'])->middleware('auth');
Route::get('/{org}/name_of_material_update/{name_of_material_id}',[SettingController::class,'name_of_material_update'])->middleware('auth');
Route::post('/{org}/update_name_of_material/{name_of_material_id}',[SettingController::class,'update_name_of_material_data_to_database'])->middleware('auth');

// Routes For Name of Seller

Route::get('/{org}/seller_list',[SettingController::class,'seller_list'])->middleware('auth');
Route::get('/{org}/seller_update/{seller_id}',[SettingController::class,'seller_update'])->middleware('auth');
Route::post('/{org}/update_seller/{seller_id}',[SettingController::class,'update_seller_data_to_database'])->middleware('auth');


Route::middleware(['ysml'])->group(function (){
    Route::get('/YSML/api/po_receive_list',[APISettingController::class,'po_receive_list_org'])->middleware('auth');

    Route::post('/YSML/api/po_number_update',[APISettingController::class,'po_number_update_org']);

    Route::get('/YSML/api/po_list',[SettingController::class,'po_list_org']);

    Route::get('/YSML/api/pr_list',[SettingController::class,'pr_list_org'])->middleware('auth');

    Route::post('/YSML/api/pr_update',[SettingController::class,'pr_update_org']);

    Route::get('/YSML/api/pr_list',[SettingController::class,'pr_list_org']);
   // Route::post('/YSML/api/pr_creation_update',[APISettingController::class,'pr_number_update_org']);
    Route::get('/YSML/api/pr_creation_update/{id}',[APISettingController::class,'pr_creation_update_org']);
    Route::get('/YSML/api/po_creation_update/{id}',[APISettingController::class,'po_creation_update_org']);

    Route::post('/YSML/api/pr_number_update',[APISettingController::class,'pr_number_update_org']);

    Route::post('/YSML/api/pr_creation_approve',[APISettingController::class,'pr_creation_approve_org']);
    Route::post('/YSML/api/pr_creation_remove',[APISettingController::class,'pr_creation_remove_org']);
    Route::post('/YSML/api/po_creation_approve',[APISettingController::class,'po_creation_approve_org']);
    Route::post('/YSML/api/po_creation_remove',[APISettingController::class,'po_creation_remove_org']);

    Route::get('/YSML/api/pr_pending_list',[SettingController::class,'pr_pending_list_org']);
    Route::get('/YSML/api/po_pending_list',[SettingController::class,'po_pending_list_org']);

    Route::get('/YSML/raw_material', [Raw_MaterialController::class, 'org_export']);

    Route::get('/YSML/pdf/{po_number}', [PdfController::class, 'org_index']);

    Route::get('/YSML/barcode',[SettingController::class,'org_barcode']);

    Route::post('/YSML/api/po_receive',[APISettingController::class,'org_po_receive']);

    Route::get('/YSML/api/po_number_list',[APISettingController::class,'org_po_number_list']);

    Route::get('/YSML/api/get_po_info/{po_number}',[APISettingController::class,'store_get_po_info']);

    Route::post('/YSML/api/po_creation',[APISettingController::class,'org_po_creation']);

    Route::get('/YSML/api/po_number',[APISettingController::class,'org_po_number']);

    Route::get('/YSML/api/supplier',[APISettingController::class,'org_supplier']);

    Route::get('/YSML/api/name_of_mats',[APISettingController::class,'org_name_of_mats']);

    Route::post('/YSML/api/name_of_lc_buyer',[APISettingController::class,'org_name_of_lc_buyer']);
    //type of raw material
    Route::post('/YSML/api/type_of_raw_material',[APISettingController::class,'org_type_of_raw_material']);
    //name of raw material
    Route::post('/YSML/api/name_of_material',[APISettingController::class,'org_name_of_raw_material']);

    Route::post('/YSML/api/name_of_supplier',[APISettingController::class,'org_name_of_supplier']);

    Route::get('/YSML/api/get_type_of_raw_material',[APISettingController::class,'ysml_type_of_raw_material']);
    Route::get('/YSML/api/pr_numbers_list',[APISettingController::class,'ysml_pr_numbers_list']);
    Route::get('/YSML/api/pr_number',[APISettingController::class,'ysml_pr_number']);
    Route::post('/YSML/api/pr_creation',[APISettingController::class,'ysml_store']);
    Route::get('/YSML/api/lc_buyer',[APISettingController::class,'org_lc_buyer']);

});

Route::middleware(['zusml'])->group(function (){

    Route::get('/ZuSML/api/po_receive_list',[APISettingController::class,'po_receive_list_org'])->middleware('auth');

    Route::post('/ZuSML/api/po_number_update',[APISettingController::class,'po_number_update_org']);

    Route::get('/ZuSML/api/po_list',[SettingController::class,'po_list_org']);

    Route::post('/ZuSML/api/pr_update',[SettingController::class,'pr_update_org']);

    Route::get('/ZuSML/api/pr_list',[SettingController::class,'pr_list_org'])->middleware('auth');

    Route::get('/ZuSML/api/pr_list',[SettingController::class,'pr_list_org']);

   // Route::post('/ZuSML/api/pr_creation_update',[APISettingController::class,'pr_number_update_org']);
    Route::post('/ZuSML/api/pr_number_update',[APISettingController::class,'pr_number_update_org']);

    Route::get('/ZuSML/api/pr_creation_update/{id}',[APISettingController::class,'pr_creation_update_org']);
    Route::get('/ZuSML/api/po_creation_update/{id}',[APISettingController::class,'po_creation_update_org']);

    Route::post('/ZuSML/api/pr_creation_approve',[APISettingController::class,'pr_creation_approve_org']);
    Route::post('/ZuSML/api/pr_creation_remove',[APISettingController::class,'pr_creation_remove_org']);
    Route::post('/ZuSML/api/po_creation_approve',[APISettingController::class,'po_creation_approve_org']);
    Route::post('/ZuSML/api/po_creation_remove',[APISettingController::class,'po_creation_remove_org']);

    Route::get('/ZuSML/api/pr_pending_list',[SettingController::class,'pr_pending_list_org']);

    Route::get('/ZuSML/raw_material', [Raw_MaterialController::class, 'org_export']);

    Route::get('/ZuSML/pdf/{po_number}', [PdfController::class, 'org_index']);

    Route::get('/ZuSML/barcode',[SettingController::class,'org_barcode']);

    Route::post('/ZuSML/api/po_receive',[APISettingController::class,'org_po_receive']);

    Route::get('/ZuSML/api/po_number_list',[APISettingController::class,'org_po_number_list']);

    Route::get('/ZuSML/api/get_po_info/{po_number}',[APISettingController::class,'store_get_po_info']);

    Route::post('/ZuSML/api/po_creation',[APISettingController::class,'org_po_creation']);

    Route::get('/ZuSML/api/po_number',[APISettingController::class,'org_po_number']);

    Route::get('/ZuSML/api/supplier',[APISettingController::class,'org_supplier']);

    Route::get('/ZuSML/api/name_of_mats',[APISettingController::class,'org_name_of_mats']);

    Route::get('/ZuSML/api/lc_buyer',[APISettingController::class,'org_lc_buyer']);

    Route::post('/ZuSML/api/name_of_lc_buyer',[APISettingController::class,'org_name_of_lc_buyer']);
    //type of raw material
    Route::post('/ZuSML/api/type_of_raw_material',[APISettingController::class,'org_type_of_raw_material']);
    //name of raw material
    Route::post('/ZuSML/api/name_of_material',[APISettingController::class,'org_name_of_raw_material']);

    Route::post('/ZuSML/api/name_of_supplier',[APISettingController::class,'org_name_of_supplier']);

    Route::get('/ZuSML/api/get_type_of_raw_material',[APISettingController::class,'ysml_type_of_raw_material']);

    Route::get('/ZuSML/api/pr_numbers_list',[APISettingController::class,'ysml_pr_numbers_list']);

    Route::get('/ZuSML/api/pr_number',[APISettingController::class,'ysml_pr_number']);

    Route::post('/ZuSML/api/pr_creation',[APISettingController::class,'ysml_store']);

});

