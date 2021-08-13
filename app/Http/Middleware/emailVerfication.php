<?php

namespace App\Http\Middleware;

use App\Models\GeneralSettings;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class emailVerfication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
            $settings =  GeneralSettings::first();
            $user = Auth::user();
            if($settings->email_verification == 'on'){
                // dd($user->email_verified);
                    if($user->email_verified == 1){
                        return $next($request);
                    }else{
                        Auth::logout();
                        return back()->with('err','Please verify you email');
                    }
            }else{
                // dd("lo mein a gya");
                return $next($request);
        }

    }
}
