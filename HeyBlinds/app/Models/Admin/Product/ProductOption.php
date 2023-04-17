<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static createOrUpdate(array $array)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $productID)
 * @method static find($id)
 * @method static create(array $array)
 */
class ProductOption extends Model
{
    use HasFactory;

    protected $table = 'product_options';
    protected $guarded = [];

    public function option(){
        return $this->belongsTo(Option::class, 'option_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id')->orderBy('order_by');
    }
    public function rules(){
        return $this->hasMany(ProductOptionRules::class, 'option_id');
    }
}
