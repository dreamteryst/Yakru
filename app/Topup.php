<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status', 'method'
    ];

    public function user()
    {
        return $this->belongsTo('App\Topup');
    }

    public function payment()
    {
        return $this->hasOne('App\Topup');
    }
}
