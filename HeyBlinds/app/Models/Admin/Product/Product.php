<?php

namespace App\Models\Admin\Product;

// use App\Helpers\Helpers;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Color;
use App\Models\Admin\Promo\Promo;
use App\Models\Front\Cart\CartItem;
use App\Models\HeadrailOption;
use App\Models\Media;
use App\Models\ProductReview;
use App\Models\SampleCart;
use App\Models\Tooltip;
use App\libs\HelperTrait;
use App\libs\ModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;



/**
 * @method static find($id)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $id)
 * @method static paginate(int $int)
 * @method static findOrFail($id)
 * @method static orderBy(string $string, string $string1)
 * @method static select(string $string, string $string1)
 */
class Product extends Model
{
    use HasFactory, HelperTrait;
    protected $guarded = [];

    protected $table = 'products';
    //public Helpers $helpers;

    /**
     * Associate with category
     *
     *
     * @return Array
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    /**
     * Associate with subcatgory
     *
     * @return Array 
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function headrailOption(){
        return $this->hasOne(HeadrailOption::class, 'product_id');
    }
    // /**
    //  * The colors that belong to the product.
    //  */
    // public function ccolors(){
    //     return $this->belongsToMany(Color::class,'product_colors','product_id','color_id');
    // }

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function measurement()
    {
        return $this->hasOne(ProductMeasurement::class, 'product_id');
    }

