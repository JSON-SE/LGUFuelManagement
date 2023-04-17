<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static createOrUpdate(array $array)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $productID)
 * @method static create(array $array)
 * @method static find(string $string, $product_option_rules_id)
 * @method static findOrFail($id)
 */
class ProductOptionRules extends Model
{
    use HasFactory;
    protected $table = 'product_option_rules';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
