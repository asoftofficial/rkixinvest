<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckInvestments
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
        if(!empty(auth()->user())){
            //Get all active investments
            foreach(auth()->user()->investments->where('status',1)->get() as $investment){
                    //get all pending ROIs records
                    foreach($investment->rois->where('status',1)->get() as $roi){
                            //check if this user eligible for roi
                            if(Carbon::now() >= $roi->roi_date){
                                // add user balance
                                auth()->user()->balance += $roi->amount;
                                auth()->user()->update();
                                // create a transaction
                                trx(auth()->user()->id,$roi->amount,'1','ROI transferred at '.Carbon::now().' of '.$investment->package->title.' package, PID#'.$investment->id);
                                // update ROI status
                                $roi->status = 0;
                                $roi->update();
                            }
                    }
            }
        }
        return $next($request);
    }
}
