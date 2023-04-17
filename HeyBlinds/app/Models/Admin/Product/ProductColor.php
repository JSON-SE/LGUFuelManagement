<?php

namespace App\Models\Admin\Product;

use App\Models\Admin\Color;
use App\Models\Admin\ColorGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static firstOrCreate(array $array)
 * @method static where(string $string, $productID)
 * @method static findOrFail($id)
 * @method static find($id)
 */
class ProductColor extends Model
{
    use HasFactory;
    protected $table = 'product_colors';
    protected $guarded = [];

    public function group(){
        return $this->hasOne(ColorGroup::class, 'color_group_id');
    }

    public function colorGroup(){
        return $this->belongsTo(ColorGroup::class, 'color_group_id');
    }
    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id')->orderBy('order_by');
    }
}
