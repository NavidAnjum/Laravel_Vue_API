<?php

namespace App\Http\Controllers;

use App\Models\Name_of_Raw_Material;
use App\Models\PRCreation;
use Illuminate\Http\Request;

class APISettingController extends Controller
{

    public function index()
    {
        //
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
    public function name_of_raw_material(Request $request){
        $data=json_decode($request->getContent(),true);
        $name_of_raw_material=$data['name_of_raw_material'];
        $raw=Name_of_Raw_Material::get()->where('name_of_raw_material',$name_of_raw_material);
        if(count($raw)===0){
           $raw_name= new Name_of_Raw_Material([
               'name_of_raw_material'=>$name_of_raw_material
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
