<?php

namespace App\Http\Controllers;

use App\Models\AbandonedCustomer;
use App\Models\Action;
use App\Models\Front\Cart\Cart;
use App\Models\PostalCode;
use App\Models\SampleCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DemoController extends Controller
{
 
    public function demoEmail(){
        return view('temp');
    }
    
    public function store(){
        return   $data = $this->storeFile($file = '');

        return count($data);

        foreach ($data as $value) {
            PostalCode::create(
               [
                'postal_code' => preg_replace('/\s+/', ' ', $value['POSTAL_CODE']),
                'city' => preg_replace('/\s+/', ' ', $value['CITY']),
                'province_abbr' => preg_replace('/\s+/', '',$value['PROVINCE_ABBR']) ?? null,
                'time_zone' => $value['TIME_ZONE'] ?? null,
                'latitude' => $value['LATITUDE'] ?? null,
                'longitude' => $value['LONGITUDE'] ?? null,
            ]);
        }
        return "sucess";

    }
    public function mergeTable(){
        $data = Cart::with('user')->where('cart_id','!=','')->where('cart_draft', true)->get();
        foreach($data as $d){
            Action::updateOrCreate([
                'cart_id' => $d->id
            ],[
                'cart_id' => $d->id,
            ]);
        }
        return "sucess";

    }



    public function storeFile($file){

        $filepath = 'CanadianPostalCodes.csv';
        // Reading file
        $file = fopen($filepath, "r");
        $importData_arr = array();

        $header = [];
        $data = [];
        $num = '';
        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
            $num = count($filedata);
            if (!$header) {
                $header = $filedata;
            } else {
                $data[] = array_combine($header, $filedata);
            }
        }

        return $num;
        return $data;
    }
}
