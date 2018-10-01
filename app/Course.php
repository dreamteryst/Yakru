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
        'admin_id',
        'type',
        'secret'
    ];
    
    protected $casts = [
        'requirements' => 'array',
        'result'  => 'array',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
