<?php

namespace App\Http\Controllers;

use App\Models\Admin\Coupon\Coupon;
use App\Models\Subcriber;
use App\Models\SubcriberCopoun;
use Illuminate\Http\Request;

class SubcriberController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $findEmail = Subcriber::where('email',  $request->email)->first();
       $info = [
            'ip' => $request->ip(),
            'email' => $request->email,
        ];
        $data = json_encode($info);
       if(empty($findEmail->email)){
            Subcriber::create(['email' => $request->email]);
            \Cookie::queue('info', $data, 60 * 24); 
            //\Cookie::queue('info', $data,10);
            $subcriberCoupon = Coupon::where('is_active','1')->where('coupon_type','modal')->first();
            return response()->json([
                'status' => true,
                'data' => $subcriberCoupon->code ?? '',
                'message' => "Successfully create your account.",
            ]);
        }
        return response()->json([
                'status' => false,
                'message' => "Hey, looks like that emails already on our list.",
            ]);
    }
    public function getInfo(Request $request){
        $info =  \Cookie::get('info');
       $current_info = json_decode($info,1);
        if(empty($current_info)){
            return response()->json([
                'status' => true,
                'message' => ''
            ]);
        }
    }
    public function unsubscribe(Request $request){
        //return $request->all();
        $request->validate([
            'email' => 'required|email',
        ]);
        $findEmail = Subcriber::where('email',  $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Unsubscribe email is Successfully.'
        ]);
    }
}
