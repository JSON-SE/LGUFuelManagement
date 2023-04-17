<?php

namespace App\Models\Front\Cart;

use App\Models\Admin\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array)
 */
class CartProductDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function CartItem(){
        return $this->hasOne(CartItem::class, 'cart_product_details_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
