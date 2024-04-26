<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function users()
    {
       return  $this->belongsToMany(User::class);
    }

    public function scopeSubject($query , $id)
    {
        return $query->find($id);
    }

    public function scopeFilter($query,$keyword)
    {
        $query->where('name','like','%'.$keyword.'%');
    }

}
