<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class PostalCodeCheck implements Rule
{
    public $province;
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct($province)
    {
        $this->province  = $province;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $response = Http::get('https://geocoder.ca/'.$value.'?json=1');
        if(isset($response['standard']['prov'])){
            if($response['standard']['prov'] == $this->province){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)';
    }
}
