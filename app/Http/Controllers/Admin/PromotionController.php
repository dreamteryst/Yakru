<?php

namespace App\Http\Controllers\Admin;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class PromotionController extends Controller
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
        $data = $request->validate([
            'promotion_name' => 'required',
            'promotion_description' => 'required',
            'discount' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required'
        ]);
        
        $Promotion = new Promotion();

        return $Promotion::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'promotion_name' => 'required',
            'promotion_description' => 'required',
            'discount' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required'
        ]);

        if($promotion->update($data)){
            return json_encode(['success' => true, 'message' => 'อัพเดทข้อมูล ' . $promotion->promotion_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if($promotion->delete()){
            return json_encode(['success' => true, 'message' => 'ลบข้อมูล ' . $promotion->promotion_name . ' เรียบร้อย']);
        }
        return json_encode(['success' => false, 'message' => 'มีข้อผิดพลาดไม่คาดคิด']);
    }

    public function anyData()
    {
        return Datatables::of(Promotion::with('course'))
        ->make(true);
    }
}
