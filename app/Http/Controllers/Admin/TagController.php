<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class TagController extends Controller
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
        $data =  $request->validate([
            'tag_name' => 'required|max:200'
        ]);
        $Tag = new Tag();

        return $Tag::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $data =  $request->validate([
            'tag_name' => 'required|max:200',
        ]);
        
        if($tag->update($data)){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $tag->tag_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->delete()){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $tag->tag_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }
    public function anyData()
    {
        return Datatables::of(Tag::query())->make(true);
    }
}
