<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $sociallinks = SocialLink::first();
        $aboutus = Homepage::first();
        $data = Homepage::first();
        $testimonials = Testimonial::all();
        $slider = Slider::first();
        $withdrawals = Withdrawal::with(['user','method'])->orderBy('id','desc')->paginate(10);
        // $deposit = Transaction::where('trx_type','deposit')->get();
        $emptyMessage = "No withdraws found";
        return view('front.index',compact('sociallinks','aboutus','data','testimonials','slider','withdrawals','emptyMessage'));
    }
}
