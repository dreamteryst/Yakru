<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'firstname', 'lastname', 'date_of_birth', 'address', 
        'phone_number', 'degree', 'level', 'institution', 'rank', 'type', 'money'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topup()
    {
        return $this->hasMany('App\Topup');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'user_course');
    }
}
