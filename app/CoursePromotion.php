<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursePromotion extends Model
{
    protected $fillable = [
        'course_id', 'promotion_id'
    ];
}
