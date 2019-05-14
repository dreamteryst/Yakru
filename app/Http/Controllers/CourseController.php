<?php

namespace App\Http\Controllers;

use Auth;
use App\Course;
use App\Order;
use App\UserCourse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function buy(Request $request)
    {
        $request->validate([
            'course_id' => 'required' 
        ]);

        $course = Course::find($request->course_id);
        $user = Auth::user();
        if($user->money < $course->final_price) {
            return response(['message' => 'ยอดเงินคงเหลือไม่พอ'], 422);
        }
        $user->money = $user->money - $course->final_price;
        
        $orderNum = Order::whereDate('created_at', Carbon::today())->count();
        $dataOrder = [
            'user_id' => Auth::user()->id,
            'course_id' => $course->id,
            'order_no' => Carbon::today()->format('YYYYmd').str_pad($orderNum, 3, '0', STR_PAD_LEFT),
            'order_note' => '',
            'course_price' => $course->final_price
        ];
        $order = Order::create($dataOrder);

        $dataUserCourse = [
            'user_id' => Auth::user()->id,
            'course_id' => $course->id
        ];
        $userCourse = UserCourse::create($dataUserCourse);

        if($order && $userCourse && $user->save()){
            return $order;
        } else {
            return response('failed', 500);
        }
    }

    public function show(Request $request)
    {
        return Course::where('id', $request->id)->with(['category', 'example.question.choice', 'units.lectures', 'schedule' => function($query) {
            $query->with('unit')->orderBy('start');
        }])->first();
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

    public function myCourse()
    {
        return UserCourse::where('user_id', Auth::user()->id)->with('course')->get();
    }

    public function teacherCourse()
    {
        return Course::where('user_id', Auth::user()->id)->get();
    }

    public function courseUser(Request $request)
    {
        return Course::where('id', $request->id)->with(['users', 'category', 'example.userExample'])->first();
    }

    public function notify(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = 'esiOa7cEPQ7ohgAUWHA4aAeDoPDdpPs9X2OREgSSsPt';
        $message = "คอร์ส ".$course->course_name." เริ่มต้นแล้ว";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.$message);
        // follow redirects
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$line_token,
        ]);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        return "success";
    }

}
