<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\User;
use App\Notifications\AfterRegisterNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'confirm_email' =>['required','same:email'],
            'password' => ['regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',$this->passwordRules()],
        ])->validate();
        try{
            DB::beginTransaction();
            $user = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
            Profile::updateOrCreate([
                'user_id' => $user->id,
                'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $input['phone_number'])),
            ]);
            DB::commit();
            //$user->notify(new AfterRegisterNotification());
            $cart_id = $_COOKIE['__cart_items'] ?? '';
            $user->sendEmailVerificationNotification($cart_id);
        }
        catch(Exception $e){
            DB::rollback();
        }
        
        return $user;
    }
}
