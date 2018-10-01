<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'promotion_name', 'promotion_description', 'started_at', 'ended_at'
    ];
}
