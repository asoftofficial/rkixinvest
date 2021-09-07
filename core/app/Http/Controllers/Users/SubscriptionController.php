<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Country;
use Auth;
use Laravel\Cashier\Subscription as CashierSubscription;
use Exception;
use DB;
class SubscriptionController extends CashierSubscription
{

    public function getPlans()
    {
        $plans = Plan::where(['front'=> 1, 'status' => 1])->with('magzines')->orderBy('price', 'ASC')->get();
        return view('users.subscription.plans', compact('plans'));
    }

    public function checkout(Request $request)
    {
        $plan = Plan::where(['front'=> 1, 'status' => 1])->findOrfail($request->plan_id);
        $countries = Country::orderBy('name', 'ASC')->get();
        $user = Auth::user();
        $stripeCustomer = '';
        if(!$user->stripe_id){
            $stripeCustomer = $user->createAsStripeCustomer();
        }
        $intent = $user->createSetupIntent();
        return view('users.subscription.checkout', compact('plan', 'countries', 'stripeCustomer', 'intent', 'user'));
    }
    public function subscribtion(Request $request){
        $plan = Plan::where(['front'=> 1, 'status' => 1, 'id' => $request->plan_id])->first();
        $user = Auth::user();
        DB::beginTransaction();
        try{
            $user->street1      = $request->street2;
            $user->street2      = $request->street1;
            $user->post_code    = $request->post_code;
            $user->city         = $request->city;
            $user->county       = $request->county;
            $user->country_id   = $request->country_id;
            $user->update();

            $response = $user->newSubscription("main", $plan->stripe_id)->create($request->stripe_token);
            $user->lisense()->create([
                'plan_id'  => $plan->id,
                'end_date' => date('Y-m-d', strtotime('+30 days')),
            ]);

            $user->transactions()->create([
                'amount'        => $plan->price,
                'description'   => "Buy Subscription of ".$plan->name." Plan",
                'type'          => 2
            ]);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            dd( $e->getMessage());
            //return redirect()->back()->with('error', $e->getMessage());
        }

         return redirect()->route('user.dashboard')->with('success','Your Subscription is created successfully!');

    }
    public function cancelSubscription(){
        $user = Auth::user();
        $user->subscription('main')->cancel();
        return 1;
    }
}
