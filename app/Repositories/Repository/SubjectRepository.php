<?php
namespace App\Repositories\Repository;

use App\Models\User;
use App\Models\Subject;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\SubjectInterface;

class SubjectRepository implements SubjectInterface
{

    protected $user;
    protected $subject;

    public function __construct(Subject $subject , User $user)
    {
        $this->user = $user;
        $this->subject = $subject;
    }

    public function selectSubject($Subject_ID)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->user((Auth::user()->id));  //this is only for practice
            $user = Auth::user();
            $subject = $this->subject->subject($Subject_ID);
            $exists = DB::table('subject_user')->where('user_id' ,$user->id)->where('subject_id',$subject->id)->exists();
            if($exists)
            {
                $message =  'Already_Selected';
            }
            if(!$exists)
            {
                $user->subjects()->attach($subject->id);
                $message = "Selected";
            }

        } catch (QueryException $e) {
            DB::rollBack();
            $message =  'Error';
        }
        DB::commit();

        return $message;
    }
    public function viewSubject()
    {
       $user = $this->user->user((Auth::user()->id));
       return  $subjects = $user->subjects()->with('users')->get();
    }

    public function dropSubject($subject_id)
    {
        $user = $this->user->user((Auth::user()->id));
        return $user->subjects()->detach($subject_id);

    }
    public function showSubject($request)
    {
        $query = $this->subject;
        if($request->filled('subject')){
            $query = $query->filter($request->subject);
        }
         return  $subjects =  $query->with('users')->paginate(5);
    }
    public function createSubject($name ,$image)
    {
        try{
            DB::beginTransaction();
         $this->subject->name = $name;
         $this->subject->save();
        ImageHelper::ImageUpload('subjects',$image,'image',$this->subject->id);
        $message = 'success';
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            $message = 'error';
        }
        DB::commit();
        return $message;
    }

}
