<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleUnit extends Model
{
    protected $fillable = [
        'schedule_id', 'unit_id'
    ];
}
