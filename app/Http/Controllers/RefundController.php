<?php

namespace App\Http\Controllers;

use App\Course;
use App\Order;
use App\Refund;
use App\User;
use App\UserCourse;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RefundController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required',
            'reason' => 'required',
        ]);

        $refunded = Refund::where('user_id', $request->user()->id)
            ->where('course_id', $request->course_id)
            ->where('status', '!=', 'reject')
            ->exists();
        if($refunded) {
            return response(['message' => 'คุณเคยขอคืนเงินจากคอร์สนี้ไปแล้ว'], 422);
        }

        $order = Order::where('course_id', $request->course_id)->where('user_id', $request->user()->id)->first();
        $course = Course::findOrFail($request->course_id);
        $data['amount'] = $order->course_price * $course->refund_percentage / 100;
        $data['user_id'] = $request->user()->id;

        $refund = Refund::create($data);
        if ($refund) {
            return $refund;
        } else {
            return response('failed', 500);
        }
    }

    /**
     * mode 1 is approve
     * mode 2 is reject
     */
    public function confirm(Request $request, $id)
    {
        $request->validate([
            'mode' => 'required|numeric',
        ]);
        $refund = Refund::findOrFail($id);
        if ($request->mode == 1) {
            $user = User::findOrFail($refund->user_id);
            $user->money += $refund->amount;

            $userCourse = UserCourse::where('user_id', $user->id)->where('course_id', $refund->course_id)->delete();
            if (!$user->save()) {
                return response(['message' => 'failed'], 500);
            }
            $refund->status = 'approve';
        } else {
            $refund->status = 'reject';
        }
        if ($refund->save()) {
            return 'success';
        } else {
            return response(['message' => 'failed'], 500);
        }
    }

    public function anyData(Request $request)
    {
        $user = $request->user();
        $refund = Refund::query();
        if ($user->type == "teacher") {
            $refund->whereHas('course', function($query) {
                $query->where('user_id', $user->id);
            });
        }
        return Datatables::of($refund)
        ->addColumn('user_name', function($refund) {
            return $refund->user->firstname.' '.$refund->user->lastname;
        })
        ->filterColumn('user_name', function($query, $keyword) {
            $query->whereHas('user', function($query) use ($keyword) {
                $query->whereRaw("CONCAT(firstname, ' ', lastname) like ?", ["%{$keyword}%"]);
            });
        })
        ->addColumn('course_name', function($refund) {
            return $refund->course->course_name;
        })
        ->filterColumn('course_name', function($query, $keyword) {
            $query->whereHas('course', function($query) use ($keyword) {
                $query->where('course_name', 'like', '%'.$keyword.'%');
            });
        })
        ->make(true);
    }
}
