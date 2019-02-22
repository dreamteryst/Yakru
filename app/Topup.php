<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status', 'method', 'evidence'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function payment()
    {
        return $this->hasOne('App\Topup');
    }
}
