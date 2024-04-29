<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Subject;
use App\Repositories\Interfaces\SubjectInterface;
use Illuminate\Http\Request;
class SubjectController extends Controller
{
    protected $subject;

    public function __construct(SubjectInterface $subject)
    {
            $this->subject = $subject;
    }

    public function index(Request $request)
    {
        $subjects = $this->subject->showSubject($request);
        //return $subjects;
        return view('subject', compact('subjects'));
    }

    public function selectSubject($Subject_ID)
    {
         $response = $this->subject->selectSubject($Subject_ID);
         if($response == 'Selected')
         {
         return redirect('/subjects')->with('error','Selected');;
        }
        if($response == 'Already_Selected')
        {
            return redirect('/subjects')->with('error','Already Selected this Subject');
        }
    }

    public function viewSubject()
    {
        $subjects = $this->subject->viewSubject();
        if($subjects)
        {
        return view('selectedsubjects',compact('subjects'));
        }
    }
    public function dropSubject($subject_id)
    {
    $response =  $this->subject->dropSubject($subject_id);
    if($response == 1)
    {
    return redirect('/viewsubject')->with('message','Subject Droped ');
    }
    }

    public function addSubject()
    {
        return view('addsubject');
    }

    public function createSubject(UserStoreRequest $request)
    {
        $response = $this->subject->createSubject($request->name , $request->file('image'));
        if($response == 'success')
        {
            return redirect('/addsubject')->with('message',"Subject Created Successfully");
        }
    }

}
