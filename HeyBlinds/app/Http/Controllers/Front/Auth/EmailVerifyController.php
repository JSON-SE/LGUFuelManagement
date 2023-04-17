<?php

namespace App\Http\Controllers\Front\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use App\Notifications\VerificationNotification;

class EmailVerifyController extends Controller
{
    public function sendVerifyLink(Request $request)
    {
        $cart_id = $request->car_id;
        //return $request->user();
        //$user->notify(new AfterRegisterNotification());
        $request->user()->notify(new VerificationNotification($cart_id));
        return $request->cart_id;

        //$request->user()->sendEmailVerificationNotification($request->cart_id);
    }
    public function verifyEmail(Request $request)
    {
        $user = User::find($request->route('id'));
        $cart_id = $request->route('cart_id');
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }
        if ($user->markEmailAsVerified())
            event(new Verified($user));
        return view('auth.successfully-email-verify', compact('cart_id'));
    }
}
