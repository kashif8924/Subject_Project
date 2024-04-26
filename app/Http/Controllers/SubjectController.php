<?php

namespace App\Http\Controllers;

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
        return $this->subject->showSubject($request);
    }

    public function selectSubject($Subject_ID)
    {
       return $this->subject->selectSubject($Subject_ID);
    }

    public function viewSubject()
    {
        return $this->subject->viewSubject();
    }
    public function dropSubject($subject_id)
    {
    return $this->subject->dropSubject($subject_id);
    }

}
