<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // $exists = User::where('email',$request->email)->where('email',$request->email)->exists();
        // if ($exists){

        //     return "Logined";
        // }

        $credientials = $request->only('email','password');

        if(Auth::attempt($credientials))
        {
            return "logged";
        }
        return "Not logged in";
    }
}
