<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherRegister extends Model
{
    protected $fillable = [
        'user_id', 'name', 'date_of_birth', 'attach', 'skill', 'bio', 'citizen_id', 'photo_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
