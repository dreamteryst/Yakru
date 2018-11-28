<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'course_id', 'user_id', 'title', 'start', 'end'
    ];

    public function unit()
    {
        return $this->belongsToMany('App\Unit', 'schedule_units');
    }
}
