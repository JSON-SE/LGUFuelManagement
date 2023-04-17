<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 * @method static whereNotNull(string $string)
 * @method static find(mixed $data)
 * @method static findOrFail(mixed $id)
 */
class SubOption extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function option(){
        return $this->belongsTo(Option::class, 'option_id');
    }
}
