<?php

namespace App\Http\Controllers;

use App\TeacherRegister;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TeacherRegisterController extends Controller
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
            'name' => 'required',
            'date_of_birth' => 'required',
            'bio' => 'required',
            'skill' => 'required',
            'citizen_id' => 'required',
            'photo_id' => 'required',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $request->date_of_birth);
        $data['photo_id'] = $request->photo_id->store('photo_id');
        if ($request->attach) {
            $data['attach'] = $request->attach->store('attach');
        }

        $teacherRegister = TeacherRegister::create($data);
        if ($teacherRegister) {
            return $teacherRegister;
        } else {
            return response('failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeacherRegister  $teacherRegister
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherRegister $teacherRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherRegister  $teacherRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherRegister $teacherRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherRegister  $teacherRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherRegister $teacherRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherRegister  $teacherRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherRegister $teacherRegister)
    {
        //
    }

    public function anyData()
    {
        return Datatables::of(TeacherRegister::query())
            ->addColumn('email', function ($teacherRegister) {
                return $teacherRegister->user->email;
            })
            ->make(true);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $teacherRegister = TeacherRegister::find($request->id);
        $user = User::find($teacherRegister->user_id);
        $teacherRegister->status = $teacherRegister->status == 'accept' ? 'unaccept' : 'accept';
        $user->type = $teacherRegister->status == 'accept' ? 'teacher' : 'student';
        if ($teacherRegister->save() && $user->save()) {
            return $teacherRegister;
        } else {
            return response('failed', 500);
        }
    }
}
