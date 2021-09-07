<?php

namespace App\Http\Controllers;

use App\Models\Referralbonus;
use Illuminate\Http\Request;

class ReferralbonusController extends Controller
{
    public function refbonus()
    {
        $referrals = Referralbonus::all();
        return view('admin.referral.index',compact('referrals'));
    }

    public function update(Request $request)
    {
        Referralbonus::query()->truncate();
        foreach($request->bonuses as $bonus){
            $ref= new Referralbonus();
            $ref->bonus = $bonus;
            $ref->save();
        }
        return back()->with('success','Referral Bonuses added successfully!');
    }
}
