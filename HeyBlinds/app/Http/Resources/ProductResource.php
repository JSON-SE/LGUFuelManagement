<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'external_id' => $this->external_id,
            'name' => $this->name ?? '',
            'sku' => $this->sku ?? '',
            'stock' => $this->stock ?? '',
            'category_name' => $this->category->name ?? '',
            'subcategory_name' => $this->subcategory->name ?? '',
            'media_id'  => $this->display_media_id ?? '',
            'slug' => $this->slug ?? '',
            'show_home_page' => $this->show_home_page,
            'is_live' => $this->is_live,
            'draft' => $this->draft,
        ];
    }
}
