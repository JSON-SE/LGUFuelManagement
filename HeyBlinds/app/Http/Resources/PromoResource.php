<?php

namespace App\Http\Resources;

use App\Models\Admin\Promo\Promo;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
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
            'external_id'=>$this->external_id,
            'name' => $this->name,
            'start_date' => date('d-m-Y H:i:s',strtotime($this->start_date)),
            'end_date' => date('d-m-Y H:i:s',strtotime($this->end_date)),
            'discount_type' => $this->discount_type,
            'amount' => $this->amount,
            'extra_amount' => $this->extra_amount,
            'banner_is' => $this->isBanner($this->id),
            'is_active'  => $this->activePromo($this->id)
        ];
    }
    public function isBanner($id){
        $slider = Slider::where('promo_id',$id)->first();
        if(!empty($slider->slider_link)){
            return "Yes";
        }
        return "No";
    }
    public function activePromo($promo_id){
        $active_promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())->orderBy('created_at', 'desc')->select('id')->first();
            if($active_promo){
                if($active_promo->id == $promo_id){
                    return true;
                }
            }
        return false;
    }
}
