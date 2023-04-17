<?php

namespace App\Models\Admin\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order\Order;


class OrderStatus extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'order_statuses';

    // public function orders(){
    //     return $this->hasMany(Order::class,'order_status');
    // }

}
