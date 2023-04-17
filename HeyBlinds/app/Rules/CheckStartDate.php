
<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckStartDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $today = date('Y-m-d H:i:s', time());
        $reuest_date = date('Y-m-d H:i:s', strtotime($value));
       
        if(strtotime($today) < strtotime($reuest_date)){
            return true;
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
        return 'The start date must be greater than today date.';
    }
}
