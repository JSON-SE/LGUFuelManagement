<?php

namespace App\Models;

use App\Models\Admin\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function avgRatingOfProduct($product_id){
        return $this->where('product_id',$product_id)->where('status',1)->avg('rating_point');
    }
}
