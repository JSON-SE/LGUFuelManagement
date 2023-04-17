<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;
    protected $tables ='contacts';
    protected $guarded = [];


     public function getPhoneNumber($value){
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
