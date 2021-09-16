<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSettings;
use App\Models\Investment;
use App\Models\Slider;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $deposit_amount = showAmount(Transaction::where('type',1)->sum('amount'),2);
        $withdrawal_amount = showAmount(Transaction::where('type',2)->sum('amount'),2);
        $withdrawals = Withdrawal::all()->count();
        $completed_withd    = Withdrawal::where('status',1)->count();
        $pending_withd    = Withdrawal::where('status',2)->count();
        $pending_amount    = Withdrawal::where('status',2)->sum('amount');
        $rejected_withd    = Withdrawal::where('status',3)->count();
        //users reporting
        $total_users = User::all()->count();
        $active_users = User::where('blocked',1)->count();
        //investors reporting
        $investors = Investment::select('user_id')->distinct()->get()->count();
        $active_investors = Investment::select('user_id')->where('status',1)->distinct()->get()->count();
        //investments
        $active_investments = Investment::where('status',1)->with(['rois'])->get();
        //getting total deposits records
        $total_deposits = Deposit::all()->count();
        $completed_deposits = Deposit::where('status',1)->count();
        $pending_deposits = Deposit::where('status',2)->count();
        $canceled_deposits = Deposit::where('status',3)->count();
    	return view('admin.dashboard',compact('pending_amount','canceled_deposits','pending_deposits','completed_deposits','total_deposits','deposit_amount','withdrawal_amount','withdrawals','completed_withd','pending_withd','rejected_withd','active_users','total_users','investors','active_investors','active_investments'));
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
            $request->validate([
            'image' => 'image|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
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
         $user_profile->password =  $request->newpas;
        $user_profile->update();
        return redirect()->back()->with("success", "profile Updated Successfully!");
    }

    public function viewProfile()
    {
        return view('admin.profile.admin-profile');
    }

    public function editProfile($id)
    {
        $admin = User::find($id);
        return view('admin.profile.modals.edit-profile');
    }

    public function slider()
    {
        $slider = Slider::first();
        return view('admin.Slider.edit',compact('slider'));
    }
    //update slider
    public function updateSlider(Request $request)
    {
        $slider = Slider::first();
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image'
            ]);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "slider_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/slider/';
            $full_path = '/uploads/slider/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $slider->image = $file_path;
        }
        $slider->button_text = $request->button_text;
        $slider->link  = $request->link;
        $slider->slider_content = $request->description;
        $slider->update();
        return back()->with('success','Slider Updated Successfully');
    }

}
