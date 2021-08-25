<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralbonusController extends Controller
{
    public function refbonus()
    {
        return view('admin.referral.index');
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
