<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hello world";
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
            'category_name' => 'required|max:200',
            'category_description' => 'required'
            
        ]);
        $category = new Category();

        return $category::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data =  $request->validate([
            'category_name' => 'required|max:200',
            'category_description' => 'required'
            
        ]);
        
        if($category->update($data)){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $category->category_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $category->category_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    public function anyData()
    {
        return Datatables::of(Category::query())->make(true);
    }

}
