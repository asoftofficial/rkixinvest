<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
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
