<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static craete(array $all)
 * @method static create(array $all)
 * @method static where(string $string, $productID)
 * @method static updateOrCreate(array $except)
 */
class ProductShipping extends Model
{
    use HasFactory;
    protected $guarded = [];
}
