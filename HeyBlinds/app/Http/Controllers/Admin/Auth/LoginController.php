<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if((new Helpers)->isAdminActive($request->email))
        {
            if(Auth::guard('admin')->attempt($credentials))
            {
                return redirect(RouteServiceProvider::ADMIN);
            }

            toastr()->error('Credentials not matched in our records!');
            return redirect()->action([
                LoginController::class,
                'login'
            ])->with('message','Credentials not matched in our records!');
        }
        toastr()->error('You are not an active admin!');
        return redirect()->action([
            LoginController::class,
            'login'
        ])->with('message','You are not an active admin!');
    }
}
