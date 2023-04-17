<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddress extends FormRequest
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
            'shipping_first_name' => ['required'],
            'shipping_last_name' => ['required'],
            'shipping_email' => ['required', 'email'],
            'shipping_phone_number' => ['required', 'min:16'],
            'shipping_street' => ['required'],
            'shipping_province' => ['required'],
            'shipping_postal_code' => ['required', 'regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/'],
        ];
    }
}
