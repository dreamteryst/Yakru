<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'bank_logo', 'bank_name', 'account_no', 'account_name', 'bank_branch'
    ];
}
