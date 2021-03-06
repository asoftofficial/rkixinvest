<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type'=> 'required',
            'plan_id' =>'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'image' => 'required|file|mimes:jpeg,png,JPEG,PNG,',
            'display_area' => 'required',
            
            
        ];
    }
}
