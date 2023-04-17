<?php

namespace App\Models\Admin;

use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductColor;
use App\Models\Media;
use App\Models\SampleCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $requestNeed)
 * @method static where(string $string, $slug)
 * @method static find($id)
 * @method static select(string $string, string $string1)
 * @method static findOrFail($id)
 * @method static orderByDesc(string $string)
 */
class Color extends Model
{
    use HasFactory;

    protected $table = "colors";
    protected $guarded = [];

    /**
     * The color gorups that belong to the color.
     */
    public function group()
    {
        return $this->belongsTo(ColorGroup::class, 'color_group_id');
    }
    /**
     * The products that belong to the color.
     */
    public function products(){
        return $this->belongsToMany(Product::class,'product_colors','color_id','product_id');
    }
    /**
     * Get the image associated with the color.
     */
    public function image()
    {
        return $this->hasOne(Media::class, 'color_image_id');
    }
    /*
    * Get the feature image associated with color
     */
    public function feature()
    {
        return $this->hasOne(Media::class, 'feature_image_id');
    }
    /**
     * Get the product color form the color.
     */
    public function productColor()
    {
        return $this->hasMany(ProductColor::class, 'color_id');
    }
    /*
    * Get the sampale cart form the color
     */
    public function sampleCart()
    {
        return $this->hasMany(SampleCart::class, 'color_id');
    }
    /**
     * Get the quantity from sample cart.
     * @param $color_id
     */
    public function quantity($color_id){
        return $samples = SampleCart::where("color_id", $color_id)->with('order',function($query){
                $query->where('order_status','!=', 1)
                    ->orWhere('order_status','!=', 2)
                    ->orWhere('order_status','!=', 8)
                    ->orWhere('order_status','!=', 9);
            })->count() ?? 0;
    }

    

}
