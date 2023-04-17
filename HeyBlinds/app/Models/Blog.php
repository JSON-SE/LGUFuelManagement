<?php

namespace App\Models;

use App\Models\BlogCategory;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'blogs';

    /**
     * The Blog categories that belong to the blog.
     */
    public function categories(){
        return $this->belongsToMany(BlogCategory::class,'blog_category_blogs','blog_id','blog_category_id')->where('status',1);
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'blog_id');
    }
    // public function comments(){
    //     return $this->belongsToMany(Comment::class,'blog_comment_blogs','comment_id','blog_id');
    // }
}
