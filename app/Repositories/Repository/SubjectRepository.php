<?php
namespace App\Repositories\Repository;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\SubjectInterface;
use Illuminate\Support\Facades\DB;

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
        return $query->paginate(5);

    }

}
