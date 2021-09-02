<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(){
        $data['pageTitle'] = "Withdrawals";
        $data['withdraws'] = auth()->user()->withdraws()->where('status', '!=', 0)->paginate(25);
        $data['emptyMessage'] = "No Data Found!";
        return view('users.withdraw.index',$data);
    }

    public function withdrawMethods(){
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

    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSettings::first();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null){
            foreach (json_decode($withdraw->method->user_data) as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'jpg','jpeg','png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);

        $user = auth()->user();

        if($withdraw->amount > $user->balance) {
            return back()->with('error', 'Your request amount is larger then your current balance.');
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if (json_decode($withdraw->method->user_data) != null) {
            foreach ($collection as $k => $v) {
                foreach (json_decode($withdraw->method->user_data) as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['information'] = $reqField;
        } else {
            $withdraw['information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        $user->balance  -=  $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->amount;
//        $transaction->post_balance = $user->balance;
//        $transaction->charge = $withdraw->charge;
        $transaction->type = 2;
        $transaction->description = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
//        $transaction->trx =  $withdraw->trx;
        $transaction->save();

        sendEmail($user, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => showAmount($user->balance),
            'delay' => $withdraw->method->delay
        ]);
        return redirect()->route('user.withdraw')->with('success', 'Withdraw request sent successfully');
    }
}
