<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('type',1)->with('lisense.plan')->paginate(10);
        return view('admin.customers.index', compact('customers'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = User::where(['id'=> $id, 'type'=>1])->with('lisense')->first();
        if($customer){
            return view('admin.customers.show', compact('customer'));
        }
        return redirect(404);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function export(Request $request)
    {
       $fileName = 'customers.csv';
       $customers = User::where('type', 1)->with('lisense.plan')->get();
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
