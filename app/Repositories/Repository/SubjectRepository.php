<?php
namespace App\Repositories\Repository;

use App\Models\User;
use App\Models\Subject;
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
        $user = $this->user->user((Auth::user()->id));
        $subject = $this->subject->subject($Subject_ID);
        if (!$subject) {
            return 'Subject not found';
        }

        try {

            $user->subjects()->attach($subject->id);

        } catch (QueryException $e) {

             'Error: ' . $e->getMessage();

             return redirect()->back()->with('error', 'You have Already Selected This Subject');
        }

        return redirect()->back();
    }
    public function viewSubject()
    {
       $user = $this->user->user((Auth::user()->id));
        $subjects = $user->subjects()->with('users')->get();

        return view('selectedsubjects',compact('subjects'));
    }

    public function dropSubject($subject_id)
    {
        $user = $this->user->user((Auth::user()->id));
        $user->subjects()->detach($subject_id);
        return redirect('/viewsubject')->with('message','Subject Droped ');
    }
    public function showSubject($request)
    {
        $subjects = Subject::paginate(5);

        if($request->filled('subject'))
        {
            $subjects = $this->subject->filter($request->subject)->paginate(5);
            if ($subjects->isEmpty())
            {
                    return redirect('/subjects')->with('error', 'No Such Subject');
            }
        }
        return view('subject', compact('subjects'));
    }

}
