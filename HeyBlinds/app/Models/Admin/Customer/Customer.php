<?php

namespace App\Models\Admin\Customer;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order\Order;
 

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'customers';


    public function orders(){
        return $this->hasMany(Order::class);
    }
}