    public function price()
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'display_media_id');
    }

    public function sampleCart()
    {
        return $this->hasMany(SampleCart::class, 'product_id');
    }
    public function tooltip(){
        return $this->hasOne(Tooltip::class, 'product_id');
    }

    public function getMinAndMax($productID, $optionID): ?array
    {
          $width = DB::table('product_options')->select('option_id', 'min_width', 'max_width')->where('product_id', $productID)->where('option_id', $optionID)->where("is_active",  1)->first();
        if (!empty($width) && !empty($width->min_width) && !empty($width->max_width)) {
            return $data = [
                'width' => "{$width->min_width}-{$width->max_width}",
                'id' => $width->option_id,
            ];
        }
        return null;
    }

    public function getMinAndMaxHeight($productID, $optionID): ?array
    {
          $width = DB::table('product_options')->select('option_id', 'min_width', 'max_width')->where('product_id', $productID)->where("is_active",  1)->first();
        if (!empty($width) && !empty($width->min_width) && !empty($width->max_width)) {
            return $data = [
                'width' => "{$width->min_width}-{$width->max_width}",
                'id' => $width->option_id,
            ];
        }
        return null;
    }
    

    public function getProductPrice($id, $width, $height): array
    {
        $productPrice = DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $width)
            ->where('height', '>=', $height)->pluck('price')->first();

        if(empty($productPrice)){
            $productPrice = DB::table('product_prices')->where('product_id', $id)->pluck('price')->first();
        }

        $optionsPrice = 0;

        $options = ProductOption::where('product_id', $id)->where('is_active', true)->get();

        foreach ($options as $productOption){
            if (!empty($productOption->option->is_always_included)) {
                foreach ($productOption->option->price as $optionPrice) {
                    if (empty($optionPrice->min_width) && empty($optionPrice->max_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && !empty($optionPrice->max_width) && ($width <= $optionPrice->max_width) && ($width >= $optionPrice->min_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (empty($optionPrice->min_width) && !empty($optionPrice->max_width) && $width <= $optionPrice->max_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && empty($optionPrice->max_width) && $width >= $optionPrice->min_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    }
                }
            }
        }

        $coupon = $this->helpers->coupon($id,(float)trim($productPrice));

        $finalPriceAfterDiscount = (float)$productPrice - ((float) !empty($coupon) ? $coupon['total'] : 0);
        $price = ((float)$finalPriceAfterDiscount + (float)$optionsPrice);
        $finalOptionPrice = (float) $optionsPrice / (1  - (($coupon['discount'] ?? 0) / 100));
        $totalUnitPrice =  $this->helpers->withoutRoundingforOther(((float) $productPrice + $finalOptionPrice), 2);
        $initialDiscount = 0;

        if (!empty($coupon['type']) == "percentage"){
            $initialDiscount = $coupon['discount']."%";
        }elseif (!empty($coupon['type']) == "flat"){
            $initialDiscount = "$".$this->helpers->withoutRoundingforOther($coupon['discount'], 2);
        }

        return ['discount' => $initialDiscount ?? 0 , 'price' => $this->helpers->withoutRounding($price,2) ?? 0, 'productPrice' => $this->helpers->withoutRounding((float)trim($totalUnitPrice), 2) ?? 0 ];
    }

    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */

    public function afterOrderProductPrice($id, $width, $height,$cart_item_id)
    {

        $productPrice = DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $width)
            ->where('height', '>=', $height)->pluck('price')->first();

        if(empty($productPrice)){
            $productPrice = DB::table('product_prices')->where('product_id', $id)->pluck('price')->first();
        }

        $optionsPrice = 0;
        $options = ProductOption::where('product_id', $id)->where('is_active', true)->get();

        foreach ($options as $productOption){
            if (!empty($productOption->option->is_always_included)) {
                foreach ($productOption->option->price as $optionPrice) {
                    if (empty($optionPrice->min_width) && empty($optionPrice->max_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && !empty($optionPrice->max_width) && ($width <= $optionPrice->max_width) && ($width >= $optionPrice->min_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (empty($optionPrice->min_width) && !empty($optionPrice->max_width) && $width <= $optionPrice->max_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && empty($optionPrice->max_width) && $width >= $optionPrice->min_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    }
                }
            }
        }
   
       //$coupon = $this->helpers->coupon((float)trim($productPrice));
       $coupon = $this->promoPrice($productPrice,$cart_item_id);

        $finalPriceAfterDiscount = (float)$productPrice - ((float) !empty($coupon) ? $coupon['total'] : 0);
        $price = ((float)$finalPriceAfterDiscount + (float)$optionsPrice);
        $finalOptionPrice = (float) $optionsPrice / (1  - (($coupon['discount'] ?? 0) / 100));
        $totalUnitPrice =  $this->helpers->withoutRoundingforOther(((float) $productPrice + $finalOptionPrice), 2);
        $initialDiscount = 0;

        // if (!empty($coupon['type']) == "percentage"){
        //     $initialDiscount = $coupon['discount']."%";
        // }elseif (!empty($coupon['type']) == "flat"){
        //     $initialDiscount = "$".$this->helpers->withoutRounding($coupon['discount'], 2);
        // }

        
       return ['price' => $this->helpers->withoutRounding($price,2) ?? 0, 'productPrice' => $this->helpers->withoutRounding((float)trim($totalUnitPrice), 2) ?? 0 ];

    }

    public function getExtraDiscountProductPrice($id, $width, $height): array
    {
        $productPrice = DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $width)
            ->where('height', '>=', $height)->pluck('price')->first();

        if(empty($productPrice)){
            $productPrice = DB::table('product_prices')->where('product_id', $id)->pluck('price')->first();
        }

        $optionsPrice = 0;

        $options = ProductOption::where('product_id', $id)->where('is_active', true)->get();

        foreach ($options as $productOption){
            if (!empty($productOption->option->is_always_included)) {
                foreach ($productOption->option->price as $optionPrice) {
                    if (empty($optionPrice->min_width) && empty($optionPrice->max_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && !empty($optionPrice->max_width) && ($width <= $optionPrice->max_width) && ($width >= $optionPrice->min_width)) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (empty($optionPrice->min_width) && !empty($optionPrice->max_width) && $width <= $optionPrice->max_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    } elseif (!empty($optionPrice->min_width) && empty($optionPrice->max_width) && $width >= $optionPrice->min_width) {
                        if ($optionPrice->type == 1) {
                            $optionsPrice += (float)$optionPrice->price;
                        } elseif ($optionPrice->type == 2) {
                            $optionsPrice += (float)($optionPrice->price / 100) * $productPrice;
                        }
                    }
                }
            }
        }

        $coupon = $this->helpers->coupon($id,(float)trim($productPrice));
       
        $finalPriceAfterDiscount = (float)$productPrice - ((float) !empty($coupon) ? $coupon['total'] : 0);
        $price = ((float)$finalPriceAfterDiscount + (float)$optionsPrice);
        $finalOptionPrice = (float) $optionsPrice / (1  - (($coupon['discount'] ?? 0) / 100));
        $totalUnitPrice =  $this->helpers->withoutRoundingforOther(((float) $productPrice + $finalOptionPrice), 2);
        $totalUnitPrice =  $this->helpers->withoutRoundingforOther(((float) $productPrice + $finalOptionPrice), 2);
        $extra_price = (((float) !empty($coupon) ? $coupon['extra_discount'] : 0) / 100) * $price;
        $price = $price - $extra_price;
        
        $initialDiscount = 0;

        if (!empty($coupon['type']) == "percentage"){
            $initialDiscount = $coupon['discount']."%";
        }elseif (!empty($coupon['type']) == "flat"){
            $initialDiscount = "$".$this->helpers->withoutRoundingforOther($coupon['discount'], 2);
        }

        return ['discount' => $initialDiscount ?? 0 , 'price' => $this->helpers->withoutRounding($price,2) ?? 0, 
            'productPrice' => $this->helpers->withoutRounding((float)trim($totalUnitPrice), 2) ?? 0,
            'extra_discount' => $coupon['extra_discount'] ?? 0,
         ];
    }

    public function promoPrice($product_price,$id){
        $cart_item = CartItem::where('id',$id)->first();
        if($cart_item){
            if($cart_item->promo_type == 'percentage'){
                $discount      = $cart_item->promo_discount;
                $discountPrice = (float) ($product_price * $discount) / 100;
                $data  = [
                    "discount" => $discount,
                    "total"    => (float) $this->helpers->withoutRounding($discountPrice, 2),
                ];

            } elseif ($cart_item->promo_type === "fixed_amount") {
                $discountPrice = $cart_item->promo_discount;
                $data          = [
                    "discount" => $discountPrice,
                    "total"    => (float) $this->helpers->withoutRounding($discountPrice, 2),
                ];
            }
        }
        return $data ?? null;
    }

    public function review(){
        return $this->hasMany(ProductReview::class)->where('status',1);
    }
    public function avgRatingOfProduct($product_id){
        return $this->review->where('product_id',$product_id)->where('status',1)->avg('rating_point');
    }

   
}
