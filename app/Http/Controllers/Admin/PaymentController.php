<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Payment;
use App\Topup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class PaymentController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function anyData()
    {
        return Datatables::of(Payment::query())
        ->addColumn('account_no', function($payment){
            return $payment->bank->account_no;
        })
        ->addColumn('bank_name', function($payment){
            return $payment->bank->bank_name;
        })
        ->addColumn('fullname', function($payment){
            return $payment->user->firstname.' '.$payment->user->lastname;
        })
        ->make(true);
    }

    public function confirm(Request $request, $mode)
    {
        $request->validate([
            'payment_id' => 'required'
        ]);
        
        $payment = Payment::find($request->payment_id);
        $payment->status = $mode == 2 ? 'unpaid' : 'paid';
        $topup = Topup::find($payment->topup_id);
        $topup->status = $mode == 2 ? 'unpaid' : 'paid';
        $user = User::find($payment->user_id);
        $user->money = $payment->status == 'paid' ? $user->money += $payment->amount : $user->money -= $payment->amount;
        if($topup->save() && $payment->save() && $user->save())
        {
            return $topup;
        } else {
            return response('failed', 500);
        }
    }
}
