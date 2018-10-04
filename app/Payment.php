<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'topup_id', 'bank_id', 'user_id', 'transferred_at', 'amount', 'slip'
    ];

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function topup()
    {
        return $this->belongsTo('App\Topup');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
