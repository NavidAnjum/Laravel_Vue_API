<?php

use App\Http\Controllers\AuthController;
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
    if (Auth::check()) {
        return redirect('pr_creation');
    }
    else
    {
        return view('login');
    }
});

Route::get('/setting',function (){
        return view('layout/setting/pr_creation');
})->middleware('auth');

Route::get('/po_creation',function (){
        return view('layout/setting/po_creation');
})->middleware('auth');

Route::post('/po_creation',[SettingController::class,'pr_creation']);

Route::get('/pr_creation',function (){
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
Route::post('/pr_creation',[SettingController::class,'pr_creation']);
Route::get('/po_receive',[SettingController::class,'po_receive_get']);
Route::post('/po_receive',[SettingController::class,'po_receive_store']);
Route::get('name_of_raw_material',[SettingController::class,'name_of_raw_material']);
