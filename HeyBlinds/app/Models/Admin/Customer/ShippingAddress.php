<?php

namespace App\Models\Admin\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order\Order;
use Illuminate\Support\Str;


/**
 * @method static create(array $array)
 */
class ShippingAddress extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'shipping_addresses';

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst(Str::lower($value));
    }

    /* Get the user's last name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst(Str::lower($value));
    }
  
    
    public function order()
    {
        return $this->belongsTo(Order::class,'cart_id','cart_id');
    }

    public function sample(){

    }

    public function getPhoneNumberAttribute($value)
    {
        if ($value) {
            return "(" . substr($value, 0, 3) . ") " . substr($value, 3, 3) . " - " . substr($value, 6);
        }
        return null;
    }
     /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}

