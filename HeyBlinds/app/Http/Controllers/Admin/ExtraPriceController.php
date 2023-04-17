<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HandlingPrice;
use App\Models\ShippingPrice;
use Illuminate\Http\Request;

class ExtraPriceController extends Controller
{
    public function index(){
        $shipping_price = ShippingPrice::get();
        $handlingPrice = HandlingPrice::get();
        return view('admin.extra.extra',compact('shipping_price','handlingPrice'));
    }
    public function shippingPriceStore(Request $request){

        // return $request->all();
        // return ShippingPrice::findOrFail($request->shipping_price_id);
        // $request->validate([
        //     'min_width' => 'numeric|min:94',
        //     'amount' => 'required'
        // ]);
        $headrail = ShippingPrice::truncate();
        $price = $request->input('amount');
        for ($i = 0; $i < count($price); $i++){
            ShippingPrice::updateOrCreate([
                'min_width' => $request->input('min_width')[$i],
                'max_width' => $request->input('max_width')[$i],
                'amount' => $request->input('amount')[$i],
            ]);
        }
        // if(empty($request->shipping_price_id)){
        //         ShippingPrice::create([
        //             'min_width' => $request->min_width,
        //             'amount' => $request->amount,
        //         ]);
        // }
        // else{
        //     $shippingPrice = ShippingPrice::findOrfail($request->shipping_price_id);
        //     $shippingPrice->update([
        //         'min_width' => $request->min_width,
        //         'amount' => $request->amount,
        //     ]);
        // }
        return redirect()->back()->with('success','Successfully updated.');
    }
    public function shippingHandlingStore(Request $request){
        //   $request->validate([
        //     'min_range' => 'required|numeric',
        //     'max_range' => 'required|numeric',
        //     'amount' => 'required'
        // ]);
            $headrail = HandlingPrice::truncate();
            $price = $request->input('price');
            for ($i = 0; $i < count($price); $i++){
                HandlingPrice::updateOrCreate([
                    'max_range' => $request->input('max_range')[$i],
                    'min_range' => $request->input('min_range')[$i],
                    'amount' => $request->input('price')[$i],
                ]);
        }
        
        return redirect()->back()->with('success','Successfully updated.');
    }
}
