<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherRegister extends Model
{
    protected $fillable = [
        'prefix', 'firstname', 'lastname', 'date_of_birth', 'attach', 'skill', 'bio', 'cityzen_id', 'photo_id',
    ];
}
