<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view( 'Signup' );
    }

    public function signup(Request $request)
    {
        $check_email = User::where('email', $request->email)->exists();
        if($check_email)
        {
            return redirect()->back()->with('error', 'Email already exists in database');
        }
        $specialChars = preg_match('/[^\w\s]/', $request->password);
        $uppercaseLetter = preg_match('/[A-Z]/', $request->password);

        if (!$specialChars || !$uppercaseLetter) {

            return redirect()->back( )->with('error','Not a valid password');
        }

        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->father_name = $request->father_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }
}
