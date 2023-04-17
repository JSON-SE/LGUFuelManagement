<?php

namespace App\Models\Front\Cart;

use App\Models\User;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static createOrUpdate(array $array)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $id)
 * @method static find($cart_id)
 * @method static create(array $array)
 * @method static findOrFail(mixed $input)
 * @method static whereHas(string $string, \Closure $param)
 * @method static doesntHave(string $string)
 */
class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
    public function itemsCount()
    {
        return $this->hasMany(CartItem::class, 'cart_id')->count();
    }
    public function products()
    {
        return $this->hasMany(CartProductDetails::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'cart_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function abandoned()
    {
        return $this->hasOne(AbandonedCustomer::class, 'cart_id');
    }
    /**
     * Get the cart's number value.
     *
     * @param  string  $value
     * @return string
     */
    // public function getCartAmountAttribute($value)
    // {
    //     return number_format($value,2);
    // }
}
