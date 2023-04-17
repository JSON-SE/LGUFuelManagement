<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
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
            'type' => 'required',
            'amount' => 'required_if:type,percentage|required_if:type,flat|numeric|between:1,99.99',
            'start_date' => 'required',
            'end_date' => 'required',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Promo name Is Required.',
            'type.required' => 'Promo Type Is Required.',
            'amount.required' => 'Promo Value Is Required',
            'amount.min' =>   'Promo value should be greater than zero',
            'amount.not_in' => 'Promo value should be greater than zero',
            'start_date.required' => 'The Start date field is required.',
            'banner.image' => 'The Banner must be an image. File of type: jpeg, png, jpg, gif, svg. Maximum size is 2MB',
            'banner.mimes' => 'The Banner must be an image. File of type: jpeg, png, jpg, gif, svg. Maximum size is 2MB',
        ];
    }
}
