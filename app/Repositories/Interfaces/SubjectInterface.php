<?php
namespace App\Repositories\Interfaces;

interface SubjectInterface
{
    public function showSubject($request);
    public function selectSubject($Subject_ID);
    public function viewSubject();
    public function dropSubject($subject_id);
    public function createSubject($name ,$image);
}
