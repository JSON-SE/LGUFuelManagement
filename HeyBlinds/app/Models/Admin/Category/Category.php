<?php

namespace App\Models\Admin\Category;

use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Category\SuperSubcategory;
use App\Models\Admin\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $int)
 * @method static create(array $array)
 * @method static where(string $string, string $int)
 * @method static orderBy(string $string)
 * @method static findOrFail($id)
 * @method static orderByDesc(string $string)
 * @method static limit(int $int)
 * @method static join(string $string, string $string1, string $string2, string $string3)
 * @method static select(string $string, string $string1)
 */
class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'categories';

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
       // return $this->hasMany(Product::class, 'category_id')->orderBy('order_by','ASC');
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
    public function superCategories(){
        return $this->hasMany(SuperSubcategory::class, 'category_id');
    }
}
