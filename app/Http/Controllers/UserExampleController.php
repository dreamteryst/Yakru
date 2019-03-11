<?php

namespace App\Http\Controllers;

use App\Example;
use App\UserExample;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserExampleController extends Controller
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
            'example_id' => 'required',
            'answers' => 'required|array',
            'started_at' => 'required',
        ]);
        $example = Example::where('id', $request->example_id)->with(['question.choice'])->first();
        $point = 0;
        foreach ($example->question as $index => $question) {
            if (!empty($request->answers[$question->id]) &&
                $request->answers[$question->id] == $question->choice->get($question->ans - 1)['text']) {
                $point++;
            }
        }
        $data = [
            'example_id' => $request->example_id,
            'answers' => $request->answers,
            'started_at' => $request->started_at,
            'ended_at' => Carbon::now(),
            'point' => $point,
        ];

        $userExample = UserExample::create($data);
        if ($userExample) {
            return $userExample;
        } else {
            return response('failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserExample  $userExample
     * @return \Illuminate\Http\Response
     */
    public function show(UserExample $userExample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserExample  $userExample
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExample $userExample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserExample  $userExample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExample $userExample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserExample  $userExample
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExample $userExample)
    {
        //
    }
}
