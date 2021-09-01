<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Country;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Plan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function newdashboard()
    {
        return view('frontend.dashboard.index');
    }

    public function search(){
        return view('users.search');
    }

    public function admindashboard(){
        return view('backend.index');
    }

    public function adminplans(){
        return view('backend.plans.index');
    }

    public function adminplandetails(){
        return view('backend.plans.details');
    }

    public function admincollections(){
        return view('backend.collections.index');
    }

    public function adminbanner(){
        return view('backend.banners.index');
    }

    public function admincustomers(){
        return view('backend.customers.index');
    }

    public function adminissues(){
        return view('backend.issues.index');
    }

    public function adminpromotions(){
        return view('backend.promotions.index');
    }

    public function adminProfile(){
        return view('backend.profile');
    }

}
