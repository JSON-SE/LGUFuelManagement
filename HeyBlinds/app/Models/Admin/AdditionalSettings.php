<?php

namespace App\Models\Admin;

use App\libs\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $key)
 * @method static updateOrCreate(array $array)
 */
class AdditionalSettings extends Model
{
    use HasFactory, ModelTrait;
    protected $guarded = [];
}
