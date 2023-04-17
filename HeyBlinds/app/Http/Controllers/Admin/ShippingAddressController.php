<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Admin\Customer\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function update(CheckoutRequest $request){
        try{
            $shipping = ShippingAddress::where('id',$request->shipping_id)->first();
            $shipping->update([
                'first_name' => $request->shipping_first_name,
                'last_name' => $request->shipping_last_name,
                'email' => $request->shipping_email,
                'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->shipping_phone_number)),
                'street' => $request->shipping_street,
                'city' => $request->shipping_city,
                'area_code' => $request->shipping_area_code,
                'province' => $request->shipping_province,
                'postal_code' => $request->shipping_postal_code,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Shipping address is Successfully updated.'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
