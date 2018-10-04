<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'promotion_name', 'promotion_description', 'discount', 'started_at', 'ended_at'
    ];

    public function course()
    {
        return $this->belongsToMany('App\Course', 'course_promotions');
    }
}
