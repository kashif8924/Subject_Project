<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function index()
    {
        return view( 'Signup' );
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[^A-Za-z0-9])/',
            ],
            'email'=>[
                'required',
                'email',
                'unique:users,email',
            ],
            'first_name'=>[
                'required'
            ],
            'last_name'=>[
                'required'
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->father_name = $request->father_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    }
}
