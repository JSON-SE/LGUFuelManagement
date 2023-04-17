<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:30','regex:/(^([a-zA-z]+)(\d+)?$)/u'],
            'last_name' => ['nullable','max:30','regex:/(^([a-zA-z]+)(\d+)?$)/u'],
            'email' => ['required', 'email', 'max:120','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'confirm_email' => ['required', 'required_with:email', 'same:email'],
            'phone_number' => ['nullable', 'min: 16'],
        ];
    }
        public function messages(){
            return [
                'confirm_email.same' => 'Email and Confirm Email must match.',
                'phone_number.min' => "Please enter a valid phone number."
            ];
        }
    
}
