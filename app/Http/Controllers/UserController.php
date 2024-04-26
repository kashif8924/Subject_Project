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
       return   $user = $this->user->signup($request);
    }

    public function profile()
    {
        $user =  Auth::user();
        return view('profile',compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        return $this->user->profileUpdate($request);
    }

    public function logout()
{
    Auth::logout();

    return redirect('/login');
}

}
