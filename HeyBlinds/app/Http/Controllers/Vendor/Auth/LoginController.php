<?php

namespace App\Http\Controllers\Vendor\Auth;


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
        return view('vendor.auth.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->except(['_token']);

        if(isDoctorActive($request->email))
        {
            if(Auth::guard('admin')->attempt($credentials))
            {
                return redirect(RouteServiceProvider::DOCTOR);
            }
            return redirect()->action([
                \App\Http\Controllers\Admin\Auth\LoginController::class,
                'login'
            ])->with('message','Credentials not matced in our records!');
        }
        return redirect()->action([
            LoginController::class,
            'login'
        ])->with('message','You are not an active doctors!');
    }
}
