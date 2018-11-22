<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLecture extends Model
{
    protected $fillable = [
        'user_id', 'lecture_id', 'time'
    ];
}
