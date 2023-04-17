<?php

namespace App\Models\Admin\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class BillingAddress extends Model
{
    use HasFactory;
    protected $table = 'billing_addresses';
    protected $guarded = [];

    public function getPhoneNumberAttribute($value)
    {
        if ($value) {
            return "(" . substr($value, 0, 3) . ") " . substr($value, 3, 3) . " - " . substr($value, 6);
        }
        return null;
    }
    

}
