<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\Raw_Mat;
use Maatwebsite\Excel\Facades\Excel;

class Raw_MaterialController extends Controller
{


    public function export()
    {
        return Excel::download(new Raw_Mat, 'users.xlsx');
    }
}
