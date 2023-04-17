<?php

namespace App\Models\Admin\Order;

use  App\Models\SampleCart;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Admin\Order\SampleOrderEntries;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 */
class SampleOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sample_orders';

    public function orderEntries(){
        return $this->hasMany(SampleCart::class,'external_id','sample_cart_external_id');
    }
    // public function sampleOrder(){
    //     return $this->hasMany(SampleCart::class,'external_id','sample_cart_external_id');
    // }

    public function notes(){
        return $this->hasMany(SampleOrderNote::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }

}
