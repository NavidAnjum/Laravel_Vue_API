<?php

namespace App\Http\Controllers;

use App\Models\POCreation;
use App\Models\POCreation_Pending;
use App\Models\PRCreation;
use App\Models\PRCreation_pending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Database\DVar;

class SettingController extends Controller
{
    public function pr_pending_list(){
        return PRCreation_pending::all()->where('approval','=',0);
    }

    public function po_pending_list(){
        return POCreation_Pending::all()->where('approval','=',0);
    }
    public function pr_pending_list_view(){
        return view('layout.setting.pr_pending_list');
    }
    public function po_pending_list_view(){
        return view('layout.setting.po_pending_list');
    }

    public function lc_buyer(){
        return view('layout.setting.lc_buyer');
    }
    public function barcode(){
        $ponumbers=POCreation::all()->pluck('po_number');
        return view('layout.setting.barcode')->with(['ponumbers'=>$ponumbers]);
    }
    public function org_barcode(){
        $db=DB::connection('mysql2')->select("Select po_number from p_o_creations");
        $r=[];
        for ($i=0;$i<count($db);$i++){
            $r[$i]=$db[$i]->po_number;
        }
        return view('layout.setting.barcode')->with(['ponumbers'=>$r]);

    }
    public function pr_pending_list_org(){
        return $pr_list=DB::connection('mysql2')->select('Select * from p_r_creation_pendings where approval=0');

    }
    public function po_pending_list_org(){
        return $pr_list=DB::connection('mysql2')->select('Select * from p_o_creation__pendings where approval=0');

    }


    public function name_of_raw_material(){
        return view('layout.setting.type_of_raw_material');

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
