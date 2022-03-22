<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;


class AuthController extends Controller
{


    public function login(Request $request)
    {
        $credentials = [
            'name' => $request['name'],
            'password' => $request['password'],
        ];


        if (Auth::attempt($credentials)) {
            return redirect('pr_creation');
            //   return redirect()
        }

        return 'Failure';


    }
}
