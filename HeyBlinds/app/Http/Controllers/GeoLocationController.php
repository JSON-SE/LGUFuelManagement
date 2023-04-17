<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;


class GeoLocationController extends Controller
{
    public function index(){
        if ($position = Location::get()) {
            // Successfully retrieved position.
            return  $position->countryName;
        } else {
            // Failed retrieving position.
        }
    }
}
