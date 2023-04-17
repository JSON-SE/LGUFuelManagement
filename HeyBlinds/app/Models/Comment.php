<?php

namespace App\Models;

use App\Models\Reply;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'comments';

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class)->where('status',1);
    }
    // public function blogs(){
    //     return $this->hasMany(Blog::class)->where('status',1);
    // }
}
