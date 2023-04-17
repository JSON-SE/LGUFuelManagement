<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
            'group_name' => $this->group->name ?? '',
            'group_heading' => $this->group->group_heading ?? '',
            'media_id'  => $this->media_id ?? '',
            'is_active'  => $this->is_active == 1 ? "Active" : "Inactive",
        ];
    }
}
