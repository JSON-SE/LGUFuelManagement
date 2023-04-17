<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SavecartResource extends JsonResource
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
            'cart_id' => $this->cart_id ?? " ",
            'id' => $this->external_id,
            'name' =>  $this->user->full_name ?? " ",
            'email' => $this->user->email ?? " ",
            'phone_number' => $this->user->profile->phone_number ?? " ",
            'cart_amount' => number_format($this->cart_amount ?? '0.00', 2),
            'reson' => $this->draft_reason ?? " ",
            'created_at' => $this->created_at->format('d/M/Y H:m') ?? " ",
            "url" => route('frontend.checkout', $this->external_id),
        ];
    }
}
