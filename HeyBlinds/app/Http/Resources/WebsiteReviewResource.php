<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteReviewResource extends JsonResource
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
            'rating_point' => $this->rating_point,
            'rating_value' => ((100/5)*$this->rating_point),
            'title_review' => $this->title_review,
            'review' => $this->review, 
            'name'  => $this->name,
            'email' => $this->email,
            'city' => $this->city,
            'province' => $this->province,
            'status' => $this->status,
            'show_home_page' => $this->show_home_page,
            'customer_suggestion' => $this->customer_suggestion,
            'created_at' => $this->created_at->format('M d, Y')
        ];
    }
    
}
