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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDO;
use function MongoDB\BSON\toJSON;

class APISettingController extends Controller
{

    public function index()
    {
    }
    public function pr_creation_update($id)
    {
        return $pr=DB::select("Select * from p_r_creations where  id='$id'");

    }
    public function pr_creation_update_org($id)
    {
        return $pr=DB::connection('mysql2')->select("Select * from p_r_creations where  id='$id'");

    }
    public function po_creation_update($id)
    {
        return $po=DB::select("Select * from p_o_creations where  id='$id'");

    }

    public function po_creation_update_org($id)
    {
        return $pr=DB::connection('mysql2')->select("Select * from p_o_creations where  id=$id");

    }

    public function get_po_info($po_number){
        $r=POCreation::find($po_number);
        return $r;

    }
    public function store_get_po_info($po_number){
        $res=DB::connection('mysql2')->select("select * from p_o_creations where
        po_number='$po_number'");
        return $res[0];
    }

    public function pr_numbers_list()
    {
        $raw_mat=PRCreation::all()->pluck('pr_number');

        return $raw_mat;
    }

    public function po_receive_list()
    {
        return po_receive::all()->pluck('po_number');

    }
    public function po_receive_list_org()
    {
        return po_receive::all()->pluck('po_number');

    }

    public function name_of_mats()
    {
        $raw_mat=Name_of_Material::all()->pluck('name_of_material');
        return $raw_mat;
    }

    public function zsml_type_of_raw_material(){
        $raw_mat=Name_of_Raw_Material::all()->pluck('type_of_raw_material');
        return $raw_mat;
    }

    public function pr_number(){
        $pr_number=PRCreation_pending::max('id');
        $pr_number=$pr_number+1;

        return response()->json(["pr_number" => $pr_number], 200, [], JSON_NUMERIC_CHECK);

    }

    public function po_number(){
        $po_number=POCreation_Pending::max('id');
        $po_number=$po_number+1;
        return response()->json(["po_number" => $po_number], 200, [], JSON_NUMERIC_CHECK);

    }

    public function po_number_list(){
        $po_number_list=POCreation::all()->pluck('po_number');
        return $po_number_list;
    }
    public function org_po_number_list(){
        $db=DB::connection('mysql2')->select("select po_number from p_o_creations");
        $r=[];
        for ($i=0;$i<count($db);$i++){
            $r[$i]= $db[$i]->po_number;

        }
        return $r;
    }

    public function zsml_lc_buyer(){
        $lc_buyer=Name_of_lc_buyer::all()->pluck('name_of_lc_buyer');
        return $lc_buyer;
    }

    public function supplier(){
        $supplier=Supplier_seller::all()->pluck('supplier');
        return $supplier;
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
        //getting the name
     //   dd($org);
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


    public function type_of_raw_material(Request $request){
        $data=json_decode($request->getContent(),true);
        $type_of_raw_material=$data['type_of_raw_material'];

        $raw=Name_of_Raw_Material::get()->where('type_of_raw_material',$type_of_raw_material);

        if(count($raw)===0){
           $raw_name= new Name_of_Raw_Material([
               'type_of_raw_material'=>$type_of_raw_material
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



    public function name_of_material(Request $request){

        $data=json_decode($request->getContent(),true);
        $name_of_material=$data['name_of_material'];

        $raw=Name_of_Material::get()->where('name_of_material',$name_of_material);

        if(count($raw)===0){
            $raw_name= new Name_of_Material([
                'name_of_material'=>$name_of_material,
            ]);
            $raw_name->save();
            return response()->json([
                'name'=>'New Material Added'
            ]);
        }
        else
        {
            return response()->json([
                'name' => 'Material Previously Created'
            ]);
        }
    }
    public function po_creation(Request $request)
    {
        $data=json_decode($request->getContent(),true);
        $pr_number=$data['pr_number'];
        $date=$data['date'];
        $max=(POCreation::max('id'))+1;
        $po_number='PO-ZSML-'.$max;

        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $invoice=$data['invoice'];
        $bales=$data['bales'];
        $bales=$data['total_kgs'];
        $name_of_mat=$data['name_of_mat'];

        $total_kgs=$data['total_kgs'];

        $id=POCreation_Pending::get()->where('po_number',$po_number);
        if(count($id)===0) {
            $pr = new POCreation_Pending([
                'pr_number'=>$data['pr_number'],
                'date' => $data['date'],
                'po_number' =>$po_number,
                'lc_buyer' => $data['lc_buyer'],
                'supplier' => $data['supplier'],
                'lc_number' => $data['lc_number'],
                'invoice' => $data['invoice'],
                'bales' => $data['bales'],
                'total_kgs' => $data['total_kgs'],
                'name_of_mats'=>$data['name_of_mat'],
                'approval'=>'0'
            ]);
            $pr->save();
            return response()->json([
                'name' => 'PO Sent For Approval Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PO Previously Sent for Approval '
            ]);
        }
    }

    public function po_update(Request $request){
        $data=json_decode($request->getContent(),true);
        $pr_number=$data['pr_number'];
        $date=$data['date'];
        $po_number=$data['po_number'];

        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $invoice=$data['invoice'];
        $bales=$data['bales'];
        $bales=$data['total_kgs'];
        $name_of_mat=$data['name_of_mat'];

        $total_kgs=$data['total_kgs'];

        $id=POCreation_Pending::get()->where('po_number',$po_number);
        if(count($id)===0) {
            $pr = new POCreation_Pending([
                'pr_number'=>$data['pr_number'],
                'date' => $data['date'],
                'po_number' => $data['po_number'],
                'lc_buyer' => $data['lc_buyer'],
                'supplier' => $data['supplier'],
                'lc_number' => $data['lc_number'],
                'invoice' => $data['invoice'],
                'bales' => $data['bales'],
                'total_kgs' => $data['total_kgs'],
                'name_of_mats'=>$data['name_of_mat'],
                'approval'=>'0'
            ]);
            $pr->save();
            return response()->json([
                'name' => 'PO Sent For Approval Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PO Previously Sent for Approval '
            ]);
        }
    }
    public function pr_creation_approve(Request $request){
        $id=$request->id;
        $pr_pending=PRCreation_pending::find($id);
        $pr_pending->approval="1";
        $pr_pending->save();
        $pr=new PRCreation();
        $pr->id =$pr_pending->id ;

        $pr->pr_number =$pr_pending->pr_number ;
        $pr->date=$pr_pending->date;
        $pr->name_of_raw_matrial=$pr_pending->name_of_raw_matrial;
        $pr->remarks=$pr_pending->remarks;
        $pr->l_quantity=$pr_pending->l_quantity;
        $pr->s_quantity=$pr_pending->s_quantity;
        $pr->m_quantity=$pr_pending->m_quantity;
        $pr->approval=$pr_pending->approval;
        $pr->save();


        return response()->json([
            'name' => 'Approved!'
        ]);
    }

        public function pr_creation_remove(Request $request){
            $id=$request->id;
            $pr_pending=PRCreation_pending::find($id);
            $pr_pending->approval=2;
            $pr_pending->save();


            return response()->json([
                'name' => 'Rejected!'
            ]);
        }

    public function pr_creation_approve_org(Request $request){
        $id=$request->id;
        $pr_pending=DB::connection('mysql2')->select("Select * from p_r_creation_pendings where id='$id'");

        $pr_id =$pr_pending[0]->id ;


        $pr_pr_number =$pr_pending[0]->pr_number ;
        $pr_date=$pr_pending[0]->date;
        $pr_type_of_raw_matrial=$pr_pending[0]->type_of_raw_matrial;
        $pr_remarks=$pr_pending[0]->remarks;
        $pr_l_quantity=$pr_pending[0]->l_quantity;
        $pr_s_quantity=$pr_pending[0]->s_quantity;
        $pr_m_quantity=$pr_pending[0]->m_quantity;

        DB::connection('mysql2')->insert("Insert into p_r_creations(id,pr_number,date,
        type_of_raw_matrial,remarks,l_quantity,s_quantity,m_quantity)
         values ('$pr_id','$pr_pr_number','$pr_date','$pr_type_of_raw_matrial','$pr_remarks',
         '$pr_l_quantity','$pr_s_quantity','$pr_m_quantity')");

        DB::connection('mysql2')->update("Update p_r_creation_pendings
         Set approval='1'
         where id='$id'");

        return response()->json([
            'name' => 'Approved!'
        ]);
    }

    public function pr_creation_remove_org(Request $request){
        $id=$request->id;

        DB::connection('mysql2')->update("Update p_r_creation_pendings
         Set approval='2'
         where id='$id'");

        return response()->json([
            'name' => 'Rejected!'
        ]);
    }

    public function po_creation_approve_org(Request $request){
        $id=$request->id;
        $po_pending=DB::connection('mysql2')->select("Select * from p_o_creation__pendings where id='$id'");

        $pr_id =$po_pending[0]->id ;

        $po_number  =$po_pending[0]->po_number;
        $pr_number   =$po_pending[0]->pr_number ;
        $date  =$po_pending[0]->date;
        $lc_buyer  =$po_pending[0]->lc_buyer;
        $supplier  =$po_pending[0]->supplier;
        $invoice  =$po_pending[0]->invoice;
        $lc_number  =$po_pending[0]->lc_number;
        $bales  =$po_pending[0]->bales;
        $total_kgs  =$po_pending[0]->total_kgs;
        $name_of_mats  =$po_pending[0]->name_of_mats;



        DB::connection('mysql2')->insert("Insert into p_o_creations(id,po_number,pr_number,date,
        lc_buyer,supplier,invoice,lc_number,bales,total_kgs,name_of_mats)
         values ('$pr_id','$po_number','$pr_number','$date','$lc_buyer',
         '$supplier','$invoice','$lc_number','$bales','$total_kgs','$name_of_mats')");

        DB::connection('mysql2')->update("Update p_o_creation__pendings
         Set approval='1'
         where id='$id'");

        return response()->json([
            'name' => 'Approved!'
        ]);
    }

    public function po_creation_remove_org(Request $request){
        $id=$request->id;

        DB::connection('mysql2')->update("Update p_o_creation__pendings
         Set approval='2'
         where id='$id'");

        return response()->json([
            'name' => 'Rejected!'
        ]);
    }

    public function po_creation_approve(Request $request){
        $id=$request->id;

        $po_pending=POCreation_Pending::find($id);
        $po_pending->approval="1";
        $po=new POCreation();
        $po->id =$po_pending->id;

        $po->po_number  =$po_pending->po_number  ;
        $po->pr_number =$po_pending->pr_number ;
        $po->date=$po_pending->date;
        $po->lc_buyer=$po_pending->lc_buyer;
        $po->supplier=$po_pending->supplier;
        $po->invoice=$po_pending->invoice;
        $po->lc_number=$po_pending->lc_number;
        $po->bales=$po_pending->bales;
        $po->total_kgs=$po_pending->total_kgs;
        $po->name_of_mats=$po_pending->name_of_mats;


        $po->save();

        $po_pending->save();

        return response()->json([
            'name' => 'Approved!'
        ]);
    }

    public function po_creation_remove(Request $request){
        $id=$request->id;
        $po_pending=POCreation_Pending::find($id);
        $po_pending->approval=2;
        $po_pending->save();

        return response()->json([
            'name' => 'Rejected!'
        ]);
    }

    public function pr_number_update(Request $request){


        $data=json_decode($request->getContent(),true);

        $date=$data['date'];
        $pr_number=$data['pr_number'];
        $name_of_raw_matrial=$data['name_of_raw_matrial'];
        $l_quantity=$data['length_quantity'];

        $s_quantity=$data['strength_quantity'];

        $m_quantity=$data['mic_quantity'];


        $remarks=$data['remarks'];

        $id=PRCreation::get()->where('pr_number',$pr_number);


        if(count($id)>0) {

            DB::delete("Delete from p_o_creations where pr_number='$pr_number'");

            DB::delete("Delete from p_r_creations where pr_number='$pr_number'");
            $pr_id=DB::update("update p_r_creation_pendings set approval='0',
            date='$date',pr_number='$pr_number',name_of_raw_matrial='$name_of_raw_matrial',
            l_quantity='$l_quantity',s_quantity='$s_quantity',m_quantity='$m_quantity',remarks='$remarks'

             where pr_number='$pr_number'");

            return response()->json([
                'name' => 'PR has been updated and Sent For Approval'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PR Number Already Received and Can not be Modified'
            ]);
        }
    }
    public function po_number_update(Request $request){

        $data=json_decode($request->getContent(),true);

        $pr_number=$data['pr_number'];
        $date=$data['date'];
        $po_number=$data['po_number'];
        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $bales=$data['bales'];
        $total_kgs=$data['total_kgs'];
        $name_of_mat=$data['name_of_mat'];
        $total_kgs=$data['total_kgs'];

        $id=POCreation::get()->where('po_number',$po_number);
        if(count($id)>0) {
            DB::delete("Delete from p_o_creations where pr_number='$pr_number'");

            $pr_id=DB::update("update p_o_creation__pendings set approval='0',
            date='$date', pr_number='$pr_number', po_number='$po_number', lc_buyer='$lc_buyer',
            supplier='$supplier', invoice='$invoice',lc_number='$lc_number', bales='$bales',
            total_kgs='$total_kgs',name_of_mats='$name_of_mat',approval='0'
             where pr_number='$pr_number'");
            return response()->json([
                'name' => 'PO Sent For Approval Successfully'
            ]);

        }
        else{

            return response()->json([
                'name' => 'PO Number Already Received and Can not be Modified'
            ]);
        }
    }
    public function po_number_update_org(Request $request){
        $data=json_decode($request->getContent(),true);

        $pr_number=$data['pr_number'];
        $date=$data['date'];
        $po_number=$data['po_number'];

        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $bales=$data['bales'];
        $total_kgs=$data['total_kgs'];
        $name_of_mat=$data['name_of_mat'];
        $total_kgs=$data['total_kgs'];
        $id=DB::connection('mysql2')->select("select po_number from p_o_creations
        where po_number='$po_number'");
        if(count($id)>0) {
            DB::connection('mysql2')->delete("Delete from p_o_creations where pr_number='$pr_number'");

            $pr_id=DB::connection('mysql2')->update("update p_o_creation__pendings set approval='0',
            date='$date', pr_number='$pr_number', po_number='$po_number', lc_buyer='$lc_buyer',
            supplier='$supplier', invoice='$invoice',lc_number='$lc_number', bales='$bales',
            total_kgs='$total_kgs',name_of_mats='$name_of_mat',approval='0'
             where pr_number='$pr_number'");
            return response()->json([
                'name' => 'PO Updated and Sent For Approval'
            ]);

        }
        else{

            return response()->json([
                'name' => 'PO Number Already Received and Can not be Modified'
            ]);
        }
    }
    public function pr_number_update_org(Request $request){

        $data=json_decode($request->getContent(),true);

        $date=$data['date'];


        $pr_number=$data['pr_number'];


        $name_of_raw_matrial=$data['name_of_raw_matrial'];

        $l_quantity=$data['length_quantity'];

        $s_quantity=$data['strength_quantity'];

        $m_quantity=$data['mic_quantity'];


        $remarks=$data['remarks'];

        $id=DB::connection('mysql2')->select("Select * from p_r_creations where pr_number='$pr_number'");

        if(count($id)>0) {

            DB::connection('mysql2')->update("update p_r_creation_pendings set approval='0',
            date='$date',pr_number='$pr_number',type_of_raw_matrial='$name_of_raw_matrial',
            l_quantity='$l_quantity',s_quantity='$s_quantity',m_quantity='$m_quantity',remarks='$remarks'

             where pr_number='$pr_number'");


            DB::connection('mysql2')->delete("Delete from p_o_creations where pr_number='$pr_number'");

            DB::connection('mysql2')->delete("Delete from p_r_creations where pr_number='$pr_number'");

            return response()->json([
                'name' => 'PR has been updated and Sent For Approval'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PR Number Already Received and Can not be Modified'
            ]);
        }
    }

    public function store(Request $request)
    {
        $data=json_decode($request->getContent(),true);

        $date=$data['date'];


        $pr_number=$data['pr_number'];
        $id=(PRCreation::max('id'))+1;
        $pr_number="PR-ZSML-".$id;

        $name_of_raw_matrial=$data['name_of_raw_matrial'];

        $l_quality=$data['length_quantity'];

        $s_quality=$data['strength_quantity'];

        $m_quality=$data['mic_quantity'];


        $remarks=$data['remarks'];

        $id=PRCreation_pending::get()->where('pr_number',$pr_number);

        $data['approval']="0";
        if(count($id)===0) {

        $pr=new PRCreation_pending();
             $pr->date=$date;
            $pr->pr_number=$pr_number;
            $pr->name_of_raw_matrial=$name_of_raw_matrial;
            $pr->l_quantity=$l_quality;
            $pr->s_quantity=$s_quality;
            $pr->m_quantity=$m_quality;
            $pr->remarks=$remarks;
            $pr->approval="0";

            $pr->save();
            return response()->json([
                'name' => 'PR Sent For Approval Successfully'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PR already Sent for  Approval'
            ]);
        }
    }



    public function org_po_receive(Request $request){
        $data=json_decode($request->getContent(),true);

        $date=$data['date'];
        $po_number=$data['po_number'];
        $tc_number=$data['tc_number'];
        $gmo=$data['gmo'];
        $id=DB::connection('mysql2')->select("select * from po_receives where po_number='$po_number'");

        if(count($id)===0) {
            DB::connection('mysql2')->insert("insert into po_receives(po_number,date,tc_number,gmo) values
            ('$po_number','$date','$tc_number','$gmo')");
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
    public function org_name_of_lc_buyer(Request $request){

        $data=json_decode($request->getContent(),true);
        $name_of_lc_buyer=$data['lc_buyer'];

        $duplicate=DB::connection('mysql2')
            ->select("select * from name_of_lc_buyers where name_of_lc_buyer='$name_of_lc_buyer'");
        if (count($duplicate)>0)
        {
            return response()->json([
                'name'=>'Name Previously Added'

            ]);
        }
        else
        {
            $insert_into_supplier=DB::connection('mysql2')
                ->insert("Insert into name_of_lc_buyers(name_of_lc_buyer) values ('$name_of_lc_buyer')");
            return response()->json([
                'name'=>'Successfully Saved'
            ]);
        }


    }

    public function org_name_of_raw_material(Request $request){
            $data=json_decode($request->getContent(),true);
        $name_of_material=$data['name_of_material'];

        $duplicate=DB::connection('mysql2')
            ->select("select * from name_of__materials where name_of_material='$name_of_material'");
        if (count($duplicate)>0)
        {
            return response()->json([
                'name'=>'Name Previously Added'

            ]);
        }
        else
        {
            $insert_into_supplier=DB::connection('mysql2')
                ->insert("Insert into name_of__materials(name_of_material) values ('$name_of_material')");
            return response()->json([
                'name'=>'Successfully Saved'
            ]);
        }
    }
    public function org_type_of_raw_material(Request $request){

        $data=json_decode($request->getContent(),true);
        $type_of_raw_material=$data['type_of_raw_material'];

        $duplicate=DB::connection('mysql2')
            ->select("select * from type_of__raw__materials where type_of_raw_material='$type_of_raw_material'");
        if (count($duplicate)>0)
        {
            return response()->json([
                'name'=>'Previously Added'
            ]);
        }
        else
        {
            $insert_into_supplier=DB::connection('mysql2')
                ->insert("Insert into type_of__raw__materials(type_of_raw_material) values ('$type_of_raw_material')");
            return response()->json([
                'name'=>'Successfully Saved'
            ]);
        }
    }

    public function org_name_of_supplier(Request $request){

        $data=json_decode($request->getContent(),true);
        $supplier=$data['supplier'];
        $duplicate=DB::connection('mysql2')
            ->select("select * from supplier_sellers where supplier='$supplier'");

        if (count($duplicate)>0)
        {
            return response()->json([
                'name'=>'Previously Added'

            ]);
        }
        else
        {
            $insert_into_supplier=DB::connection('mysql2')
                ->insert("Insert into supplier_sellers(supplier) values ('$supplier')");
            return response()->json([
                'name'=>'Successfully Saved'
            ]);
        }
    }
    public function ysml_type_of_raw_material(){
        $db=DB::connection('mysql2')->select("select type_of_raw_material from type_of__raw__materials");
        $r=[];
        for ($i=0;$i<count($db);$i++){
            $r[$i]= $db[$i]->type_of_raw_material;

        }
        return $r;

//        return response()->json(["foo" => $r], 200, [], JSON_NUMERIC_CHECK);
    }

    public function ysml_pr_numbers_list()
    {
        $db=DB::connection('mysql2')->select("select pr_number from p_r_creations");
        $r=[];
        for ($i=0;$i<count($db);$i++){
            $r[$i]= $db[$i]->pr_number;
        }
        return $r;

    }
    public function ysml_pr_number(){
        $db=DB::connection('mysql2')->select("select max(id) as id from p_r_creation_pendings");
        $pr_number= $db[0]->id+1;
        return response()->json(["pr_number" => $pr_number], 200, [], JSON_NUMERIC_CHECK);

    }

    public function ysml_store(Request $request){
        $data=json_decode($request->getContent(),true);
//        $db=DB::connection('mysql2')->select("select max(id) as id from p_r_creation_pendings");
        $date=$data['date'];
        $pr_number=$data['pr_number'];
        $max=DB::connection('mysql2')->select("select max(id) from p_r_creations");
        return response()->json([
            'name' => $max
        ]);
        $type_of_raw_matrial=$data['name_of_raw_matrial'];
        $l_quantity=$data['length_quantity'];
        $m_quantity=$data['mic_quantity'];
        $s_quantity=$data['strength_quantity'];
        $remarks=$data['remarks'];


        $id=DB::connection('mysql2')->select("select * from p_r_creation_pendings where date='$date'
        and l_quantity='$l_quantity' and m_quantity='$m_quantity' and s_quantity='$s_quantity'
        ");


        if(count($id)===0) {

            $db=DB::connection('mysql2')->insert("insert into p_r_creation_pendings(pr_number,date,
type_of_raw_matrial,l_quantity,m_quantity,s_quantity,remarks,approval)
        values ('$pr_number','$date','$type_of_raw_matrial','$l_quantity','$m_quantity','$s_quantity','$remarks','0') ");

            return response()->json([
                'name' => 'PR Sent For Approval Successfully'
            ]);

        }
        else{
            return response()->json([
                'name' => 'PR Previously Sent For Approval!'
            ]);
        }
    }

    public function org_lc_buyer(){
        $lc_buyer=DB::connection('mysql2')->select("select name_of_lc_buyer from name_of_lc_buyers");
        $r=[];
        for ($i=0;$i<count($lc_buyer);$i++){
            $r[$i]= $lc_buyer[$i]->name_of_lc_buyer;

        }
        return $r;
    }
    public function org_name_of_mats()
    {

        $raw_mat=DB::connection('mysql2')->select("select name_of_material from name_of__materials");
        $r=[];
        for ($i=0;$i<count($raw_mat);$i++){
            $r[$i]= $raw_mat[$i]->name_of_material;

        }
        return $r;
    }

    public function org_supplier(){

        $supplier=DB::connection('mysql2')->select("select supplier from supplier_sellers");
        $r=[];
        for ($i=0;$i<count($supplier);$i++){
            $r[$i]= $supplier[$i]->supplier;

        }
        return $r;
    }

    public function org_po_number(){
          $g_id=DB::connection('mysql2')->select("select max(id) as id from p_o_creations");
        return $po_number=$g_id[0]->id+1;

    }

    public function org_po_creation(Request $request)
    {
        $data=json_decode($request->getContent(),true);
        $pr_number=$data['pr_number'];

        $date=$data['date'];

        $lc_buyer=$data['lc_buyer'];
        $supplier=$data['supplier'];
        $invoice=$data['invoice'];
        $lc_number=$data['lc_number'];
        $bales=$data['bales'];
        $name_of_mat=$data['name_of_mat'];
        $total_kgs=$data['total_kgs'];

        $db=DB::connection('mysql2')->select("select max(id) as id from p_o_creation__pendings");
        $maxid=$db[0]->id+1;
        $data['id']=$maxid;
        $po_number='PO-TSML-'.$maxid;

        $id=DB::connection('mysql2')->select("select * from p_o_creation__pendings where po_number='$po_number'
        ");

        if(count($id)===0) {

            $db=DB::connection('mysql2')->insert("insert into p_o_creation__pendings( pr_number,date,
po_number,lc_buyer,supplier,lc_number,invoice,bales,total_kgs,name_of_mats,approval)
        values ('$pr_number','$date','$po_number','$lc_buyer',
        '$supplier','$lc_number','$invoice','$bales','$total_kgs','$name_of_mat','0') ");

            return response()->json([
                'name' => 'PO Sent For Approval'
            ]);
        }
        else{
            return response()->json([
                'name' => 'PO Previously Sent For Approval'
            ]);
        }
    }
}
