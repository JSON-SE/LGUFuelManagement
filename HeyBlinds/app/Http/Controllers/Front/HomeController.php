<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Product\Product;
use App\Models\Review;
use App\Models\SubcriberCopoun;
use Illuminate\Http\Request;
use Session;
use Stevebauman\Location\Facades\Location;
class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @param string $a Foo
     *
     * @return View
     */
    public function index(){
        $ip_address = request()->ip();
        if ($position = Location::get($ip_address)) {
             $country_name = $position->countryName;
        } else {
            $country_name = "";
            // Failed retrieving position.
        }
         $products = Product::where("show_home_page", 1)
          ->where('is_live', 1)
          ->where('draft', 0)
          ->where('display_media_id', '!=', null)
          ->with('price',function($query){
                $query->where('width','>=',12)->where('height', '>=', 12);
            })
          ->whereHas('options')
          ->orderBy('order_by','asc')
          ->get();
         $reviews = Review::where('show_home_page',1)
         ->where('status',1)
         ->get();

        Session::forget('session_width');
        Session::forget('session_height');
        Session::forget('session_width_fraction');
        Session::forget('session_height_fraction');
        return view('frontend.welcome',compact('products','reviews','country_name'));
    }

    public function warranty(){
        return view('frontend.warranty');
    }

    public function about(){
        return view('frontend.about');
    }

    public function free_shipping(){
        return view('frontend.free-shipping');
    }

    public function measure_instructions(){
        return view('frontend.measure_instructions');
    }

    public function termConditions(){
        return view('frontend.terms-condition');
    }

    public function showFaqPage(){
        return view('frontend.faq');
    }

    public function specialDiscount(){
        return view('frontend.special-discount');
    }
}
