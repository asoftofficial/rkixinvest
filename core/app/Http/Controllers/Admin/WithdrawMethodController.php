<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawalMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawMethodController extends Controller
{
    public function index(){
        $data['emptyMessage'] = 'Withdrawal Methods not found.';
        $data['methods'] = WithdrawalMethod::orderBy('status','desc')->orderBy('id')->get();
        return view('admin.withdraw_methods.index', $data);
    }

    public function create(){
        $pageTitle = 'New Withdrawal Method';
        return view('admin.withdraw_methods.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max: 60',
            'image' => 'required','image',
            'rate' => 'required|numeric',
            'delay' => 'required',
            'currency' => 'required',
            'min_limit' => 'required|numeric',
            'max_limit' => 'required|numeric',
            'fixed_charge' => 'required|numeric',
            'percent_charge' => 'required|numeric|between:0,100',
            'instruction' => 'required|max:64000',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);
        $filename = '';
        $path = imagePath()['withdraw']['method']['path'];
        $size = imagePath()['withdraw']['method']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = [];
                $arr['field_name'] = Str::lower(Str::replace(' ', '_', $request->field_name[$a]));
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }
        $method = new WithdrawalMethod();
        $method->name = $request->name;
        $method->image = $filename;
        $method->rate = $request->rate;
        $method->delay = $request->delay;
        $method->min_limit = $request->min_limit;
        $method->max_limit = $request->max_limit;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->currency = $request->currency;
        $method->description = $request->instruction;
        $method->user_data = json_encode($input_form);
        $method->save();
        return redirect()->route('admin.withdraw.gateways')->with('success', $method->name . ' has been added.');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Withdrawal Method';
        $method = WithdrawalMethod::findOrFail($id);
        return view('admin.withdraw_methods.edit', compact('pageTitle', 'method'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|max: 60',
            'image'         =>  'image|mimes:jpg,png,jpeg,svg,gif',
            'rate'           => 'required|numeric',
            'delay'          => 'required',
            'min_limit'      => 'required|numeric',
            'max_limit'      => 'required|numeric',
            'fixed_charge'   => 'required|numeric',
            'percent_charge' => 'required|numeric|between:0,100',
            'currency'       => 'required',
            'instruction'    => 'required|max:64000',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);

        $method = WithdrawalMethod::findOrFail($id);
        $filename = $method->image;

        $path = imagePath()['withdraw']['method']['path'];
        $size = imagePath()['withdraw']['method']['size'];

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image,$path, $size, $method->image);
                $method->image          = $filename;
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded. '.$exp);
            }
        }


        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = [];
                $arr['field_name'] = strtolower(str_replace(' ', '_', $request->field_name[$a]));
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }
        $method->name           = $request->name;
        $method->rate           = $request->rate;
        $method->delay          = $request->delay;
        $method->min_limit      = $request->min_limit;
        $method->max_limit      = $request->max_limit;
        $method->fixed_charge   = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->description    = $request->instruction;
        $method->user_data      = $input_form;
        $method->currency       = $request->currency;
        $method->update();
        return back()->with('success', $method->name . ' has been updated.');
    }

    public function activate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $method = WithdrawalMethod::findOrFail($request->id);
        $method->status = 1;
        $method->save();
        $notify[] = ['success', $method->name . ' has been activated.'];
        return redirect()->route('admin.withdraw.method.index')->withNotify($notify);
    }

    public function deactivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $method = WithdrawalMethod::findOrFail($request->id);
        $method->status = 0;
        $method->save();
        $notify[] = ['success', $method->name . ' has been deactivated.'];
        return redirect()->route('admin.withdraw.method.index')->withNotify($notify);
    }
}
