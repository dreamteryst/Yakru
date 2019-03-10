<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'ans', 'example_id'];
    protected $hidden = ['ans'];

    public function choice()
    {
        return $this->hasMany('App\Choice');
    }
}
