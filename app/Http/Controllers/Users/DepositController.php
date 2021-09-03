<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepositMethod;
use App\Models\Deposit;
class DepositController extends Controller
{
    public function index(){
        $data['pageTitle'] = "Withdrawals";
        $data['deposits'] = auth()->user()->deposits()->where('status', '!=', 0)->paginate(25);
        $data['emptyMessage'] = "No Data Found!";
        return view('users.deposit.index',$data);
    }
    public function depositMethods(){
        $data['pageTitle'] = "Deposit Amount";
        $data['methods'] = DepositMethod::where('status',1)->get();
        return view('users.deposit.methods',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $pageTitle = "Withdraw Amount";
        $method = DepositMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        if ($request->amount < $method->min_limit) {
            return back()->with('error', 'Your requested amount is smaller than minimum amount.');
        }
        if ($request->amount > $method->max_limit) {
            return back()->with('error', 'Your requested amount is larger than maximum amount.');
        }



        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount + $charge;
        $finalAmount = $afterCharge * $method->rate;

        $deposit = new Deposit();
        $deposit->method_id = $method->id; // wallet method ID
        $deposit->user_id = $user->id;
        $deposit->amount = $request->amount;
        $deposit->currency = $method->currency;
        $deposit->rate = $method->rate;
        $deposit->charge = $charge;
        $deposit->final_amount = $finalAmount;
        $deposit->after_charge = $afterCharge;
        $deposit->trx = getTrx();
        $deposit->save();
        session()->put('wtrx', $deposit->trx);
        return redirect()->route('user.deposit.preview');
    }
    public function preview()
    {
        $deposit = Deposit::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Deposit Preview';

        return view('users.deposit.preview', compact('pageTitle','deposit'));
    }
    public function payNow(){
        $deposit = Deposit::with('method')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        if($deposit->method->method_code){
            $xx = 'g' . $deposit->method->method_code;
            $new =  __NAMESPACE__ . '\\' . $xx . '\\ProcessController';

            $data =  $new::process($deposit);
            $data =  json_decode($data);


            if (isset($data->error)) {
                session()->flash('danger',$data->message);
                return redirect()->route('payment');
            }
            if (isset($data->redirect)) {
                return redirect($data->redirect_url);
            }
            $page_title = 'Payment Confirm';
            return view( $data->view, compact('data', 'page_title','deposit'));
        }

    }
    public static function userDataUpdate()
    {
        $general = GeneralSettings::first();
        $deposit = Deposit::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $user = auth()->user();
        $deposit->status = 1;
        $deposit->save();
        $user->balance  +=  $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $deposit->user_id;
        $transaction->amount = $deposit->amount;
        $transaction->type = 1;
        $transaction->description = showAmount($deposit->final_amount) . ' ' . $deposit->currency . ' Withdraw Via ' . $deposit->method->name;
        $transaction->save();

        sendEmail($user, 'SUCCESSFULLY ADDED DEPOSIT', [
            'method_name' => $deposit->method->name,
            'method_currency' => $deposit->currency,
            'method_amount' => showAmount($deposit->final_amount),
            'amount' => showAmount($deposit->amount),
            'charge' => showAmount($deposit->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($deposit->rate),
            'trx' => $deposit->trx,
            'post_balance' => showAmount($user->balance),
            'delay' => $deposit->method->delay
        ]);
        return redirect()->route('user.deposit')->with('success', 'Your Account has deposited successfully');
    }
}
