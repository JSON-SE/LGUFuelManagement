<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function index($slug = null){
        $newcategory  = '';
        if($slug){
            $newcategory = BlogCategory::where('slug',$slug)->where('status',1)->firstOrFail();
            $blogs = $newcategory->blogs()->where('status',1)->orderBy('created_at','desc')->get();
        }else{
            $blogs = Blog::where('status',1)->orderBy('created_at','desc')->get();
        }
        $categoies = BlogCategory::where('status',1)->get();
        return view('frontend.blog',compact('blogs','categoies','newcategory'));
    }
    
    public function search(Request $request)
    {
        $blogs = Blog::where('name','like',"%{$request->search}%")->orderBy('created_at','desc')->get();
        $html = '';
        foreach($blogs as $blog){
        $html = $html.'<div class="col-lg-4 col-md-6 mb-3">
            <div class="blog-box p-2 rounded h-100">
            <a class="blog-image" href=""> 
                <img class="rounded-3" src="'.$this->helpers->getImage($blog->media_id).'" alt="'.$blog->name.'" />
            </a>
            <div>
                <div>';
                    foreach($blog->categories as $category){
                        $html = $html.'<a href="'.url('/blog/category/'.$category->slug).'" class="blog-tag">'.$category->name.'</a>';
                    }
                    $html = $html.'</div>
                        <h5 class="pt-3">
                            <a href="'.url('/blog/'.$blog->slug).'">'.$blog->name.'</a>
                            </h5>
                            <div class="d-flex justify-content-between flex-wrap pt-2">
                                <p class="mb-0">
                                    <span class="fw-semibold">by Admin</span> <br/><small>'.$blog->created_at->format('F d, Y').'</small>
                                </p>
                                <p class="mb-0 mt-2"><small>'.$blog->comments->count().' Comments</small></p>
                            </div>
                        </div>
                        </div>
                    </div>';
                }
                return response()->json([
                    'status' => true,
                    'count' => $blogs->count(),
                    'data' => $html
                ]);
    }
    public function show($slug){
         $blog = Blog::where('slug',$slug)->where('status',1)->firstOrFail();
        $categoies = BlogCategory::where('status',1)->get();
        $blogs = Blog::where('status',1)->where('status',1)->orderByDesc('created_at')->get();
        $relativeBlog = Blog::where('status',1)->where('slug','!=',$slug)->take(2)->get();
        $comments = Comment::where('blog_id',$blog->id)->where('status',1)->get();
        return view('frontend.blog-details',compact('blog','categoies','blogs','relativeBlog','comments'));
    }
}
