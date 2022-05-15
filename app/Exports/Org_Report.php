<?php


namespace App\Exports;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class Org_Report implements FromView
{
    public function view(): View
    {

        $details=DB::connection('mysql2')->select("SELECT name_of_mats,supplier,lc_number,invoice,
tc_number,type_of_raw_matrial,gmo,po_receives.date,bales,total_kgs,lc_buyer FROM
 p_o_creations,`p_r_creations`,po_receives WHERE
po_receives.po_number=p_o_creations.po_number and p_r_creations.pr_number=p_o_creations.pr_number;
");


        return view('layout.setting.raw_material_report', [
            'details' => $details
        ]);
    }
}
