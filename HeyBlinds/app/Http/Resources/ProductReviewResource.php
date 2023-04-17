<?php

namespace App\Http\Resources;

use App\Models\Admin\Product\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
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
            'product_name' => $this->productName($this->product_id),
            'rating_value' => ((100/5)*$this->rating_point),
            'rating_point' => $this->rating_point,
            'title_review' => $this->title_review,
            'review' => $this->review,
            'name' => $this->name,
            'email' => $this->email,
            'city' => $this->city,
            'province' => $this->province,
            'suggestion' => $this->customer_suggestion,
            'status' => $this->status,
            'created_at' => $this->created_at->format('M d, Y')
        ];
    }
    public function productName($product_id){
        $product = Product::find($product_id);
        return $product->name ?? ' ';
    }
}
