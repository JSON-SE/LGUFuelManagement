<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer\BillingAddress;
use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    public function update(Request $request){
        try{
          
            $billing = BillingAddress::where('id',$request->billing_id)->first();
            
            $billing->update([
                
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9]/", '', $request->billing_phone_number)),
                'street' => $request->street,
                'area_code' => $request->area_code,
                'city' => $request->billing_city,
                'province' => $request->billing_province,
                'postal_code' => $request->postal_code,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Billing address is Successfully updated.'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
}
