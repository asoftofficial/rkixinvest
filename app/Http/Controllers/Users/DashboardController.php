<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\User;
use Hash;
class DashboardController extends Controller
{
    public function index(){
        $now = Carbon::now()->toDateString();
        return view('users.dashboard');
    }

    public function savedArticles (Request $request){
        $data['collections'] 	= Collection::where('status', 1)->get();
        if($request->collection){
            $collection_id = $request->collection;
            $data['savedArticles']  = Auth::user()->savedArticles()->whereHas('issue', function($q) use ($collection_id){
                $q->where('collection_id', $collection_id);
            })->get();

        }else{
            $data['savedArticles']  = Auth::user()->savedArticles()->with('issue')->get();
        }

        $data['issues'] = Issue::orderBy('id', 'DESC')->get();
        return view('users.savedArticles',$data);
    }
    public function account(){
        $data['countries'] = Country::all();
        $data['plans'] =  Plan::where(['front'=> 1, 'status' => 1])->with('magzines')->orderBy('price', 'ASC')->get();
        $data['userSubscription'] = Auth::user()->subscription('main');

        return view('users.account',$data);
    }
    public function updateAccount(Request $request){
        $user = Auth::user();
        if($request->update_type == 1){
            $user->gender       = $request->gender;
            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->dob          = date('Y-m-d', strtotime($request->dob));
            $msg = 'Account Information Updated Successfully!';
        }elseif($request->update_type == 2){

            $user->country_id = $request->country_id;
            $user->street1 = $request->street1;
            $user->street2 = $request->street2;
            $user->post_code = $request->post_code;
            $user->country_id = $request->country_id;
            $user->city = $request->city;
            $msg = 'Billing Information Updated Successfully!';
        }elseif($request->update_type == 3){
            if(Hash::check($request->oldPassword, $user->password)){
                $user->password = Hash::make($request->password);
                $msg = 'Password Updated Successfully!';
            }else{
                return redirect()->back()->with('error', 'Your old password is incorrect!');
            }
        }
        $user->update();
        return redirect()->back()->with('success', $msg);
    }

}
