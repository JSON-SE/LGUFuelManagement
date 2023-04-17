<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\LoginController;


Route::name('vendor.')->namespace('vendor')->prefix('vendor')->group(function(){

    Route::namespace('Auth')->middleware('guest:vendor')->group(function(){
        //login route
        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@processLogin');
    });

    Route::namespace('Auth')->middleware('auth:vendor')->group(function(){

        Route::post('/logout',function(){
            Auth::guard('vendor')->logout();
            return redirect()->action([
                LoginController::class,
                'login'
            ]);
        })->name('logout');

    });

});
