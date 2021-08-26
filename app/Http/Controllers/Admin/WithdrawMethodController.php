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
}
