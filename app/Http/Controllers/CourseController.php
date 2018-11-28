<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Request $request)
    {
        return Course::where('id', $request->id)->with(['category', 'units.lectures'])->first();
    }

    public function like(Request $request)
    {
        $course = Course::find($request->id);
        return Course::where('category_id', $course->category_id)->latest()->take(6)->get();
    }

    public function new()
    {
        return Course::orderBy('created_at', 'DESC')->take(6)->get();
    }
}
