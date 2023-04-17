<?php

namespace App\Models\Admin\Category;

use App\Models\Admin\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

/**
 * @method static orderBy(string $string)
 * @method static create(array $requestNeed)
 * @method static where(string $string, $slug)
 * @method static select(string $string, string $string1)
 * @method static findOrFail($id)
 * @method static whereHas(string $string, \Closure $param)
 */
class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sub_categories';

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function superSubcategory(){
        return $this->belongsTo(SuperSubcategory::class,'super_sub_category_id');
    } 
    public function product(){
        return $this->hasMany(Product::class)->orderBy('order_by');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

}
