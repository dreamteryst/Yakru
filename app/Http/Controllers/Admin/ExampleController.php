<?php

namespace App\Http\Controllers\Admin;

use App\Choice;
use App\Example;
use App\Http\Controllers\Controller;
use App\Question;
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
            'time_limit' => $request->time_limit,
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
                if ($questionModel) {
                    foreach ($question['choice'] as $choice) {
                        $dataChoice = [
                            'question_id' => $questionModel->id,
                            'text' => $choice['text'],
                        ];
                        $choiceModel = Choice::create($dataChoice);
                        if (!$choiceModel) {
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
    public function show(Request $request, $id)
    {
        $examples = Example::where('id', $id)->with('question.choice')->first();
        $examples->question->each(function ($question) {
            $question->makeVisible(['ans']);
        });
        return $examples;
    }

    public function course(Request $request, $id)
    {
        return Example::where('course_id', $id)->with('question.choice')->get()->each(function ($exam) {
            $exam->question->each(function ($question) {
                $question->makeVisible(['ans']);
            });
        });
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
        $dataExample = [
            'example_type' => $request->example_type,
            'course_id' => $request->course_id,
            'time_limit' => $request->time_limit,
        ];
        if ($example->update($dataExample)) {
            $question = Question::where('example_id', $example->id)->get();
            $question->each(function ($item) {
                $choice = Choice::where('question_id', $item->id)->delete();
                $item->delete();
            });

            foreach ($request->question as $question) {
                $dataQuestion = [
                    'example_id' => $example->id,
                    'question' => $question['question'],
                    'ans' => $question['ans'],
                ];
                $questionModel = Question::create($dataQuestion);
                if ($questionModel) {
                    foreach ($question['choice'] as $choice) {
                        $dataChoice = [
                            'question_id' => $questionModel->id,
                            'text' => $choice['text'],
                        ];
                        $choiceModel = Choice::create($dataChoice);
                        if (!$choiceModel) {
                            return response('failed', 500);
                        }
                    }
                }
            }
        }
        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Example  $example
     * @return \Illuminate\Http\Response
     */
    public function destroy(Example $example)
    {
        $question = Question::where('example_id', $example->id)->get();
        $question->each(function ($item) {
            $choice = Choice::where('question_id', $item->id)->delete();
            $item->delete();
        });
        if ($example->delete()) {
            return "success";
        } else {
            return response('failed', 500);
        }
    }

    public function jsonData(Request $request, $id)
    {
        $user_id = $request->user()->id;
        return Example::where('id', $id)->where('type', $request->type)->with('question.choice')
            ->whereHas('course', function ($query) use ($user_id) {
                $query->whereHas('userCourse', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                });
            })
            ->first();
    }

    public function anyData()
    {
        return Datatables::of(Example::query())
            ->addColumn('course', function ($example) {
                return $example->course->course_name;
            })
            ->make(true);
    }
}
