<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Atuh;
class IsBrand
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
        if($user->type == 2){
            return $next($request);
        }elseif($user->type == 3){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('user.dashboard');
        }
    }
}
