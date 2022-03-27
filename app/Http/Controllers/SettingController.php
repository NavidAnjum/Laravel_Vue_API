<?php

namespace App\Http\Controllers;

use App\Models\PRCreation;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function lc_buyer(){
        return view('layout.setting.lc_buyer');
    }

    public function name_of_raw_material(){
        return view('layout.setting.name_of_raw_material');

    }
    public function name_of_material(){
        return view('layout.setting.name_of_material');

    }


    public function seller(){
        return view('layout.setting.seller');

    }

    public function pr_creation(Request $request){
        $prcreation=new PRCreation();
        $prcreation->date=$request->date;
        $prcreation->pr_number=$request->pr_number;
        $prcreation->name_of_raw_matrial=$request->name_of_raw_matrial;
        $prcreation->quantity=$request->quantity;
        $prcreation->quality=$request->quality;
        $prcreation->remarks=$request->remarks;
        $prcreation->save();
        $success='Data Successfully Saved';
        return view('layout/setting/pr_creation')->with([ 'success' => $success ]);
    }

    public function po_creation(Request $request){
        $prcreation=new PRCreation();
        $prcreation->date=$request->date;
        $prcreation->pr_number=$request->pr_number;
        $prcreation->serial_number=$request->serial_number;
        $prcreation->type_of_raw_matrial=$request->type_of_raw_matrial;
        $prcreation->quantity=$request->quantity;
        $prcreation->quality=$request->quality;
        $prcreation->remarks=$request->remarks;
        $prcreation->save();
        $success='Data Successfully Saved';
        return view('layout/setting/pr_creation')->with([ 'success' => $success ]);
    }

    public function po_receive_get(){
        return view('layout.setting.po_receive');
    }
}
