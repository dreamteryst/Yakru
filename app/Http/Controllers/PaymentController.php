<?php

namespace App\Http\Controllers;

use Auth;
use App\Payment;
use App\Topup;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'transferred_at' => 'required',
            'amount' => 'required',
            'slip' => 'required'
        ]);

        $dataTopup = [
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'method' => 'transfer'
        ];
        $topup = Topup::create($dataTopup);

        $slip = $request->slip->store('slips');
        $dataPayment = [
            'bank_id' => $request->bank_id,
            'topup_id' => $topup->id,
            'user_id' => Auth::user()->id,
            'transferred_at' => Carbon::createFromFormat('d/m/Y H:i', $request->transferred_at),
            'amount' => $request->amount,
            'slip' => $slip
        ];
        $payment = Payment::create($dataPayment);
        if($payment)
        {
            return $payment;
        } else {
            return response('failed', 500);
        }
    }
}
