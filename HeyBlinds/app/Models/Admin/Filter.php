<?php

namespace App\Models\Admin;

use App\Models\Admin\ProductFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 */
class Filter extends Model
{
    protected $table = 'filters';
    protected $guarded = [];
    // protected $fillabel = ['name','slug','type','status'];
    use HasFactory;

    public function haveProducFtilter()
    {
        return $this->hasMany(ProductFilter::class);
    }

    public function isProductFilter($filter_id, $product_id)
    {
        $check = $this->haveProducFtilter->where('filter_id', $filter_id)
            ->where('product_id', $product_id)
            ->first();
        if ($check) {
            return true;
        }
        return false;
    }
}
