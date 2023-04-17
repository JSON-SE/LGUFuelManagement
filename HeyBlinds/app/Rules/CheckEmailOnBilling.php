<?php

namespace App\Rules;

use App\Models\Admin\Customer\BillingAddress;
use Illuminate\Contracts\Validation\Rule;

class CheckEmailOnBilling implements Rule
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
        $check = BillingAddress::where('email',$value)->exists();
        if($check){
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
        return 'The email address is not exist our Billing address.';
    }
}
