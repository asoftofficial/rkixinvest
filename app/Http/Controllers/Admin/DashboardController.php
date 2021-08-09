<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\GeneralSettings;
use App\Models\Magazine;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLicense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['collections'] 	= Collection::where('status', 1)->get();
        $data['plans'] = Plan::all();
        $data['magazines'] = Magazine::all();
        $data['ordersCount'] = UserLicense::count();
        $data['earning'] = Transaction::where('type',2)->sum('amount');
        $data['settings'] = GeneralSettings::first();
 
    	return view('admin.dashboard',$data);
    }
    public function profile(){
    	return view('admin.profile');
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index');
    }
}
