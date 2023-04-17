<?php

namespace App\Models\Admin;

use App\Models\Admin\Product\ProductColor;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $requestNeed)
 * @method static where(string $string, $group_id)
 * @method static findOrFail($id)
 * @method static orderBy(string $string)
 * @method static orderByDesc(string $string)
 */
class ColorGroup extends Model
{
    use HasFactory;
    protected $table = 'color_groups';

    protected $guarded = [];

    public function colors(){
        return $this->hasMany(Color::class);
    }
    public function image(){
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function product(){
        return $this->hasMany(ProductColor::class, 'color_group_id');
    }
}
