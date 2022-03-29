<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\Raw_Mat;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class Raw_MaterialController extends Controller
{
    public function index(){
        $find=User::all();

        return view('layout.setting.raw_material_report')->with('invoices',$find);

    }

    public function export()
    {
        return Excel::download(new Raw_Mat, 'users.xlsx');
    }
}
