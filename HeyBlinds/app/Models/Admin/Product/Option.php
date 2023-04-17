<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * @method static create(array $array)
 * @method static find($id)
 * @method static where(string $string, $slug)
 * @method static updateOrCreate(array $array)
 * @method static findOrFail($id)
 * @method static orderByDesc(string $string)
 * @method static orderBy(string $string)
 */
class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    protected $guarded = [];

    public function price(){
        return $this->hasMany(OptionPrice::class);
    }
    public function subOption(){
        return $this->hasMany(SubOption::class, 'option_id');
    }
    public function group(){
        return $this->belongsTo(OptionGroup::class, 'group_id')->orderBy('order_by');
    }

    public function option(){
        return $this->hasOne(ProductOption::class, 'option_id')->orderBy('order_by');
    }

    public function productOption(){
        return $this->hasOne(ProductOption::class, 'option_id')->orderBy('order_by');
    }

    public function rules(){
        return $this->hasMany(ProductOptionRules::class);
    }
    public function getRules($productId, $optionId){
        if (!empty($productId) && !empty($optionId))
            return DB::table('product_option_rules')->where('product_id', $productId)->where('option_id', $optionId)->get();
        return null;
    }
    public function getMinMax($productId, $optionId){
        $width = DB::table('product_options')->select('option_id', 'min_width', 'max_width')->where('product_id', $productId)->where('option_id', $optionId)->where('is_active', true)->first();

        if (!empty($width) && !empty($width->min_width) && !empty($width->max_width)){
            return $data = [
                'width' =>"{$width->min_width }-{$width->max_width}",
                'id' => $width->option_id,
            ];
        }
        return null;
    }

}
