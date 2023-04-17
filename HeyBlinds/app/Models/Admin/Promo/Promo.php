<?php

namespace App\Models\Admin\Promo;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static paginate(int $int)
 * @method static orderBy(string $string, string $string1)
 * @method static findOrFail($id)
 */
class Promo extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'promos';

    public function sliders(){
        // return $this->hasMany(Slider::class,'promo_id','id');
         return $this->hasMany(Slider::class)->orderBy('order_by','asc');
    }

    public function getEndDateAttribute($value)
    {
        if($value){
            return \Carbon\Carbon::parse($value)->format('Y/m/d H:i:s');
        }
        return $value;
    }
}
