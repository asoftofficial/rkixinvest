<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
class DashboardController extends Controller
{
    public function index(){
        $now = Carbon::now()->toDateString();
        return view('users.dashboard');
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
