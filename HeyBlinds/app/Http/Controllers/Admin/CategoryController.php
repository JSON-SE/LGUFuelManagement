<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\ColorGroup;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    // public Helpers $helpers;

    public Helpers $helpers;

    public function index()
    {
        $categories = Category::orderBy('order_by','asc')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create(){
        $ColorGroups = ColorGroup::all();
        $SEOFor = 'category';
        return view('admin.category.create', compact('ColorGroups', 'SEOFor'));
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'image.mimes' => 'The Image must be a file of type:jpeg, png, jpg, gif, svg.',
            'image.image' => 'The Image must be a file of type:jpeg, png, jpg, gif, svg.',
            'image.uploaded' => 'Failed to upload an image. The image maximum size is 2MB.',
        ];
        $this->validate($request, $rules, $customMessages);

        $request->merge([
            'is_active' => true
        ]);
        if (!empty($request->file('image'))){
            $image = $this->helpers->uploadImage($request->file('image'), 'category');
            $request->merge([
                'media_id' => $image
            ]);
        }

        $requestNeed = $request->only('name', 'slug', 'description', 'meta_description', 'media_id');
        Category::create($requestNeed);

        return response()->json($request);
    }

    public function edit($slug){
        $ColorGroups = ColorGroup::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $seo = Seo::where('for_id', $category->id)->where('for', 'category')->first();
        return view('admin.category.edit', compact('category', 'ColorGroups', 'category', 'seo'));
    }

    public function update(Request $request, $slug){

        $request->validate([
            'name' => "required|max:255|unique:categories,name,$slug,slug" ,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if (!empty($request->file('image'))){
            $image = $this->helpers->uploadImage($request->file('image'), 'category');
            $request->merge([
                'media_id' => $image
            ]);
        }

        $requestNeed = $request->only('name', 'slug', 'description', 'meta_description', 'media_id');

        Category::where('slug', $slug)->update($requestNeed);

        return redirect()->route('admin.category.index')->with(['success' => "Saved!"]);
    }


    public function seo(Request $request){
        $rules = [
            'og_image' => 'mimes:jpg,jpeg,png',
        ];
        $customMessages = [
            'og_image.mimes' => 'The Supported Mimes Type jpg,png,jpeg',
        ];
        $this->validate($request, $rules, $customMessages);

        $seo = $this->helpers->StoreSEO($request, $request->id, 'category');

        return redirect()->route('admin.category.index')->with(['success' => "Saved!"]);
    }

    public function destroy($id){
        $color = Category::findOrFail($id);
        $color->delete();
        return back()->with('success', 'Successfully Deleted');
    }
    public function showSubcategory($id){
        $categories = SubCategory::where('category_id',$id)->orderBy('order_by','asc')->get();
        return view('admin.category.show-subcategory',compact('categories'));
    }
    public function categoryMenuActive(Request $request){
        $category = Category::where('id',$request->category_id)->first();

        if($category->is_active == 1){
            Category::where('id',$request->category_id)->update(['is_active' => 0]);
        }
        else{
           Category::where('id',$request->category_id)->update([
            'is_active' => 1,
        ]);
           return "sucess";
        }
    }
}
