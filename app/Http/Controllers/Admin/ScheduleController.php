<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\ScheduleUnit;
use Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::where('user_id', Auth::user()->id)->with('schedule')->get();
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
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'unit' => 'required',
        ]);

        $schedule = Schedule::create($request->all());
        if ($schedule) {
            foreach ($request->unit as $unit) {
                ScheduleUnit::create(['schedule_id' => $schedule->id, 'unit_id' => $unit]);
            }
            return $schedule;
        } else {
            return response('failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->delete()) {
            return response('success');
        } else {
            return response('failed', 500);
        }
    }

    public function anyData(Request $request)
    {
        return Datatables::of(Schedule::with('unit')->where('course_id', $request->id))
            ->addColumn('unit_count', function ($lecture) {
                return (!empty($lecture->unit) ? $lecture->unit->count() : 0);
            })
            ->make(true);
    }
}
