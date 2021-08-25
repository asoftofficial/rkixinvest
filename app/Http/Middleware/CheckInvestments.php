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
            foreach(auth()->user()->investments->where('status',1) as $investment){
                    //get all pending ROIs records
                    foreach($investment->rois->where('status',1) as $roi){
                            //check if this user eligible for roi
                            if(Carbon::now() >= $roi->roi_date){
                                //count total rois
                                $totalROIs = $investment->rois->where('status',1)->count();
                                // add user balance
                                auth()->user()->balance += $roi->amount;
                                auth()->user()->update();
                                // create a transaction
                                trx(auth()->user()->id,$roi->amount,'1','ROI transferred at '.Carbon::now().' of '.$investment->package->title.' package, PID#'.$investment->id);
                                // update ROI status
                                $roi->status = 0;
                                $roi->update();

                                // Update Investment and return if rois completed
                                if($totalROIs==1){
                                    //update investment status
                                    $investment->status = 0;
                                    $investment->update();
                                    //update user balance
                                    auth()->user()->balance += $investment->amount;
                                    auth()->user()->update();
                                    // create a transaction
                                    trx(auth()->user()->id,$investment->amount,'1','Investment Return at '.Carbon::now().' of '.$investment->package->title.' package, PID#'.$investment->id);
                                }

                            }
                    }
            }
        }
        return $next($request);
    }
}
