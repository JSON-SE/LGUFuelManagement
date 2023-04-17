<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category\SuperSubcategory;
use App\Models\Admin\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuperSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supSubcategories = SuperSubcategory::orderBy('order_by')->get();
        return view('admin.category.super-sub-category.index',compact('supSubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.category.super-sub-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
          $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:super_subcategories|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'required' => 'The :attribute field is required.',
            'image.mimes' => 'The Image must be a file of type:jpeg, png, jpg, gif, svg.',
            'image.image' => 'The Image must be a file of type:jpeg, png, jpg, gif, svg.',
            'image.uploaded' => 'Failed to upload an image. The image maximum size is 2MB.',
        ]);
       
        $request->merge([
            'is_active' => true
        ]);
        if (!empty($request->file('image'))){
            $image = $this->helpers->uploadImage($request->file('image'), 'category');
            $request->merge([
                'media_id' => $image
            ]);
        }

        $requestData = $request->only('name', 'slug','category_id', 'description', 'meta_description','is_active', 'media_id');
        SuperSubcategory::create($requestData);
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
    public function edit($slug)
    {
        $supSubcategory = SuperSubcategory::where('slug', $slug)->first();
        //$categories = Category::where('is_active',1)->orderBy('order_by','asc')->get();
        return view('admin.category.super-sub-category.edit', compact('supSubcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
         //return $request->all();
        $request->validate([
            'name' => "required|max:255|unique:super_subcategories,name,$slug,slug",
            'slug' => "required|unique:categories|max:255|unique:super_subcategories,name,$slug,slug",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
        ]);
         $request->merge([  
            'is_active' => true
        ]);
       
        if (!empty($request->file('image'))){
            $image = $this->helpers->uploadImage($request->file('image'), 'category');
            $request->merge([
                'media_id' => $image
            ]);
        }

    
        SuperSubcategory::where('slug', $slug)->update([
            'name' => $request->name,
            'category_id' => $request->parent_category_name,
            'slug' => Str::slug($request->slug),
            'media_id' => $request->media_id,
            'description' => $request->description,
            'is_active' => true,
            'content' => $request->input('content'),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data Successfully saved.'
        ]);
       // return redirect()->route('admin.super-subcategory.index')->with(['success' => "Saved!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supersubcat = SuperSubcategory::findOrFail($id);
        $supersubcat->delete();
        return back()->with('success','Successfully deleted.');
    }
}
