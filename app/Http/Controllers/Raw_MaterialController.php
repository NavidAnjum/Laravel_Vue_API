<?php

namespace App\Http\Controllers;

use App\Exports\Org_Report;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\Raw_Mat;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class Raw_MaterialController extends Controller
{
    public function index()
    {

        $details = DB::select("SELECT * FROM p_o_creations,`p_r_creations`,po_receives WHERE po_receives.po_number=p_o_creations.po_number and p_r_creations.pr_number=p_o_creations.pr_number;");

        return view('layout.setting.raw_material_report')->with('details', $details);
    }

    public function export()
    {
        return Excel::download(new Raw_Mat(), 'users.xlsx');
    }

    public function org_export()
    {
        return Excel::download(new Org_Report(), 'users.xlsx');
    }
}
