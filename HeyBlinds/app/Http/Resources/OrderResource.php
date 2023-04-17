<?php

namespace App\Http\Resources;

use App\Models\Admin\Order\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'full_name' => $this->shippingAddress->full_name ?? '',
            'email' => $this->shippingAddress->email ?? '',
            'phone_number' => $this->shippingAddress->phone_number ?? '',
            'cart_external_id' => $this->cart->external_id ?? '',
            'order_id' => $this->order_id ?? '',
            'cart_id' => $this->cart_id ?? '',
            'created_at_human' => $this->created_at->diffForHumans(),
            'created_at_time' => $this->created_at->format('Y-m-d H:i'),
            'user' => true,
            'grand_total_price' => $this->grand_total_price ?? '',
            'order_count' => count($this->orderEntries) ?? 0,
            'order_status' => $this->order_status ?? 1,
            'color_status' => $this->checkOrderSatusAsperDay($this),
            'status_name' => $this->orderStatus($this->order_status),
        ];
    }
    /**
     * Calculate the total ground amount.
     *
     * @param $cart_id
     *
     * @return Number
     */
    private function checkOrderSatusAsperDay($order){
        $days = $order->created_at->diffInDays(now());                  
            if (($order->order_status == 1 && $days >= 1) || ($order->order_status == 8 && $days >= 1)) {
                return true;
            }
            return false;
    }
    /**
     * Deipslay the order status
     *
     * @param $order_status_id
     *
     * @return String
     */
    private function orderStatus($order_status_id){
       $status = OrderStatus::where('id',$order_status_id)->select('name')->first();
       return $status->name ?? 1;
    }
}
