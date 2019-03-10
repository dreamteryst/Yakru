<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExample extends Model
{
    protected $casts = [
        'answers' => 'array'
    ];
    protected $fillable = ['example_id', 'point', 'answers', 'started_at', 'ended_at'];
}
