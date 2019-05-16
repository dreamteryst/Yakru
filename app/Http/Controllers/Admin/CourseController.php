<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Unit;
use App\Refund;
use App\Order;
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
        $request->validate([
            'category_id' => 'required',
            'course_name' => 'required|max:200',
            'course_subtitle' => 'required|max:200',
            'course_description' => 'required|max:200',
            'course_price' => 'required|numeric|min:0|max:2000000000',
            'course_picture' => 'required',
            'course_video' => 'required',
            'course_discounted' => 'required|numeric|min:0|max:2000000000',
            'course_limit' => 'required|numeric|min:0|max:1000000',
            'type' => 'required',
            'refund_policy' => 'required',
            'refund_percentage' => 'required|numeric|min:1|max:100'
        ]);
        $picture = $request->file('course_picture')->store('course_pictures');
        $data = [
            'category_id' => $request->category_id,
            'course_name' => $request->course_name,
            'course_subtitle' => $request->course_subtitle,
            'course_description' => $request->course_description,
            'course_price' => $request->course_price,
            'course_picture' => $picture,
            'course_video' => $request->course_video,
            'course_discounted' => $request->course_discounted,
            'course_limit' => $request->course_limit,
            'secret' => bin2hex(random_bytes(10)),
            'type' => $request->type,
            'refund_policy' => $request->refund_policy,
            'refund_percentage' => $request->refund_percentage
        ];
        $data['requirements'] = json_decode($request['requirements']);
        $data['result'] = json_decode($request['results']);
        $data['tags'] = json_decode($request['tags']);
        $data['user_id'] = $request->user()->id;
        
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
            'course_price' => 'required|numeric|min:0|max:2000000000',
            'course_discounted' => 'required|numeric|min:0|max:2000000000',
            'course_limit' => 'required|numeric|min:0|max:1000000',
            'refund_policy' => 'required',
            'refund_percentage' => 'required|numeric|min:1|max:100'
        ]);
        
        $data['requirements'] = json_decode($request['requirements']);
        $data['result'] = json_decode($request['results']);
        $data['tags'] = json_decode($request['tags']);
        $data['admin_id'] = 1;

        if($course->update($data)){
            return json_encode(['success' => true, 'message' => 'อัพเดทข้อมูล ' . $course->course_name . ' เรียบร้อย']);
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
        foreach($course->users as $user) {
            $order = Order::where('course_id', $course->id)->where('user_id', $user->id)->first();
            $data = [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $order->course_price * $course->refund_percentage / 100,
                'reason' => 'Teacher cancel',
                'status' => 'approve'
            ];
            $user->money += $data['amount'];
            $refund = Refund::create($data);
            if(!$refund && !$user->save()) {
                return response(['message' => 'Failed'], 500);
            }
        }
        if($course->delete()){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $course->course_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    public function anyData(Request $request)
    {
        $user = $request->user();
        $course = Course::with('users');
        if ($user->type == "teacher") {
            $course->where('user_id', $user->id);
        }
        return Datatables::of($course)
        ->addColumn('student_count', function($course){
            return $course->users->count();
        })
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

    public function unit(Request $request)
    {
        return Unit::where('course_id', $request->id)->get();
    }
}
