<?php
namespace App\Repositories\Repository;

use Exception;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function signup($request)
    {
        //dd($request->all());
         $created = $this->user->create($request->all());

        if($created)
         {
             return redirect('login')->with('message','Your Account is Created Plz LOgin');
         }
    }
    public function profileUpdate($request)
{
    try {
        DB::beginTransaction();

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);

        }
        $user->image = 'images/'.$imageName;
        $saved = $user->save();

        if ($saved) {

            $message = "Profile Updated";
        }
    } catch (Exception $e) {
        DB::rollBack();
        $message = "Error Occured! Please Try Again.";
    }
    DB::commit();
    return redirect('/profile')->with('message',   $message );
}
}
