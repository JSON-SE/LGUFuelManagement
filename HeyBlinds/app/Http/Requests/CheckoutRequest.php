<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'shipping_first_name' => ['required','string','max:30'],
            'shipping_last_name' => ['required','max:30','string'],
            'shipping_email' => ['required','email'],
            'shipping_phone_number' => ['required','min:16'],
            'shipping_street' => ['required'],
            'shipping_city' => ['required'],
            'shipping_province' => ['required'],
            'shipping_postal_code' => ['required'],

//            'billing_first_name' => ['required_if:same_billing_address, ==, 0','max:30'],
//            'billing_last_name' => ['required_if:same_billing_address, ==, 0','max:30'],
//            'billing_email' => 'required_if:same_billing_address, ==, 0|email',
//            'billing_phone_number' => ['required_if:same_billing_address, ==, 0'],
//            'billing_street' => ['required_if:same_billing_address, ==, 0'],
//            'billing_city' => ['required_if:same_billing_address, ==, 0'],
//            'billing_province' => ['required_if:same_billing_address, ==, 0'],
//            'billing_postal_code' => ['required_if:same_billing_address, ==, 0'],

        ];
    }

    public function messages(){
        return [
            'shipping_phone_number.min' => "Please enter a valid phone number."
        ];
    }

}
