<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    public function index(){
        $data['emptyMessage'] = 'Withdrawal Methods not found.';
        $data['methods'] = WithdrawalMethod::orderBy('status','desc')->orderBy('id')->get();
        return view('admin.withdraw.index', $data);
    }

    public function create(){
        $pageTitle = 'New Withdrawal Method';
        return view('admin.withdraw.create', compact('pageTitle'));
    }

    public function activate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $method = WithdrawalMethod::findOrFail($request->id);
        $method->status = 1;
        $method->save();
        $notify[] = ['success', $method->name . ' has been activated.'];
        return redirect()->route('admin.withdraw.method.index')->withNotify($notify);
    }

    public function deactivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $method = WithdrawalMethod::findOrFail($request->id);
        $method->status = 0;
        $method->save();
        $notify[] = ['success', $method->name . ' has been deactivated.'];
        return redirect()->route('admin.withdraw.method.index')->withNotify($notify);
    }
}
