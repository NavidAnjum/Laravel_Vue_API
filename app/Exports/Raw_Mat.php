<?php


namespace App\Exports;

    use App\Models\POCreation;
    use App\Models\User;
    use Illuminate\Contracts\View\View;
    use Illuminate\Support\Facades\DB;
    use Maatwebsite\Excel\Concerns\FromView;

class Raw_Mat implements FromView
{
    public function view(): View
    {
//     $details=DB::table('p_o_creations')
//         ->join('p_r_creations',
//             'p_o_creations.pr_number','=','p_r_creations.pr_number')
//         ->join('po_receives ',
//             'p_o_creations.po_number','=','po_receives.po_number')
//        ->select('p_o_creations.name_of_mats','p_o_creations.supplier',
//            'p_o_creations.lc_number','p_o_creations.invoice','po_receives.tc_number',
//            'p_r_creations.name_of_raw_matrial','po_receives.gmo','po_receives.date',
//            'p_o_creations.bales','p_o_creations.total_kgs','p_o_creations.lc_buyer'
//            )
//     ;
        $details=DB::select("SELECT name_of_mats,supplier,lc_number,invoice,tc_number,name_of_raw_matrial,gmo,po_receives.date,bales,total_kgs,lc_buyer FROM p_o_creations,`p_r_creations`,po_receives WHERE po_receives.po_number=p_o_creations.po_number and p_r_creations.pr_number=p_o_creations.pr_number;
");


        return view('layout.setting.raw_material_report', [
            'details' => $details
        ]);

       // return $this->view(layout.setting.raw_material_report)->with(['details' => $details])
    }
}
