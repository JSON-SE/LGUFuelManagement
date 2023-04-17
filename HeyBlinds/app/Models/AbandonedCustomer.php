<?php

namespace App\Models;

use App\Models\Front\Cart\Cart;
use App\Models\SampleCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static where(string $string, mixed $input)
 * @method static create(array $array)
 */
class AbandonedCustomer extends Model
{
    use HasFactory;

    protected $table = 'abandoned_customers';

    protected $guarded = [];

    public function getShippingPhoneNumber($value){
        if ($value) {
            return "(" . substr($value, 0, 3) . ") " . substr($value, 3, 3) . " - " . substr($value, 6);
        }
        return null;
    }
    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getShippingFirstNameAttribute($value)
    {
        return ucfirst(Str::lower($value));
    }

    /* Get the user's last name.
     *
     * @param  string  $value
     * @return string
     */
    public function getShippingLastNameAttribute($value)
    {
        return ucfirst(Str::lower($value));
    }
  

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->shipping_first_name} {$this->shipping_last_name}";
    }
    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
    public function sampleCart(){
        return $this->belongsTo(SampleCart::class,'sample_cart_id');
    }
    public function makeroute($data){
        if($data){
            if($data->cart){
                return route("frontend.checkout", $data->cart->external_id ?? '');
            }
        }
        return NULL;
    }
   
}
