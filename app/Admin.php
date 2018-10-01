<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'date_of_birth', 'address', 
        'phone_number', 'degree', 'level', 'institution', 'rank', 'type', 'money'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', '=', 'master')->orWhere('type', '=', 'teacher');
        });
    }
}
