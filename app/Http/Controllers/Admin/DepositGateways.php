<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
class DepositGateways extends Controller
{
    public function index(){
        $paymentGateways = PaymentGateway::all();
        return view('admin.settings.depositGateways.index', compact('paymentGateways'));
    }
    public function edit($id){
        $paymentGateway = PaymentGateway::findOrFail($id);
        return view('admin.settings.depoitGateways.edit', compact('paymentGateway'));
    }
}
