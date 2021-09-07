<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ChartDataController extends Controller
{
    public function getData(Request $request)
    {
        $now = empty($request->to) ? Carbon::now() : $request->to;
        $from = empty($request->from) ? Carbon::now()->subDays(30) : $request->from;
        // dd($from);
        $days_array = [];
        $period = CarbonPeriod::create($from, $now);
        $chartdata = [];
        $totalCount = 0;
        foreach ($period as $date) {
            $date = Carbon::parse($date)->format('Y-m-d 00:00:00');
            $enddate = Carbon::parse($date)->format('Y-m-d 23:59:59');
            array_push($days_array,Carbon::parse($date)->isoFormat('Do'));
            // dd($date);
            $count = Investment::whereBetween('created_at',[$date,$enddate])->sum('amount');
            if($count){
                $totalCount++;
            }
            array_push($chartdata,$count);

        }
        $max = round(($totalCount+10/2)/10)*10;
        $chart_data_array = array(
            'days' => $days_array,
            'count_data' => $chartdata,
            'max' => $max
        );
        return $chart_data_array;

    }
}
