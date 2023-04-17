<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Illuminate\Contracts\Auth\PasswordBroker;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => ['regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/', $this->passwordRules()],
            'password_confirmation' => ['required', 'same:password'],
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['password_confirmation']) || !Hash::check($input['password_confirmation'], $user->password)) {
                $validator->errors()->add('password_confirmation', __('The provided confirm password does not match your password.'));
            }
        })->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
