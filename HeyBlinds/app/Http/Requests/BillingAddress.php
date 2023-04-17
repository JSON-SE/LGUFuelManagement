<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddress extends FormRequest
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
            'billing_first_name' => ['required'],
            'billing_last_name' => ['required'],
            'billing_phone_number' => ['required', 'min:16'],
            'billing_street' => ['required'],
            'billing_city' => ['required'],
            'billing_province' => ['required'],
            'billing_postal_code' => ['required', 'regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/'],
        ];
    }
}
