<?php

namespace App\Models\Admin\Category;

use App\Models\Admin\Category\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperSubcategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategories(){
        return $this->hasMany(SubCategory::class,'super_sub_category_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
}
