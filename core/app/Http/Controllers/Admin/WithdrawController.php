<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function pending()
    {
        $pageTitle = 'Pending Withdrawals';
        $withdrawals = Withdrawal::where('status',2)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No pending withdrawal found';
        return view('admin.withdraws.pending', compact('pageTitle', 'withdrawals', 'emptyMessage'));
    }

    public function approved()
    {
        $pageTitle = 'Approved Withdrawals';
        $withdrawals = Withdrawal::where('status',1)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No approved withdrawal found';
        return view('admin.withdraws.approved', compact('pageTitle', 'withdrawals', 'emptyMessage'));
    }

    public function rejected()
    {
        $pageTitle = 'Rejected Withdrawals';
        $withdrawals = Withdrawal::where('status',3)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No rejected withdrawal found';
        return view('admin.withdraws.rejected', compact('pageTitle', 'withdrawals', 'emptyMessage'));
    }

    public function log()
    {
        $pageTitle = 'Withdrawals Logs';
        $withdrawals = Withdrawal::where('status', '!=', 0)->with(['user','method'])->orderBy('id','desc')->paginate(25);
        $emptyMessage = 'No withdrawal history';
        return view('admin.withdraws.index', compact('pageTitle', 'withdrawals', 'emptyMessage'));
    }


    public function logViaMethod($methodId,$type = null){
        $method = WithdrawalMethod::findOrFail($methodId);
        if ($type == 'approved') {
            $pageTitle = 'Approved Withdrawal Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 1)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }elseif($type == 'rejected'){
            $pageTitle = 'Rejected Withdrawals Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 3)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);

        }elseif($type == 'pending'){
            $pageTitle = 'Pending Withdrawals Via '.$method->name;
            $withdrawals = Withdrawal::where('status', 2)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }else{
            $pageTitle = 'Withdrawals Via '.$method->name;
            $withdrawals = Withdrawal::where('status', '!=', 0)->with(['user','method'])->where('method_id',$method->id)->orderBy('id','desc')->paginate(25);
        }
        $emptyMessage = 'No withdrawal found';
        return view('admin.withdraws.withdraws-via-method', compact('pageTitle', 'withdrawals', 'emptyMessage','method'));
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



        $methodImage =  getImage(imagePath()['withdraw']['method']['path'].'/'. $withdrawal->method->image,'100x100');

        return view('admin.withdraw.detail', compact('pageTitle', 'withdrawal','details','methodImage'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::where('id',$request->id)->where('status',2)->with('user')->firstOrFail();
        $withdraw->status = 1;
        $withdraw->feedback = $request->details;
        $withdraw->save();

        $general = GeneralSettings::first();
        sendEmail($withdraw->user, 'WITHDRAW_APPROVE', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'admin_details' => $request->details
        ]);

        return redirect()->route('admin.withdraw.pending')->with('success', 'Withdrawal marked as approved.');
    }


    public function reject(Request $request)
    {
        $general = GeneralSettings::first();
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::where('id',$request->id)->where('status',2)->firstOrFail();

        $withdraw->status = 3;
        $withdraw->admin_feedback = $request->details;
        $withdraw->save();

        $user = User::find($withdraw->user_id);
        $user->balance += $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->details = showAmount($withdraw->amount) . ' ' . $general->cur_text . ' Refunded from withdrawal rejection';
        $transaction->trx = $withdraw->trx;
        $transaction->save();




        sendEmail($user, 'WITHDRAW_REJECT', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => showAmount($user->balance),
            'admin_details' => $request->details
        ]);
        return redirect()->route('admin.withdraw.pending')->with('success', 'Withdrawal has been rejected.');
    }

    public function destroy($id)
    {
        $method = Withdrawal::find($id);
        $method->delete();
        return back()->with('success','Method has deleted successfully');
    }
}
