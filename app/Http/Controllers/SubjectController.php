<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        $subjects = Subject::paginate(5);
        return view('subject', compact('subjects'));
    }

    public function selectSubject($Subject_ID)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $subject = Subject::find($Subject_ID);
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
        $user = Auth::user();
        $user = User::find($user->id);
        $subjects = $user->subjects()->get();
        if ($subjects->isEmpty()) {
            return redirect('/subjects')->with('error', 'No Subject is Selected');
        }
        foreach($subjects as $subject)
        {
            $pivotData = $subject->pivot;
            $subjectId = $pivotData->subject_id;
            $selected_subject = Subject::find($subjectId);
            $selected_subjects[] = $selected_subject;

        }

        return view('selectedsubjects',compact('selected_subjects'));

    }

    public function dropSubject($subject_id)
    {
    $user = User::find(Auth::user()->id);
    $user->subjects()->detach($subject_id);
    return redirect()->back()->with('message','Subject Droped ');
    }
}
