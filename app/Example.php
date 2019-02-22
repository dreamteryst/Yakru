<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $fillable = ['example_type', 'course_id'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
