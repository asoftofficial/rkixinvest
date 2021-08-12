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
            $settings =  new GeneralSettings();
            $user = Auth::user();
            if($settings->email_verification == 'on'){
                    if($user->verified_user == 0){
                        return $next($request);
                    }else{
                        return redirect()->route('login')->with('errors','something wnet wrong');

                    }
            }else{
                return $next($request);
        }

    }
}
