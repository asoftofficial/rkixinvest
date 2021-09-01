<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Client\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $deposit_amount = Transaction::where('type',1)->sum('amount');
        $withdrawal_amount = Transaction::where('type',2)->sum('amount');
        $earning =  $deposit_amount  - $withdrawal_amount ;
        //withdrawals reporting
        $withdrawals = Withdrawal::all()->count();
        $completed_withd    = Withdrawal::where('status',1)->count();
        $pending_withd    = Withdrawal::where('status',2)->count();
        $rejected_withd    = Withdrawal::where('status',3)->count();
        //users reporting
        $total_users = User::all()->count();
        $active_users = User::where('blocked',1)->count();
        //investors reporting
        $investors = Investment::where('user_id')->distinct()->get();
        dd($investors);
    	return view('admin.dashboard',compact('deposit_amount','withdrawal_amount','earning','withdrawals','completed_withd','pending_withd','rejected_withd','active_users','total_users'));
    }
    public function profile(){
    	return view('admin.profile');
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index');
    }

    public function update_profile(Request $request, $id)
    {
        $user_profile = User::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "users_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/users/');
            $full_path = '/uploads/users/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $user_profile->image = $file_path;
        }
        $user_profile->first_name   = $request->fname;
        $user_profile->last_name  = $request->lname;
        $user_profile->email      = $request->email;
         $user_profile->password =  $request->newpas;
        $user_profile->update();
        return redirect()->back()->with("success", "profile Updated Successfully!");
    }



}
