<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $productID)
 */
class Seo extends Model
{
    use HasFactory;
    protected $table = 'seo';
    protected $guarded = [];
}
