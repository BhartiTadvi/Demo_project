<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // dd($this->request);
       
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
            'full_name' => 'required',
            'zipcode' => 'required|numeric',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'name' => 'required',
            'phone_number' => 'required|numeric',
            'phone' =>'required|numeric',
            'zip_code' => 'required|numeric',
            'country1' => 'required',
            'billing_city' =>'required',
            'state1' => 'required',
            'billing_address1' => 'required',
            'billing_address2' => 'required', 
        ];
    }
}
