<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Support\Facades\Hash;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
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
    public function setPasswordAttribute($password)

    {
        $this->attributes['password'] = Hash::make($password);
    }
    public function subjects()
    {
      return $this->belongsToMany(Subject::class);
    }

    public function scopeUser($query,$id)
    {
        return $query->find($id);
    }

}
