<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSettings;
use App\Models\Referral;
use App\Models\Referralbonus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Investment;
use App\Models\Plan;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        $data['investments'] = Auth::user()->investments;
        return view('users.dashboard',$data);
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

    public function user_profile()
    {
        $user = User::find(auth::user()->id);
        return view('users.profile.index',compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $user_profile = User::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "users_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/users/';
            $full_path = '/uploads/users/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $user_profile->image = $file_path;
        }
        $user_profile->first_name   = $request->fname;
        $user_profile->last_name  = $request->lname;
        $user_profile->email      = $request->email;
        $user_profile->update();
        return redirect()->back()->with("success", "profile Updated Successfully!");
    }

    public function changePassword(Request $request)
    {
       $request->validate([
        'old_pass' => 'required',
        'new_pass' => 'required',
        'confirm'=>'required',
       ]);

        $user = auth()->user();
         if(Hash::check($request->old_pass,$user->password)){
            return back()->with('error','Invalid Old Password');
        }
        if(Hash::check($request->new_pass,$user->password)){
            return back()->with('error','You can not use your old password');
        }
        if($request->new_pass !== $request->confirm){
            return back()->with('error','Password does not match');
        }
       $user->password = bcrypt($request->new_pass);
       $user->update();
       return back()->with('success','password updated successfully');
    }
    public function userPassword(Request $request,$id)
    {

       $request->validate([
        'old_pass' => 'required',
        'new_pass' => 'required',
        'confirm'=>'required',
       ]);

        $user = User::find($id);
         if(!Hash::check($request->old_pass,$user->password)){
            return back()->with('error','Invalid Old Password');
        }
        if(Hash::check($request->new_pass,$user->password)){
            return back()->with('error','You can not use your old password');
        }
        if($request->new_pass !== $request->confirm){
            return back()->with('error','Password does not match');
        }
       $user->password = bcrypt($request->new_pass);
       $user->update();
       return back()->with('success','password updated successfully');
    }
    public function showVerificationForm()
    {
      return view('auth.email-verify');
    }

    public  function checkVerificationForm(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|min:6'
        ]);
        $user  = User::where('email_verification_code',$request->code)->first();
        $code   = $user->email_verification_code;
        if($request->code !== $code){
            return back()->with('error','Invalid verification code');
        }
       if(empty($user)){
           return redirect(route('register'))->with('errors','invalid url');
       }else{
           if($user->email_verified==1){
            return redirect(route('register'))->with('errors','email already verified');
           }else{
            $user->update([
            'email_verified_at' => \carbon\carbon::now(),
            'email_verification_code' => NULL,
            'email_verified' => 1
            ]);
            return redirect(route('login'))->with('err','Email successfully verified');
           }
       }
    }

    //resend verification code via email
    public function resendCode()
    {
        $user = User::find(Auth::user()->id);
        $code = $user->email_verification_code;
        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        sendEmail($user, 'RESEND_CODE', [
            'operating_system' => $userBrowser['os_platform'],
            'browser' => $userBrowser['browser'],
            'ip' => $userIpInfo['ip'],
            'time' => Carbon::now(),
            'code' => $code,
        ]);
        Session::flash("message", "Verification code has sent check.Please your email");
        return back()->with('success', 'Code send successfully');
    }

    public function referrals(Request $request){

        $data['levels'] = Referralbonus::all();
        if(!empty($request->level)){
            $data['referrals'] = auth()->user()->referrals()->where('level',$request->level)->paginate(25);
            $data['pageTitle'] = "Level ".$request->level." Referrals";
        }else{
            $data['referrals'] = auth()->user()->referrals()->paginate(25);
            $data['pageTitle'] = "All Referrals";
        }
        $data['emptyMessage'] = "No Referral found";
        return view('users.referrals.index',$data);
    }

    public function transfer(){
        if(!isOn('fund_transfer')){
            return redirect()->route('user.dashboard')->with('error','This module is currently not available');
        }
        $data['pageTitle'] = "Transfer Funds";
        return view('users.transfer.transfer',$data);
    }

    public function transferPost(Request $request){
        if(!isOn('fund_transfer')){
            return redirect()->route('user.dashboard')->with('error','This module is currently not available');
        }
        $settings = GeneralSettings::first();
        $request->validate([
            'amount' => 'required|integer|min:'.$settings->min_transfer.'|max:'.$settings->max_transfer,
            'code' => 'required',
            'receiver' => 'required'
        ]);
        $user = auth()->user();
        if($request->code!==$user->trx_code){
            return back()->with('error','Invalid transaction code');
        }
        if($request->amount > $user->balance){
            return back()->with('error','Insufficient balance to transfer');
        }
        if($request->receiver==$user->username){
            return back()->with('error','You can not transfer amount to yourself');
        }
        $receiver = User::where('username',$request->receiver)->first();
        if(!$receiver){
            return back()->with('error','Receiver not found');
        }
        //calculate amount
        $charges = $settings->transfer_charges / 100 * $request->amount ;
        $amount = $request->amount - $charges;
        // deduct amount
        $user->balance -= $request->amount;
        $user->update();
        // add amount to receiver balance
        $receiver->balance +=$amount;
        $receiver->update();

        //add sender's transaction
        trx($user->id, $amount,2,'Transfer '.$request->amount.' USD'.' to '.$receiver->username.' at '.Carbon::now(),'transferred');
        //add receiver's transaction
        trx($receiver->id, $amount,1,'Received '.$amount.' USD'.' from '.$user->username.' at '.Carbon::now(),'received');
        //send mail to receiver
            sendEmail($receiver, 'Fund_ADD', [
                'charges' => $charges,
                'amount' => $amount,
                'total_amount' => $request->amount,
                'total_balance'=> $receiver->balance,
                'sender' => $user->username,
            ]);
        //Send mail to sender
         sendEmail($user, 'Fund_SUB', [
                'total_amount' => $request->amount,
                'total_balance'=> $user->balance,
                'receiver' => $receiver->username,
            ]);
        return back()->with('success','Fund Transferred to '.$receiver->username);

    }

    //transfercode view
    public function transfercode()
    {
        return view('users.profile.update-trx-code');
    }

    //update transfer code
    public function updateTransferCode(Request $request)
    {
        $request->validate([
            'oldtrx' => 'required',
            'newtrx' => 'required',
            'confirm' =>'required',
        ]);

        $user = User::find(Auth::user()->id);
        $trx_code = $user->trx_code;

        if($trx_code !== $request->oldtrx){
            return back()->with('error','Please Enter the Old Code');
        }
        if($trx_code == $request->newtrx){
            return back()->with('error','Please Enter The New Code');
        }
        if($request->newtrx != $request->confirm){
            return back()->with('error','Password Does Not Match');
        }

        $user->trx_code = $request->newtrx;
        $user->update();
        return back()->with('success','Transaction code Updated');

    }

}
