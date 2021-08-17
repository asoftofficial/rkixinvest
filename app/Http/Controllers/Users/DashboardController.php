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

    public function user_profile()
    {
        $user = User::find(auth::user()->id);
        return view('users.profile.index',compact('user'));
    }
    public function update_profile(Request $request, $id)
    {
        // dd($request->newpas);
        //     $this->validate($request,[
        //         'newpas' => 'required|confirmed',
        //     ]);

         $user_profile = User::findOrFail($id);
        // if($request->hasFile('image')){
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $fileName = "packages_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        //     $upload_path = public_path('uploads/packages/');
        //     $full_path = '/uploads/packages/'.$fileName;
        //     $check = $request->file('image')->move($upload_path, $fileName);
        //     // $packages->file_path  = $full_path;
        // }

        $user_profile->first_name   = $request->fname;
        $user_profile->last_name  = $request->lname;
        $user_profile->email      = $request->email;
         $user_profile->password =  $request->newpas;
        $user_profile->update();
        return redirect()->back()->with("success", "profile Updated Successfully!");
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
public function resendCode()
{
    $data = User::find(Auth::user()->id);
    $code = $data->email_verification_code;
   sendEmailVerificationCode($data,$code);
   return back()->with('success', 'code send successfully');
}

}
