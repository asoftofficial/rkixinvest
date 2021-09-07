<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Deposit;
use App\Models\DepositMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function pending()
    {
        $pageTitle = 'Pending Deposits Request';
        $deposits = Deposit::where('status',2)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No pending Deposits found';
        return view('admin.deposits.pending', compact('pageTitle', 'deposits', 'emptyMessage'));
    }

    public function approved()
    {
        $pageTitle = 'Approved Deposits';
        $deposits = Deposit::where('status',1)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No approved deposits found';
        return view('admin.deposits.approved', compact('pageTitle', 'deposits', 'emptyMessage'));
    }

    public function rejected()
    {
        $pageTitle = 'Rejected Deposits';
        $deposits = Deposit::where('status',3)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No rejected deposits found';
        return view('admin.deposits.rejected', compact('pageTitle', 'deposits', 'emptyMessage'));
    }

    public function log()
    {
        $pageTitle = 'Deposits Logs';
        $deposits = Deposit::where('status', '!=', 0)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No deposit history';
        return view('admin.deposits.index', compact('pageTitle', 'deposits', 'emptyMessage'));
    }


    public function logViaMethod($methodId,$type = null){
        $method = DepositMethod::findOrFail($methodId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Deposits Via '.$method->name;
            $deposits = Deposit::where('status', 1)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Deposits Via '.$method->name;
            $deposits = Deposit::where('status', 3)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);

        }elseif($type == 'pending'){
            $pageTitle = 'Pending Deposits Via '.$method->name;
            $deposits = Deposit::where('status', 2)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }else{
            $pageTitle = 'Deposits Via '.$method->name;
            $deposits = Deposit::where('status', '!=', 0)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }
        $emptyMessage = 'No deposit found';
        return view('admin.deposit.deposits', compact('pageTitle', 'deposits', 'emptyMessage','method'));
    }


    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $emptyMessage = 'No search result found.';

        $withdrawals = Withdrawal::with(['user', 'method'])->where('status','!=',0)->where(function ($q) use ($search) {
            $q->where('trx', 'like',"%$search%")
                ->orWhereHas('user', function ($user) use ($search) {
                    $user->where('username', 'like',"%$search%");
                });
        });

        if ($scope == 'pending') {
            $pageTitle = 'Pending Withdrawal Search';
            $withdrawals = $withdrawals->where('status', 2);
        }elseif($scope == 'approved'){
            $pageTitle = 'Approved Withdrawal Search';
            $withdrawals = $withdrawals->where('status', 1);
        }elseif($scope == 'rejected'){
            $pageTitle = 'Rejected Withdrawal Search';
            $withdrawals = $withdrawals->where('status', 3);
        }else{
            $pageTitle = 'Withdrawal History Search';
        }

        $withdrawals = $withdrawals->paginate(25);
        $pageTitle .= ' - ' . $search;

        return view('admin.withdraw.withdrawals', compact('pageTitle', 'emptyMessage', 'search', 'scope', 'withdrawals'));
    }

    public function dateSearch(Request $request,$scope){
        $search = $request->date;
        if (!$search) {
            return back();
        }
        $date = explode('-',$search);
        $start = @$date[0];
        $end = @$date[1];

        // date validation
        $pattern = "/\d{2}\/\d{2}\/\d{4}/";
        if ($start && !preg_match($pattern,$start)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.withdraw.log')->withNotify($notify);
        }
        if ($end && !preg_match($pattern,$end)) {
            $notify[] = ['error','Invalid date format'];
            return redirect()->route('admin.withdraw.log')->withNotify($notify);
        }


        if ($start) {
            $withdrawals = Withdrawal::where('status','!=',0)->whereDate('created_at',Carbon::parse($start));
        }
        if($end){
            $withdrawals = Withdrawal::where('status','!=',0)->whereDate('created_at','>=',Carbon::parse($start))->whereDate('created_at','<=',Carbon::parse($end));
        }
        if ($request->method) {
            $method = WithdrawalMethod::findOrFail($request->method);
            $withdrawals = $withdrawals->where('method_id',$method->id);
        }

        if ($scope == 'pending') {
            $withdrawals = $withdrawals->where('status', 2);
        }elseif($scope == 'approved'){
            $withdrawals = $withdrawals->where('status', 1);
        }elseif($scope == 'rejected') {
            $withdrawals = $withdrawals->where('status', 3);
        }

        $withdrawals = $withdrawals->with(['user', 'method'])->paginate(25);
        $pageTitle = 'Withdraw Log';
        $emptyMessage = 'No Withdrawals Found';
        $dateSearch = $search;
        return view('admin.withdraw.withdrawals', compact('pageTitle', 'emptyMessage', 'dateSearch', 'withdrawals','scope'));


    }

    public function details($id)
    {
        $general = GeneralSettings::first();
        $withdrawal = Withdrawal::where('id',$id)->where('status', '!=', 0)->with(['user','method'])->firstOrFail();
        $pageTitle = $withdrawal->user->username.' Withdraw Requested ' . showAmount($withdrawal->amount) . ' '.$general->cur_text;
        $details = $withdrawal->withdraw_information ? json_encode($withdrawal->withdraw_information) : null;



        $methodImage =  getImage(imagePath()['withdraw']['method']['path'].'/'. $withdrawal->method->image,'800x800');

        return view('admin.withdraw.detail', compact('pageTitle', 'withdrawal','details','methodImage'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->with('user')->firstOrFail();
        $deposit->status = 1;
        $deposit->feedback = $request->details;
        $deposit->save();
        $user = User::find($deposit->user_id);
        $user->balance += $deposit->ammount;
        $user->update();
        $general = GeneralSettings::first();
        sendEmail($deposit->user, 'DEPOSIT_APPROVE', [
            'method_name' => $deposit->method->name,
            'method_currency' => $deposit->currency,
            'method_amount' => showAmount($deposit->final_amount),
            'amount' => showAmount($deposit->amount),
            'charge' => showAmount($deposit->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($deposit->rate),
            'trx' => $deposit->trx,
            'admin_details' => $request->details
        ]);

        return redirect()->route('admin.deposit.pending')->with('success', 'Withdrawal marked as approved.');
    }


    public function reject(Request $request)
    {
        
        $general = GeneralSettings::first();
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::where('id',$request->id)->where('status',2)->firstOrFail();

        $deposit->status = 3;
        $deposit->feedback = $request->details;
        $deposit->save();

        $user = User::find($deposit->user_id);



        sendEmail($user, 'DEPOSIT_REJECT', [
            'method_name' => $deposit->method->name,
            'method_currency' => $deposit->currency,
            'method_amount' => showAmount($deposit->final_amount),
            'amount' => showAmount($deposit->amount),
            'charge' => showAmount($deposit->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($deposit->rate),
            'trx' => $deposit->trx,
            'post_balance' => showAmount($user->balance),
            'admin_details' => $request->details
        ]);
        return redirect()->route('admin.deposit.pending')->with('success', 'Deposit has been rejected.');
    }
}
