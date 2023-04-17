<?php

namespace App\Models;

use App\Models\Admin\Color;
use App\Models\Admin\Order\SampleOrder;
use App\Models\Admin\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $input)
 */
class  SampleCart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    //wrong relation
    public function order(){
        return $this->belongsTo(SampleOrder::class, 'sample_cart_id');
    }
    
   
}
