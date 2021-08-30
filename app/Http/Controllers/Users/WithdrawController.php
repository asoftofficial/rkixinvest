<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(){
        $data['pageTitle'] = "Withdraw Amount";
        $data['methods'] = WithdrawalMethod::where('status',1)->get();
        return view('users.withdraw.methods',$data);
    }
}
