<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $tables = 'profiles';
    protected $guarded = [];

    
    public function getPhoneNumberAttribute($value)
    {
        if ($value) {
            return "(" . substr($value, 0, 3) . ") " . substr($value, 3, 3) . " - " . substr($value, 6);
        }
        return null;
    }
}
