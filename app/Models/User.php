<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        // Add other fillable fields as needed
    ];

    protected $hidden = [
        'password',
        'remember_token',
        // Add other hidden fields as needed
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function subjects()
    {
      return $this->belongsToMany(Subject::class);
    }
}
