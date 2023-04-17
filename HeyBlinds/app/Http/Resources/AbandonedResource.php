<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class AbandonedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cart_id' => $this->cart->cart_id ?? '',
            'name' =>  $this->full_name ?? " ",
            'is_order_sample' => $this->cart_type == 1 ? 'No' : 'Yes',
            'provience' => $this->shipping_province,
            'email' => $this->shipping_email ?? " ",
            'phone_number' =>  $this->shipping_phone_number ?? "",
            'cart_amount' => number_format($this->cart->cart_amount ?? '0.00', 2),
            'created_at' => $this->created_at->format('Y-m-d H:m:s') ?? "",
            'url' => $this->makeroute($this),
        ];
    }
    // private function cartId($cart_id){
    //       $cart = Cart::where('id',$cart_id)->first();
    //       return $cart->cart_id ?? '';
    // }
    private function checkOrder($data){
        if($data){
            if($data->cart){
               return "No";
            }
            return "Yes";
        }
    }
    private function makeroute($data){
        if($data){
            if($data->cart){
                return route("frontend.checkout", $data->cart->external_id ?? '');
            }
            return route("frontend.sample.checkout.index", $data->sampleCart->external_id ?? '');
        }
    }
}
