<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = ['course_id', 'user_id', 'reason', 'status', 'amount'];

    public function course()
    {
        return $this->belongsTo('App\Course')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
