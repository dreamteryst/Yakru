<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'bank_id', 'user_id', 'transferred_at', 'amount', 'slip'
    ];
}
