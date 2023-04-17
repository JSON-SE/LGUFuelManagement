<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'blog_categories';
    /**
     * The blogs that belong to the Blog catgory.
     */
    public function blogs()
    {
        return $this->belongsToMany(Blog::class,'blog_category_blogs','blog_category_id','blog_id');
    }
   
}
