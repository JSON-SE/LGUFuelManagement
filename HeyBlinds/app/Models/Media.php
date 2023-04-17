<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static findOrFail(mixed $id)
 */
class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $guarded = [];
}
