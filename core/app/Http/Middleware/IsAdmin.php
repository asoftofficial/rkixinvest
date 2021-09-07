<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class IsAdmin
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
        $user = Auth::user();
        if($user->type == 3){
            return $next($request);
        }elseif($user->type == 2){
            return redirect()->route('brand.dashboard');
        }else{
            return redirect()->route('user.dashboard');
        }

    }
}
