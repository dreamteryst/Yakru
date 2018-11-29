<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'message', 'time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
