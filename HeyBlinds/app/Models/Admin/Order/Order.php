<?php

namespace App\Models\Admin\Order;

use App\Models\Front\Cart\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Admin\Customer\ShippingAddress;
use App\Models\Front\Cart\CartItem;


/**
 * @method static where(string $string, $id)
 * @method static latest(string $string)
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'orders';

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }


    // public function orderEntries(){
    //     return $this->hasMany(OrderTransactionEntry::class);
    // }

    public function orderEntries(){
        return $this->hasMany(CartItem::class,"cart_id","cart_id");
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class,'cart_id','cart_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }
    public function status(){
        return $this->belongsTo(OrderStatus::class,'order_status','id');
    }
    
    public function makeroute($data){
        if($data){
            if($data->cart){
                return route("frontend.checkout", $data->cart->external_id ?? '');
            }
        }
        return NULL;
    }
}
