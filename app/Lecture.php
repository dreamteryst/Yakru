<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'unit_id', 'lecture_name', 'video_name'
    ];

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
