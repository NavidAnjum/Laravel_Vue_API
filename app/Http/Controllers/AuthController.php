<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;
use phpDocumentor\Reflection\Types\Integer;

class AuthController extends Controller
{
    public function dashboard(){
        return view('layout/dashboard');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
    public function login(Request $request)
    {
        $credentials = [
            'name' => $request['name'],
            'password' => $request['password'],
        ];


        if (Auth::attempt($credentials)) {
            $user=new User();


            $userrole=$user->find( Auth::id())->userroles;
            //$userrole=User::with('userroles')->find($user->id);
            $role=$userrole->role;

            Session(['role'=> $role]);
            if($role==='admin'){
                return redirect('ZSML/dashboard');

            }
            else{
                return redirect($role.'/dashboard');

            }


        }

        return 'Failure';


    }
}
