<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $productID)
 * @method static updateOrCreate(array $array)
 */
class ProductMeasurement extends Model
{
    use HasFactory;
    protected $guarded = [];
}
