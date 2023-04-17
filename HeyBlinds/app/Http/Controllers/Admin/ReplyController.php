<?php

namespace App\Http\Controllers\Admin;
use App\Models\Comment;
use App\Models\Reply;
use App\Http\Resources\ReplyResource;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        
        if($request->ajax()){
            $reply = Reply::query()->where('comment_id', $id)->orderByDesc('created_at');

            // $categories = SubCategory::where('category_id',$id)->orderBy('order_by','asc')->get();
            return DataTables::of($reply)
            ->addIndexColumn()
                ->addColumn('status',function($row){
                    if($row['status'] == 1){
                        return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" checked />';
                    }
                     return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" />';
                })
                ->addColumn('action', function ($row) {
                        
                    $btn ='<a href="'.route('admin.reply.edit',[$row['comment_id'],$row['id']]).'" class="btn btn-sm text-danger"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    
                    return $btn;
                })               
                ->rawColumns(['status','action'])               
                ->make(true);
        }
        

        return view('admin.blog.comment.reply.index',compact('comment'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       
        $comment = Comment::findOrFail($id); 
        return view('admin.blog.comment.reply.create',compact('comment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        Reply::create([
            'name' => 'HeyBlinds Admin',
            'email' => 'admin@heyblinds.ca',
            'comment' => $request->comment,
            'comment_id' => $request->comment_id,
        ]);
        return redirect()->back()->with('success','Successfully Created.');
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
    public function edit($comment_id,$reply_id)
    {
        // return $id;
        //  $comment = Comment::findOrFail($id); 
        $replay = Reply::findOrFail($reply_id); 
        return view('admin.blog.comment.reply.edit',compact('replay','comment_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$comment_id,$id)
    {
        $replay = Reply::findOrFail($id);
        $replay->update([
            'name' => 'HeyBlinds Admin',
            'email' => 'admin@heyblinds.ca',
            'comment' => $request->comment,
            'comment_id' => $request->comment_id,
        ]);
        return redirect()->back()->with('success','Successfully Updated.');
    }

    public function updateStatus(Request $request, $id)
    {
        $reply = Reply::find($id);
        if($reply->status == 1){
             $reply->update(['status' => 0]);
        }
        else{
            $reply->update(['status' => 1]);
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
