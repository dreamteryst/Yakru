<?php

namespace App;

use Auth;
use App\Promotion;
use App\UserCourse;
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
        'course_picture',
        'course_video',
        'course_name',
        'course_subtitle',
        'course_description',
        'course_price',
        'course_discounted',
        'course_limit',
        'requirements',
        'result',
        'tags',
        'user_id',
        'type',
        'secret'
    ];
    
    protected $casts = [
        'requirements' => 'array',
        'result'  => 'array',
        'tags'  => 'array',
    ];

    public $appends = ['final_price', 'is_bought'];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function schedule()
    {
        return $this->hasMany('App\Schedule');
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

    public function getFinalPriceAttribute()
    {
        $course_id = $this->id;
        $promotions = Promotion::with('course')->get()->filter(function ($value) use ($course_id) {
            foreach($value->course as $course) {
                return $course_id == $course->id;
            }
        });
        $final_price = $this->course_discounted;
        if(count($promotions) > 0) {
            foreach($promotions as $promotion) {
                $final_price = $this->course_price - $this->course_price * $promotion->discount / 100;
            }
        }
        return number_format((float)$final_price, 2, '.', '');
    }

    public function getIsBoughtAttribute()
    {
        $userCourse = UserCourse::where('user_id', Auth::user()->id)->where('course_id', $this->id)->count();
        return $userCourse > 0;
    }
}
