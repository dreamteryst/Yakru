<?php

namespace App\Http\Controllers\Admin;

use App\Example;
use App\Http\Controllers\Controller;
use App\Question;
use App\Choice;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ExampleController extends Controller
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
        $dataExample = [
            'example_type' => $request->example_type,
            'course_id' => $request->course_id,
        ];
        $example = Example::create($dataExample);
        if ($example) {
            foreach ($request->question as $question) {
                $dataQuestion = [
                    'example_id' => $example->id,
                    'question' => $question['question'],
                    'ans' => $question['ans'],
                ];
                $questionModel = Question::create($dataQuestion);
                if($questionModel) {
                    foreach($question['choice'] as $choice) {
                        $dataChoice = [
                            'question_id' => $questionModel->id,
                            'text' => $choice['text']
                        ];
                        $choiceModel = Choice::create($dataChoice);
                        if(!$choiceModel) {
                            return response('failed', 500);
                        }
                    }
                }
            }
        }
        return "Success";

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function show(Example $example)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function edit(Example $example)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Example $example)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function destroy(Example $example)
    {
        //
    }

    public function anyData()
    {
        return Datatables::of(Example::query())
        ->addColumn('course', function($example){
            return $example->course->course_name;
        })
        ->make(true);
    }
}
