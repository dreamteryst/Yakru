<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCourse extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'course_id'
    ];
}
