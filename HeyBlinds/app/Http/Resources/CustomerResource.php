<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->profile->phone_number ?? '',
            'order_count' => $this->orders->count(),
            'cart_count' => $this->carts->has('order')->count(),
            'is_guest' => isset($this->is_guest) ? "No" : "Yes",
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
