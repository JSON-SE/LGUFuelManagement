<?php

namespace App\Models\Admin\Coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, mixed $couponCode)
 * @method static whereDateBetween()
 * @method static orderBy(string $string, string $string1)
 * @method static create(array $data)
 */
class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'coupons';


    public function assignCoupons()
    {
        return $this->hasMany(AssignCoupon::class);
    }
}
