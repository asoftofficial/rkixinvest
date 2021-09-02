<?php

namespace App\Http\Controllers;
use App\Models\Investment;
use App\Models\Package;
use App\Models\Referralbonus;
use App\Models\Roi;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    public function invest(Request $request)
    {
        $package = Package::findOrFail($request->packageId);
        $user = User::find(Auth::user()->id);
        if($user->balance < $request->amount){
            return back()->with('error','Insufficient balance to invest.');
        }
        if($request->amount >= $package->min_invest && $request->amount <= $package->max_invest){
            // Create Investment
             $investment = new Investment;
             $investment->user_id = $user->id;
             $investment->package_id = $package->id;
             $investment->amount = $request->amount;
             $investment->status = 1;
             $investment->save();

             // Create Transaction
             trx(Auth::user()->id,$investment->amount,'2','Invested in '.$investment->package->title.' package with '.$investment->amount.'$ at '.$investment->created_at,'investment');

            //send email to notify the user
            sendEmail($user, 'INVESTMENT', [
                'package' => $package->title,
                'amount' => $request->amount,
                ]);
            //Create ROIs record
            $now = Carbon::now();
            $enddate = Carbon::now();
            $enddate = getdays($now,$enddate,$package->duration,$package->duration_type);
            $days = $now->diffInDays($enddate);
            $totalroi = ($package->roi/100) * $request->amount;
            if($package->roi_type=="daily"){
                $period = CarbonPeriod::create($now, $enddate);
                foreach($period as $date){
                    if($date==$now){
                        continue;
                    }
                    $roi = new Roi();
                    $roi->user_id = $user->id;
                    $roi->investment_id = $investment->id;
                    $roi->status = 1;
                    $roi->amount = $totalroi/$days;
                    $roi->roi_date = $date;
                    $roi->save();
                }
            }elseif($package->roi_type=="weekly"){
                $date = $now;
                $weeks = $now->diffInWeeks($enddate);
                for($i = 1; $i <= $weeks; $i++){
                    $date = $date->addWeek();
                    $roi = new Roi();
                    $roi->user_id = $user->id;
                    $roi->investment_id = $investment->id;
                    $roi->status = 1;
                    $roi->amount = $totalroi/$weeks;
                    $roi->roi_date = $date;
                    $roi->save();
                }
            }elseif($package->roi_type=="monthly"){
                $date = $now;
                $months = $now->diffInMonths($enddate);
                for($i = 1; $i <= $months; $i++){
                    $date = $date->addMonth();
                    $roi = new Roi();
                    $roi->user_id = $user->id;
                    $roi->investment_id = $investment->id;
                    $roi->status = 1;
                    $roi->amount =$totalroi/$months;
                    $roi->roi_date = $date;
                    $roi->save();
                }
            }else{
                $date = $now;
                $years = $now->diffInYears($enddate);
                for($i = 1; $i <= $years; $i++){
                    $date = $date->addYear();
                    $roi = new Roi();
                    $roi->user_id = $user->id;
                    $roi->investment_id = $investment->id;
                    $roi->status = 1;
                    $roi->amount = $totalroi/$years;
                    $roi->roi_date = $date;
                    $roi->save();
                }
            }
            //give referral bonus
            $totalLevels = Referralbonus::count();
            $levels = Referralbonus::latest()->get();
            $parentId = getparent($user->id);
            foreach($levels as $level){
                //check if got parent Id
                if($parentId>0){
                    //Check if parent available in users table
                    $parent = User::find($parentId);
                    if(!empty($parent)){
                        //Update parent bonus
                        $bonus = ($level->bonus / 100) * $investment->amount;
                        $parent->balance += $bonus;
                        $parent->update();
                        // Create Transaction
                        trx($parent->id,$bonus,'1','Referral level '.$level->id.' bonus from '.$parent->username.' at '.\Carbon\Carbon::now(),'ref_bonus');
                    }
                }else{
                    break;
                }
                // get next parent
                $parentId = getparent($parent->id);
            }

            return back()->with('success','Your Investment placed successfully.');
        }else{
            return back()->with('error','Invalid amount for this package, minimum investment is '.$package->min_invest.' and maximum investment is '.$package->max_invest);
        }

    }

    //show user investments
    function showUserInvestments()
    {
        $investments = Auth::user()->investments()->paginate(25);
        $emptyMessage = "No Investment found";
        return view('users.investments.index',compact('investments','emptyMessage'));
    }


    //show active investments
    public function active_invest()
    {
        $active_investments = Investment::where('status',1)->with(['rois'])->get();
        return view('admin.investments.active-investments',compact('active_investments'));
    }

    //show pending investments
    public function pending_invest()
    {
        $pending_investments = Investment::where('status',0)->get();
        return view('admin.investments.pending-investments',compact('pending_investments'));
    }

    //delete investment
    public function destroy($id)
    {
        $investment = Investment::find($id);
        $investment->delete();
        return back()->with('success','Investment deleted successfully');
    }
}
