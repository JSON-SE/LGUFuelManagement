<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumPlainConrtoller extends Controller
{
    public function index(){
        return view('frontend.premium-plain');
    }
}
