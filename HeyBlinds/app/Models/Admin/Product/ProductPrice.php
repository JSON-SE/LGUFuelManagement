<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, int $int)
 * @method static select()
 * @method static find($id)
 * @method static whereIn(string $string, mixed $id)
 */
class ProductPrice extends Model
{
    use HasFactory;
    protected $table = 'product_prices';
    protected $guarded = [];
}
