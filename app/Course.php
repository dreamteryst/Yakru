<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'course_name',
        'course_subtitle',
        'course_description',
        'course_price',
        'requirements',
        'result',
        'tags',
        'type',
        'secret'
    ];
    
    protected $casts = [
        'requirements' => 'array',
        'result'  => 'array',
        'tags'  => 'array',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course');
    }

    public function units()
    {
        return $this->hasMany('App\Unit');
    }

    public function promotion()
    {
        return $this->belongsToMany('App\Promotion', 'course_promotions');
    }
}
