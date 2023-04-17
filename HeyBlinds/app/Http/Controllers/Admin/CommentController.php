<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Resources\CommentResource;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if($request->ajax()){
            $comments = Comment::where('blog_id', $id)->orderByDesc('created_at');
            // $categories = SubCategory::where('category_id',$id)->orderBy('order_by','asc')->get();
            return DataTables::of($comments)
                ->addIndexColumn()
                ->addColumn('status',function($row){
                    if($row['status'] == 1){
                        return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" checked />';
                    }
                     return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" />';
                })
                ->addColumn('action', function ($row) {
                        
                        $btn ='<a href="'.route('admin.reply.index',$row['id']).'" class="btn btn-sm text-danger"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        $btn = $btn.'<a href="'.route('admin.reply.create',$row['id']).'" class="btn btn-sm text-primary">Reply</a>';
                        
                        return $btn;
                })
                ->rawColumns(['status','action'])                
                ->make(true);
        }
        

        return view('admin.blog.comment.index',compact('blog'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::find($id);
        if($comment->status == 1){
             $comment->update(['status' => 0]);
        }
        else{
            $comment->update(['status' => 1]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
