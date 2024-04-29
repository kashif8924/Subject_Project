<?php
namespace App\Repositories\Repository;

use Exception;
use App\Helpers\ImageHelper;
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
        try{
            DB::beginTransaction();
         $created =  $this->user->create($request->all());
         if($created)
         {
            $created = "created";
         }
        }
        catch (\Exception $e) {
            DB::rollBack();
            $created =  "error";
        }
        DB::commit();
        return $created;

    }
    public function profileUpdate($request)
{
    try {
        DB::beginTransaction();

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $saved = $user->save();

        if ($saved) {
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                ImageHelper::ImageUpload('users',$image,'image');
            }
            $message = "updated";
        }
    } catch (Exception $e) {
        DB::rollBack();
        $message = "Error";
    }
    DB::commit();
    return $message;
}
}
