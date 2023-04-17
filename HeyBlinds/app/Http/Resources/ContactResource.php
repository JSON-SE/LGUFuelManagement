<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'message'=> $this->message,
            'contact_reason' => $this->contact_reason,
            'preferred_communication' => $this->preferred_communication,
            'order_number' => $this->order_number,
            'created_at' => $this->created_at->format('d/M/Y')
        ];
    }
}
