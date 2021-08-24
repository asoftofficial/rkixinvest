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
            //Get all investments
            foreach(auth()->user()->investments as $investment){
                //check if investment is active
                if($investment->status==1){
                    //get all ROIs records
                    foreach($investment->rois as $roi){
                        //check if ROI is pendding
                        if($roi->status==1){
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
            }
        }
        return $next($request);
    }
}
