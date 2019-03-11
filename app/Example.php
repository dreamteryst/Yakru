<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $fillable = ['example_type', 'course_id', 'time_limit'];

    protected $appends = ['isDone'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public function userExample()
    {
        return $this->hasOne('App\UserExample');
    }

    public function getIsDoneAttribute() {
        return !empty($this->userExample);
    }
}
