<?php

namespace App\Http\Controllers\Admin;

use App\Unit;
use App\Lecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class UnitController extends Controller
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
            'unit_name' => 'required',
            'lectures' => 'required|array',
            'course_id' => 'required'
        ]);

        $data = [
            'unit_name' => $request->unit_name,
            'course_id' => $request->course_id
        ];

        $unit = Unit::create($data);
        if($unit) {
            foreach($request->lectures as $lecture) {
                if ($lecture['type'] === 'youtube')
                {
                    $video = $lecture['url'];
                    $mime = 'youtube';
                } else {
                    $video = $lecture['video']->store('videos');
                    $mime = $lecture['video']->getMimeType();
                }
                $data_lecture = [
                    'unit_id' => $unit->id, 
                    'lecture_name' => $lecture['name'], 
                    'video_name' => $video,
                    'mime_type' => $mime,
                    'guest' => $lecture['guest'] === "true"
                ];
                $lecture = Lecture::insert($data_lecture);
                if(!$lecture) {
                    return response('failed', 500);
                }
            }
            return "success";
        } else {
            return response('failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
       $request->validate([
            'unit_name' => 'required'
        ]);

        $unit->unit_name = $request->unit_name;
        if($unit->save()) {
            return $unit;
        } else {
            return response('failed', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    { 
        return $unit->delete() ? "success" : response('failed', 500);
    }

    public function anyData(Request $request)
    {
        return Datatables::of(Unit::with('lectures')->where('course_id', $request->id))
        ->addColumn('lecture_count', function($unit){
            return $unit->lectures->count();
        })
        ->make(true);
    }

    public function upload(Request $request){
        $file = $request->file('video');
        $filename = $file->getClientOriginalName();
        $path = public_path().'\courses\\';
        
        return $file->move($path, $filename);
    }
}
