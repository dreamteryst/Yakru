<?php

namespace App\Http\Controller\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{
    public function anyData()
    {
        return Datatables::of(Admin::with('course'))
        ->addColumn('course_count', function($student){
            return $student->course->count();
        })
        ->addColumn('fullname', function($student){
            return $student->firstname.' '.$student->lastname;
        })
        ->filterColumn('fullname', function($query, $keyword){
            $query->whereRaw("CONCAT(firstname, ' ', lastname) like ?", ["%{$keyword}%"]);
        })
        ->make(true);
    }
}
