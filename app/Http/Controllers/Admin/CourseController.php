<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|max:200',
            'course_subtitle' => 'required|max:200',
            'course_description' => 'required|max:200',
            'course_price' => 'required|max:6'
        ]);
        $data['requirements'] = json_decode($request['requirements']);
        $data['result'] = json_decode($request['results']);
        $data['tags'] = json_decode($request['tags']);
        $data['admin_id'] = 1;
        
        $Course = new Course();

        return $Course::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $data =  $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|max:200',
            'course_subtitle' => 'required|max:200',
            'course_description' => 'required|max:200',
            'course_price' => 'required|max:6'
        ]);
        $data['requirements'] = json_decode($request['requirements']);
        $data['result'] = json_decode($request['results']);
        $data['tags'] = json_decode($request['tags']);
        $data['admin_id'] = 1;

        if($course->update($data)){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $course->course_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if($course->delete()){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $course->course_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    public function anyData()
    {
        return Datatables::of(Course::query())
        ->addColumn('category_name', function($course){
            return $course->category->category_name;
        })
        ->filterColumn('category_name', function($query, $keyword){
            $query->whereHas('category', function($subQuery) use ($keyword){
                $subQuery->where('category_name', 'like', "%{$keyword}%");
            });
        })
        ->addColumn('fullname', function($course){
            return $course->admin->firstname." ".$course->admin->lastname;
        })
        ->filterColumn('fullname', function($query, $keyword){
            $query->whereHas('admin', function($subQuery) use ($keyword){
                $subQuery->whereRaw("CONCAT(firstname, ' ', lastname) like ?", ["%{$keyword}%"]);
            });
        })
        ->make(true);
    }
}
