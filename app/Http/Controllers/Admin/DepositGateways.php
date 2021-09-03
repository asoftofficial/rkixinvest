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
    public function update(Request $request, $id){
        $gateway = PaymentGateway::findOrFail($id);
        
        $parameter = [];
        $collection = collect($request);
        foreach($collection as $k => $v){
            foreach (json_decode($gateway->parameters) as $key => $cus) {
                if($k != $key) {
                    continue;
                }else{
                    $parameter[$key] = $v;
                }
            }
        }
        if($request->hasFile('image')){
            $uniqueFileName = uniqid().'_'.$request->file("image")->getClientOriginalName();
            $request->file("image")->move(public_path("uploads/paymentgateways") , $uniqueFileName);
            $gateway->image = "uploads/paymentgateways/".$uniqueFileName;
        }
        $gateway->name = $request->name;
        $gateway->min_ammount = $request->min_ammount;
        $gateway->max_ammount = $request->max_ammount;
        $gateway->charge = $request->charge;
        $gateway->charge_type = $request->charge_type;
        $gateway->parameters = $parameter;
        $gateway->update();
        return back()->with("success", "Deposite Gateway Updated Successfully!");
    }
}
