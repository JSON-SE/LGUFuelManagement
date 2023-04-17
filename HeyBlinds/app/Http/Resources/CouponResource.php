<?php

namespace App\Http\Resources;
use App\Models\Admin\Coupon\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'start_date' => date('d-m-Y H:i:s',strtotime($this->start_date)),
            'end_date' => date('d-m-Y H:i:s',strtotime($this->end_date)),
            'amount' => $this->amount,
            'icon' => $this->icon ?? '',
            'is_active'  => $this->activeCoupon($this)
        ];
    }

    private function activeCoupon($coupon){
        $checkDate = \Carbon\Carbon::parse($coupon->end_date ?? null);
        $status = '';

        if (empty($coupon->is_active)){
            $status = "Inactive";
        }elseif($checkDate->isPast()){
            $status = "Expired";
        }elseif ($checkDate->lessThan($coupon->start_date ?? null)){
             $status = "Not Yet Started";
        }elseif (!empty($coupon->is_active)){
            $status = "Active";
        }
        return $status;
    }
}
