<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
class DepositController extends Controller
{
    public function index(){
        $paymentGateways = PaymentGateway::where('status',1)->get();
        return view('users.deposit.index', compact('paymentGateways'));
    }
}
