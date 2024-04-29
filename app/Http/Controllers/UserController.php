<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{

    protected $user;

    public function __construct(UserInterface $Ui)
    {
        $this->user = $Ui;
    }

    //
    public function index()
    {
        return view( 'Signup' );
    }

    public function signup(UserStoreRequest $request)
    {
        $response =    $user = $this->user->signup($request);

        if($response == 'created'){
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
       $response =  $this->user->profileUpdate($request);
       if($response == 'updated'){
        return redirect('/profile')->with('message','Your Profile has been updated');
       }
       if($response == 'Error')
       {
        return redirect('/profile')->with('message','Error occured while updating your profile');
       }

    }

    public function logout()
{
    Auth::logout();

    return redirect('/login');
}

}
