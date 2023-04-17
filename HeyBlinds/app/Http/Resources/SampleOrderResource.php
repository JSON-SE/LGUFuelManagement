<?php

namespace App\Http\Resources;

use App\Models\Admin\Order\OrderStatus;
use App\Models\SampleCart;
use Illuminate\Http\Resources\Json\JsonResource;

class SampleOrderResource extends JsonResource
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
            'id' => $this->id,
            'sample_external_id' => $this->sample_cart_external_id,
            'order_id' => $this->sample_order_id,
            'name' => $this->shippingAddress->full_name ?? '',
            'email' => $this->shippingAddress->email ?? '',
            'phone_number' => $this->shippingAddress->phone_number ?? '',
            'created_at' => $this->created_at->diffForHumans(),
            'order_status' => $this->order_status,
            'status_name' => $this->orderStatus($this->order_status),
            'order_icon' => $this->orderIcon($this),
            'more_than_day' => $this->colorAsPerCreatedDate($this),
            'more_than_order' => $this->changeColorForMoreOrder($this->sample_cart_external_id),
        ];
    }
    /**
     * Retrive the order status
     *
     * @param string $sampale_id
     *
     * @return Json $name OrderStatus
     */
    private function orderStatus($sample_id){
       $status = OrderStatus::where('id',$sample_id)->select('name')->first();
       return $status->name ?? 1;
    }
    /**
     * Color set as per crated
     *
     * @param string $sample_order
     *
     * @return boolean
     */
    private function colorAsPerCreatedDate($order){
        $days = $order->created_at->diffInDays(now());
        if(($order->order_status == 1 && $days >= 1 ) || ($order->order_status == 2 && $days >=1)){
            return true;
        }
        return false;                  
    }

    private function changeColorForMoreOrder($external_id){
        $no_of_sample = SampleCart::where('external_id', $external_id)->count();
        if ($no_of_sample > 12) {
            return true;
        }
        return false;
    }
    private function orderIcon($order){
        if(count($order->orderEntries) > 2){
            return '/admin/images/icon2.png';
        }
        if($order->delivery == "express"){
            return '/admin/images/icon4.png';
        }
        if($order->first_name == "X12EDI"){
            return '/admin/images/icon5.png';
        }    
    }
}
