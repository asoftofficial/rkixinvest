<?php

namespace App\Http\Controllers\Users\g111;

use App\Deposit;
use App\Http\Controllers\Users\DepositController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use StripeJS\StripeJS;
use Auth;
use Session;

require_once('stripe-php/init.php');

class ProcessController extends Controller
{

    /*
     * StripeJS Gateway
     */
    public static function process($deposit)
    {

        $StripeJSAcc = json_decode($deposit->method->parameters);
        $val['key'] = $StripeJSAcc->publishable_key;
        $val['name'] = Auth::user()->username;
        $val['description'] = "Payment with Stripe";
        $val['amount'] = $deposit->final_amount * 100;
        $val['currency'] = $deposit->currency;
        $send['val'] = $val;
        $send['src'] = "https://checkout.stripe.com/checkout.js";
        $send['view'] = 'users.deposit.payment.stripe';
        $send['method'] = 'post';
        $send['url'] = route('g111');
        return json_encode($send);
    }

    /*
     * StripeJS js ipn
     */
    public function ipn(Request $request)
    {
        $data = Deposit::with('method')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        if ($data->status == 1) {
            session()->flash('danger','Invalid Request.');
        }
        $StripeJSAcc = json_decode($data->method->parameters);

        StripeJS::setApiKey($StripeJSAcc->secret_key);

        $customer = \StripeJS\Customer::create([
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken,
        ]);


        $charge = \StripeJS\Charge::create([
            'customer' => $customer->id,
            'description' => 'Payment with Stripe',
            'amount' => $data->final_amo * 100,
            'currency' => $data->method_currency,
        ]);


        if ($charge['status'] == 'succeeded') {
            DepositController::userDataUpdate($data->trx);
            session()->flash('success','Transaction was successful.');
        }
        return redirect()->route('payment');
    }
}
