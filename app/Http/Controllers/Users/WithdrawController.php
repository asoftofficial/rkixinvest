<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(){
        $data['pageTitle'] = "Withdraw Amount";
        $data['methods'] = WithdrawalMethod::where('status',1)->get();
        return view('users.withdraw.methods',$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $pageTitle = "Withdraw Amount";
        $method = WithdrawalMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        if ($request->amount < $method->min_limit) {
            return back()->with('error', 'Your requested amount is smaller than minimum amount.');
        }
        if ($request->amount > $method->max_limit) {
            return back()->with('error', 'Your requested amount is larger than maximum amount.');
        }

        if ($request->amount > $user->balance) {
            return back()->with('error', 'You do not have sufficient balance for withdraw.');
        }


        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('user.withdraw.preview');
    }

    public function preview()
    {
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        return view('users.withdraw.preview', compact('pageTitle','withdraw'));
    }
}
