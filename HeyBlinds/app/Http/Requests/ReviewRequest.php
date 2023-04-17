<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating_point' => 'required',
            'title_review' => 'required|string|max:225',
            'review' => 'required|string',
            'full_name' => 'string|string|max:225',
            'email' => 'nullable|email|max:225',
            'city' => 'required|max:225',
            'province' => 'required|max:225',
        ];
    }
    public function messages(){
       return [
            'rating_point.required' => 'Please give the rating point.',
       ];
    }
}
