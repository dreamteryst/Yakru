<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'course_id','user_id', 'order_no', 'order_note', 'course_price'
    ];
}
