<?php

namespace App\Http\Controllers;

use App\Models\Name_of_lc_buyer;
use App\Models\Name_of_Material;
use App\Models\Name_of_Raw_Material;
use App\Models\po_receive;
use App\Models\POCreation;
use App\Models\POCreation_Pending;
use App\Models\PRCreation;
use App\Models\PRCreation_pending;
use App\Models\Supplier_seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;
use PhpOffice\PhpSpreadsheet\Calculation\Database\DVar;

class SettingController extends Controller
{
    public function lc_buyer_list($org)
    {
        $lc_buyer_list = '';
        if ($org == 'ZSML') {
            $lc_buyer_list = Name_of_lc_buyer::all();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }
            $lc_buyer_list = DB::connection('mysql2')->select('Select * from name_of_lc_buyers');
        }
        return view('layout.setting.lc_buyer_list')->with(['lc_buyer_list' => $lc_buyer_list, 'org' => $org]);
    }

    public function lc_buyer_update($org, $lc_buyer_id)
    {
        $lc_buyer_details = '';
        if ($org == 'ZSML') {
            $lc_buyer_details = Name_of_lc_buyer::where('id', '=', $lc_buyer_id)->get();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }
            $lc_buyer_details = DB::connection('mysql2')
                ->select("select * from name_of_lc_buyers where id='$lc_buyer_id'");
        }

        return view('layout.setting.lc_buyer_update')->with(
            ['lc_buyer_update' => $lc_buyer_details, 'org' => $org]
        );
    }

    public function update_lc_buyer_data_to_database(Request $request, $org, $lc_buyer_id)
    {
        if ($org == 'ZSML') {
            $lc_buyer = Name_of_lc_buyer::find($lc_buyer_id);
            $lc_buyer->name_of_lc_buyer = $request->input('name_of_lc_buyer');
            $lc_buyer->update();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $lc_buyer_details = DB::connection('mysql2')
                ->table('name_of_lc_buyers')
                ->where('id', $lc_buyer_id)
                ->update(['name_of_lc_buyer' => $request->input('name_of_lc_buyer')]);
            ;
        }

        return redirect('/' . $org . '/lc_buyer_list')->with(['message' => 'Data update successfully']);
    }

    //Functions For Type of Raw Materials


    public function type_of_raw_material_list($org)
    {

        $type_of_raw_material_list = '';
        if ($org == 'ZSML') {
            $type_of_raw_material_list = Name_of_Raw_Material::all();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }
            $type_of_raw_material_list = DB::connection('mysql2')->select('Select * from type_of__raw__materials');
        }
        return view('layout.setting.type_of_raw_material_list')->with(['type_of_raw_material_list' => $type_of_raw_material_list, 'org' => $org]);
    }

    public function type_of_raw_material_update($org, $type_of_raw_material_id)
    {
        $type_of_raw_material_details = '';
        if ($org == 'ZSML') {
            $type_of_raw_material_details = Name_of_Raw_Material::where('id', '=', $type_of_raw_material_id)->get();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $type_of_raw_material_details = DB::connection('mysql2')
                ->select("select * from type_of__raw__materials where id='$type_of_raw_material_id'");
        }

        return view('layout.setting.type_of_raw_material_update')->with(['type_of_raw_material_update' => $type_of_raw_material_details, 'org' => $org]);
    }

    public function update_type_of_raw_material_data_to_database(Request $request, $org, $type_of_raw_material_id)
    {
        if ($org == 'ZSML') {
            $type_of_raw_material = Name_of_Raw_Material::find($type_of_raw_material_id);
            $type_of_raw_material->type_of_raw_material = $request->input('name_type_of_raw_material');
            $type_of_raw_material->update();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $type_of_raw_material_update = DB::connection('mysql2')
                ->table('type_of__raw__materials')
                ->where('id', $type_of_raw_material_id)
                ->update(['type_of_raw_material' => $request->input('name_type_of_raw_material')]);
            ;
        }

        return redirect('/' . $org . '/type_of_raw_material_list')->with(['message' => 'Data update successfully']);
    }

    //Functions for name of material


    public function name_of_material_list($org)
    {

        $name_of_material_list = '';

        if ($org == 'ZSML') {
            $name_of_material_list = Name_of_Material::all();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }
            $name_of_material_list = DB::connection('mysql2')->select('Select * from name_of__materials');
        }

        return view('layout.setting.name_of_material_list')->with(['name_of_material_list' => $name_of_material_list, 'org' => $org]);
    }

    public function name_of_material_update($org, $name_of_material_id)
    {
        $name_of_material_details = '';
        if ($org == 'ZSML') {
            $name_of_material_details = Name_of_Material::where('id', '=', $name_of_material_id)->get();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $name_of_material_details = DB::connection('mysql2')
                ->select("select * from name_of__materials where id='$name_of_material_id'");
        }

        return view('layout.setting.name_of_material_update')->with(['name_of_material_update' => $name_of_material_details, 'org' => $org]);
    }

    public function update_name_of_material_data_to_database(Request $request, $org, $name_of_material_id)
    {
        if ($org == 'ZSML') {
            $name_of_material = Name_of_Material::find($name_of_material_id);
            $name_of_material->name_of_material = $request->input('name_of_material');
            $name_of_material->update();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $name_of_material_list_update = DB::connection('mysql2')
                ->table('name_of__materials')
                ->where('id', $name_of_material_id)
                ->update(['name_of_material' => $request->input('name_of_material')]);
            ;
        }

        return redirect('/' . $org . '/name_of_material_list')->with(['message' => 'Data update successfully']);
    }


    //Functions for name of material


    public function seller_list($org)
    {

        $seller_list = '';

        if ($org == 'ZSML') {
            $seller_list = Supplier_seller::all();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }
            $seller_list = DB::connection('mysql2')->select('Select * from supplier_sellers');
        }

        return view('layout.setting.seller_list')->with(['seller_list' => $seller_list, 'org' => $org]);
    }

    public function seller_update($org, $seller_id)
    {
        $seller_details = '';
        if ($org == 'ZSML') {
            $seller_details = Supplier_seller::where('id', '=', $seller_id)->get();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $seller_details = DB::connection('mysql2')
                ->select("select * from supplier_sellers where id='$seller_id'");
        }

        return view('layout.setting.seller_update')->with(['seller' => $seller_details, 'org' => $org]);
    }

    public function update_seller_data_to_database(Request $request, $org, $seller_id)
    {
        if ($org == 'ZSML') {
            $seller = Supplier_seller::find($seller_id);
            $seller->supplier = $request->input('seller');
            $seller->update();
        } else {
            if (Auth::check()) {
                $dbName = $org;
                Config::set('database.connections.mysql2.database', $dbName);//new database name, you want to connect to.
            } else {
                abort(404);
            }

            $seller_list_update = DB::connection('mysql2')
                ->table('supplier_sellers')
                ->where('id', $seller_id)
                ->update(['supplier' => $request->input('seller')]);
            ;
        }

        return redirect('/' . $org . '/seller_list')->with(['message' => 'Data update successfully']);
    }


    public function pr_pending_list()
    {
        return PRCreation_pending::all()->where('approval', '=', 0);
    }

    public function po_pending_list()
    {
        return POCreation_Pending::all()->where('approval', '=', 0);
    }
    public function po_list()
    {
        return POCreation::all();
    }

    public function po_list_org()
    {
        return DB::connection('mysql2')->select("Select * from p_o_creations");
    }

    public function pr_pending_list_view()
    {
        return view('layout.setting.pr_pending_list');
    }
    public function po_pending_list_view()
    {
        return view('layout.setting.po_pending_list');
    }

    public function lc_buyer()
    {
        return view('layout.setting.lc_buyer');
    }
    public function barcode()
    {
        $ponumbers = po_receive::all()->pluck('po_number');
        return view('layout.setting.barcode')->with(['ponumbers' => $ponumbers]);
    }
    public function pr_list()
    {
        return PRCreation::all();
    }
    public function pr_list_org()
    {
        return DB::connection('mysql2')->select("Select * from p_r_creations");
    }

    public function pr_update(Request $request)
    {
        $id = $request->id;
        return response()->json([
            'name' => $id]);
    }

    public function pr_update_org(Request $request)
    {
        $id = $request->id;
        return response()->json([
            'name' => $id]);
    }

    public function org_barcode()
    {
        $db = DB::connection('mysql2')->select("Select po_number from p_o_creations");
        $r = [];
        for ($i = 0; $i < count($db); $i++) {
            $r[$i] = $db[$i]->po_number;
        }
        return view('layout.setting.barcode')->with(['ponumbers' => $r]);
    }
    public function pr_pending_list_org()
    {
        return $pr_list = DB::connection('mysql2')->select('Select * from p_r_creation_pendings where approval=0');
    }
    public function po_pending_list_org()
    {
        return $pr_list = DB::connection('mysql2')->select('Select * from p_o_creation__pendings where approval=0');
    }

    public function name_of_raw_material()
    {
        return view('layout.setting.type_of_raw_material');
    }
    public function name_of_material()
    {
        return view('layout.setting.name_of_material');
    }


    public function seller()
    {
        return view('layout.setting.seller');
    }

    public function pr_creation(Request $request)
    {
        $prcreation = new PRCreation();
        $prcreation->date = $request->date;
        $prcreation->pr_number = $request->pr_number;
        $prcreation->name_of_raw_matrial = $request->name_of_raw_matrial;
        $prcreation->quantity = $request->quantity;
        $prcreation->quality = $request->quality;
        $prcreation->remarks = $request->remarks;
        $prcreation->save();
        $success = 'Data Successfully Saved';
        return view('layout/setting/pr_creation')->with([ 'success' => $success ]);
    }

    public function po_creation(Request $request)
    {
        $prcreation = new PRCreation();
        $prcreation->date = $request->date;
        $prcreation->pr_number = $request->pr_number;
        $prcreation->serial_number = $request->serial_number;
        $prcreation->type_of_raw_matrial = $request->type_of_raw_matrial;
        $prcreation->quantity = $request->quantity;
        $prcreation->quality = $request->quality;
        $prcreation->remarks = $request->remarks;
        $prcreation->save();
        $success = 'Data Successfully Saved';
        return view('layout/setting/pr_creation')->with([ 'success' => $success ]);
    }

    public function po_receive_get()
    {
        return view('layout.setting.po_receive');
    }
}
