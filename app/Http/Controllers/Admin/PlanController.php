<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Requests\PlanRequest;
use App\Models\User;
class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::withCount('licenses')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $full_path = null;
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "plan_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/plans/');
            $full_path = '/uploads/plans/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            
        }
        $plan = Plan::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'front'         => $request->front,
            'status'        => $request->status,
            'stripe_id'     => $request->stripe_id,
            'partner_name'  => $request->partner_name,
            'file_path'     => $full_path,
            'text'          => $request->text,
        ]); 
        return redirect()->back()->with("success", "Plan Created Successfully!");
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plans = Plan::where('id', $id)->with('licenses.plan')->get();
        return view('admin.plans.show', compact('plans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "plan_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/plans/');
            $full_path = '/uploads/plans/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $plan->file_path = $full_path;
        }
        
        $plan->name          = $request->name;
        $plan->description   = $request->description;
        $plan->price         = $request->price;
        $plan->front         = $request->front;
        $plan->status        = $request->status;
        $plan->stripe_id     = $request->stripe_id;
        $plan->partner_name  = $request->partner_name;
        $plan->text          = $request->text;
        $plan->update();
        return redirect()->back()->with("success", "Plan Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect()->back()->with("success", "Plan Deleted Successfully!");
    }
    public function export(Request $request)
    {
       $fileName = 'plans.csv';
       $plans = Plan::withCount('licenses')->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Plan ID', 'Name', 'Partners', 'Created on', 'Front End', 'Subscribers', 'Status');

            $callback = function() use($plans, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($plans as $plan) {
                    $row['Plan ID'] = $plan->planId;
                    $row['Name']    = $plan->name;
                    $row['Partners']= $plan->partner_name;
                    $row['Created on']= date('d/m/Y', strtotime($plan->created_at));
                    $row['Front End'] = $plan->front==1?"Yes":"No"; 
                    $row['Subscribers']= $plan->licenses_count;
                    $row['Status']      = $plan->status==1?"Online":"Offline";
                    fputcsv($file, array($row['Plan ID'], $row['Name'], $row['Partners'], $row['Created on'], $row['Front End'], $row['Subscribers'], $row['Status']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    public function exportCustomers($planId)
    {
        $plan = Plan::findOrFail($planId);
        $fileName = $plan->name.'-plan-customers.csv';
        $customers = User::where('type', 1)->whereHas('lisense', function($q) use ($plan){
            $q->where('plan_id', $plan->id);
        })->with('lisense.plan')->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Customer ID', 'First Name', 'Last Name', 'Email', 'Date', 'Plan');

            $callback = function() use($customers, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($customers as $customer) {
                    $row['Customer ID'] = $customer->customer_id;
                    $row['First Name']  = $customer->first_name;
                    $row['Last Name']   = $customer->last_name;
                    $row['Email']       = $customer->email;
                    $row['Date']        = date('d/m/Y', strtotime($customer->created_at));
                    $row['Plan']        = $customer->lisense?$customer->lisense->plan->name:'';

                    fputcsv($file, array($row['Customer ID'], $row['First Name'], $row['Last Name'], $row['Email'], $row['Date'], $row['Plan']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
}
