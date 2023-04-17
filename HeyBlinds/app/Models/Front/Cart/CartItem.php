<?php

namespace App\Models\Front\Cart;

use App\Helpers\Helpers;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductColor;
use App\Models\Front\Cart\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $external_id)
 * @method static findOrfail(mixed $input)
 * @method static create($cartItem)
 * @method static find($id)
 */
class CartItem extends Model
{
    use HasFactory;
    protected $guard = 'cart_items';
    protected $guarded = [];

    public function ProductDetails()
    {
        return $this->hasOne(CartProductDetails::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
    public function item($data)
    {
        $items = json_decode($data);
        $allItems = [];
        foreach ($items as $key => $item) {
            $allItems[$key] = [$key => $item];
        }
        return $allItems;
    }
    public function colorName($id)
    {
        $getColor = ProductColor::find($id);
        return $getColor->color->name ?? "";
    }

    public function colorImage($id)
    {
        $colorId = $id['option_color'];
        $featureImage =  ProductColor::find($colorId);
        $helper = new Helpers();
        return $helper->getImage($featureImage->color->feature_image_id ?? "");
    }
    public function optionName($value, $type = '')
    {
        $name = "";
        if (is_numeric($value) && Str::contains($type, 'option_')) {
            $name = DB::table('options')->where('id', $value)->pluck('name')->first() ?? "";
        }
        if (is_numeric($value) && Str::contains($type, 'suboption_')) {
            $name = DB::table('sub_options')->where('id', $value)->pluck('sub_option_name')->first();
        }
        if (is_numeric($value) && Str::contains($type, 'headrail_')) {
            $name = $value;
        }

        return $name;
    }
    public function mountName($value, $type = '')
    {
        $name = "";
        if (is_numeric($value) && Str::contains($type, 'option_')) {
            $name = DB::table('options')->where('id', $value)->pluck('name')->first() ?? "";
        }
        if (is_numeric($value) && Str::contains($type, 'suboption_')) {
            $name = DB::table('sub_options')->where('id', $value)->pluck('sub_option_name')->first();
        }

        return $name;
    }
    public function getProductName($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        return $product->name ?? '';
    }
    public function isHeadrailActive()
    {
        if (!empty($this)) {
            $value =  json_decode($this->option_value, 1);
            if (isset($value['headrail_price'])) {
                return true;
            }
            return false;
        }
        return null;
    }

    public function promoPrice($id,$product_id){
         return  CartItem::where('cart_id', $id)->where('product_id', $product_id)->sum('promo_price');
        return CartItem::where('id',$id)->sum('promo_price');
        return $this->where('product_id',$id)->sum('promo_price');
    }
}
