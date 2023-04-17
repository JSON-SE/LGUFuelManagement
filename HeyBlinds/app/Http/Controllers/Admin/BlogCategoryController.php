<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Http\Resources\BlogCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $blogCategories = BlogCategory::query()->orderBy('created_at', 'desc');
            return DataTables::of($blogCategories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        
                        $btn ='<a href="'.route('admin.blog-category.edit',$row['id']).'" class="btn btn-sm text-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        
                        $btn = $btn.'<a href="javascript:void(0)" onclick="deleteBlogCategory('.$row['id'].')" class="btn btn-sm text-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        
                        return $btn;
                })
                ->addColumn('status',function($row){
                    if($row['status'] == 1){
                        return 'Active';
                    }
                     return 'Inactive';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.blog-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:blog_categories',
            'status' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $blogCategory = BlogCategory::create([
                'name' => $request->name,
                // 'slug' => Str::of($request->name)->slug('-'),
                'status' => $request->status,              
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
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
    public function edit($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog-category.edit', compact('blogCategory'));
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
        $request->validate([
            'name' => 'required|unique:blogs,name,'.$id,
            'status' => 'required',
            
        ]);
        try{
            $blogCategory = BlogCategory::findOrFail($id);
            DB::beginTransaction();
            $blogCategory->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);
           DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back()->with('success','Successfully Updated.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogCategory = BlogCategory::find($id);
        $blogCategory->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Successfully Deleted.',
        ]);
    }
    
}
