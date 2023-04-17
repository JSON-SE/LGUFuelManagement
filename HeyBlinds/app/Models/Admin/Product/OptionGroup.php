<?php

namespace App\Models\Admin\Product;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $requestNeed)
 * @method static where(string $string, $slug)
 * @method static findOrFail($id)
 * @method static select(string $string)
 * @method static whereNotNull(string $string)
 * @method static find($type_id)
 * @method static orderBy(string $string)
 */
class OptionGroup extends Model
{
    use HasFactory, SoftDeletes ;

    protected $table = 'option_groups';
    protected $fillable = ['name', 'is_enabled', 'slug', 'content', 'group_heading', 'show_group_name', 'media_id'];

    public function color(){
        return $this->belongsToMany(Option::class);
    }
    public function image(){
        return $this->belongsTo(Media::class, 'media_id');
    }
    public function option(){
        return $this->hasMany(Option::class, 'group_id')->orderBy('order_by'); //->orderBy('order_by');
    }
}
