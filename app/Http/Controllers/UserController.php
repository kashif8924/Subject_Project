<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        $created = $user->save();
        if($created)
        {
            return redirect('login')->with('message','Your Account is Created Plz LOgin');
        }
    }

    public function profile()
    {
        $user =  Auth::user();
        return view('profile',compact('user'));
    }

    public function profileUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/'.$imageName;
        }
        $saved = $user->save();
        if($saved)
        {
            return redirect('/profile')->with('message', 'Profile Updated');
        }

    }

    public function logout()
{
    Auth::logout();

    return redirect('/login');
}

}
