<?php

namespace App\Http\Controllers;

use App\Models\Name_of_lc_buyer;
use App\Models\Name_of_Raw_Material;
use App\Models\po_receive;
use App\Models\POCreation;
use App\Models\PRCreation;
use App\Models\Supplier_seller;
use Illuminate\Http\Request;

class APISettingController extends Controller
{

    public function index()
    {
    }

    public function raw_mat_name(){
        $raw_mat=Name_of_Raw_Material::all()->pluck('name_of_raw_material');
         $raw_mat->toArray();
        return $raw_mat->toJson();
    }
    public function pr_number(){
        $pr_number=PRCreation::max('id');
        $pr_number=$pr_number+1;
        return $pr_number;
    }
    public function po_number(){
        $po_number=POCreation::max('id');
        $po_number=$po_number+1;
        return $po_number;
    }
    public function po_number_list(){
        $po_number_list=POCreation::all()->pluck('po_number');
        $po_number_list->toArray();
        return $po_number_list->toJson();
    }
    public function lc_buyer(){
        $lc_buyer=Name_of_lc_buyer::all()->pluck('name_of_lc_buyer');
        $lc_buyer->toArray();
        return $lc_buyer->toJson();
    }
    public function supplier(){
        $supplier=Supplier_seller::all()->pluck('supplier');
        $supplier->toArray();
        return $supplier->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function name_of_supplier(Request $request){
        $data=json_decode($request->getContent(),true);
        $name=$data['supplier'];
        $name1=Supplier_seller::get()->where('supplier',$name);
        if(count($name1)<1){
            $n=New Supplier_seller([
               'supplier'=>$name
            ]);
            $n->save();
            return response()->json([
                'name'=>'Saved Successfully'
            ]);
        }
        else
        {
            return response()->json([
                'name'=>'This Supplier Previously Created'
            ]);
        }

    }

    public function name_of_lc_buyer(Request $request){
        $data=json_decode($request->getContent(),true);
        $name_of_lc_buyer=$data['lc_buyer'];
        $name=Name_of_lc_buyer::get()->where('name_of_lc_buyer',$name_of_lc_buyer);

        if(count($name)<1){
            $lc_buyer=new Name_of_lc_buyer([
                'name_of_lc_buyer'=>$name_of_lc_buyer
            ]);
            $lc_buyer->save();
            return response()->json([
                'name'=>'Successfully Saved'
            ]);
        }
        else
        {
            return response()->json([
            'name'=>'Name Previously Added'

            ]);
        }


    }

    public function name_of_raw_material(Request $request){
        $data=json_decode($request->getContent(),true);
        $name_of_raw_material=$data['name_of_raw_material'];
        $item_code=$data['item_code'];

        $raw=Name_of_Raw_Material::get()->where('item_code',$item_code);

        if(count($raw)===0){
           $raw_name= new Name_of_Raw_Material([
               'name_of_raw_material'=>$name_of_raw_material,
               'item_code'=>$item_code
           ]);
           $raw_name->save();
           return response()->json([
               'name'=>'New Raw Material Added'
           ]);
        }
        else
        {
            return response()->json([
                'name' => 'Raw Material Previously Created'
            ]);
        }
    }
    public function po_creation(Request $request)
    {
        $data=json_decode($request->getContent(),true);

        $date=$data['date'];
        $po_number=$data['po_number'];
        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $invoice=$data['invoice'];
        $bales=$data['bales'];
        $bales=$data['total_kgs'];

        $total_kgs=$data['total_kgs'];

        $id=POCreation::get()->where('po_number',$po_number);
        if(count($id)===0) {
            $pr = new POCreation([
                'date' => $data['date'],
                'po_number' => $data['po_number'],
                'lc_buyer' => $data['lc_buyer'],
                'supplier' => $data['supplier'],
                'lc_number' => $data['lc_number'],
                'invoice' => $data['invoice'],
                'bales' => $data['bales'],
                'total_kgs' => $data['total_kgs'],

            ]);
            $pr->save();
            return response()->json([
                'name' => 'PO Created Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PO Number Previously Created'
            ]);
        }
    }
    public function store(Request $request)
    {
        $data=json_decode($request->getContent(),true);

        $date=$data['date'];
        $pr_number=$data['pr_number'];
        $name_of_raw_matrial=$data['name_of_raw_matrial'];
        $quantity=$data['quantity'];
        $quality=$data['quality'];
        $remarks=$data['remarks'];
        $id=PRCreation::get()->where('pr_number',$pr_number);
        if(count($id)===0) {

            $pr = new PRCreation([
                'date' => $data['date'],
                'pr_number' => $data['pr_number'],
                'name_of_raw_matrial' => $data['name_of_raw_matrial'],
                'quantity' => $data['quantity'],
                'quality' => $data['quality'],
                'remarks' => $data['remarks']
            ]);
            $pr->save();
            return response()->json([
                'name' => 'PR Created Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PR Number Previously Created'
            ]);
        }
    }

    public function po_receive(Request $request){
        $data=json_decode($request->getContent(),true);

        $date=$data['date'];
        $po_number=$data['po_number'];
        $tc_number=$data['tc_number'];
        $gmo=$data['gmo'];
        $id=po_receive::get()->where('po_number',$po_number);
        if(count($id)===0) {

            $por = new po_receive([
                'date' => $data['date'],
                'po_number' => $data['po_number'],
                'tc_number' => $data['tc_number'],
                'gmo' => $data['gmo']
            ]);
            $por->save();
            return response()->json([
                'name' => 'PR Number Received Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'This PO Number Already Received'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
