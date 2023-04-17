<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResouce extends JsonResource
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
            'slug' => $this->slug,
            'vendor_color_name' => $this->vendor_color_name,
            'vendor_color_id' => $this->vendor_color_id,
            'name' => $this->name,
            'color_id' => $this->color_id,
            'color_image_id' => $this->color_image_id,
            'group_name' => $this->group->name ?? '',
            'feature_image_id' => $this->feature_image_id,
            'disclaimer' => $this->disclaimer,
        ];
    }

}
