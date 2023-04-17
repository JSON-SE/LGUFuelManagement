<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Helpers\Helpers;
use Illuminate\Support\Str;
use App\Models\Admin\Filter;
use Illuminate\Http\Request;
use App\Models\Admin\ColorGroup;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Category\SuperSubcategory;

/**
 * @method static select(string $string, string $string1)
 */
class SubCategoryController extends Controller
{
    // public Helpers $helpers;
    public Helpers $helpers;

    public function __construct()
    {
        $this->helpers = new Helpers();
        View::share('helpers', $this->helpers);
    }

    public function index()
    {
        $categories = SubCategory::orderBy('order_by', 'asc')->get();
        return view('admin.category.sub-category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->orderBy('order_by', 'asc')->get();
        $superSubcategories = SuperSubcategory::all();
        return view('admin.category.sub-category.create', compact('categories', 'superSubcategories'));
    }

    public function store(Request $request)
    {
        dd('store is triggered');
        // return $request->all();
        // $request->validate([
        //     'name' => 'required|max:255',
        //     'slug' => 'required|unique:sub_categories|max:255',
        //     'parent_category_name' => 'required|not_in:0',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        // ]);

        // if (!empty($request->file('image'))) {
        //     $image = $this->helpers->uploadImage($request->file('image'), 'sub-category');
        //     $request->merge([
        //         'media_id' => $image
        //     ]);
        // }
        // $subCategory = SubCategory::create([
        //     'name' => $request->name,
        //     'category_id' => $request->parent_category_name,
        //     'slug' => Str::slug($request->slug),
        //     'media_id' => $request->media_id,
        //     'description' => $request->description,
        //     'super_sub_category_id' => $request->super_sub_category_name,
        //     'is_active' => true,
        //     'sub_mobile_name' => $request->sub_mobile_name,
        //     'content' => $request->input('content'),
        //     'footer_content' => $request->input('footer_content'),
        // ]);
        // if (!empty($subCategory->category_id) && $request->parent_category_name == 3) {
        //     Filter::create([
        //         'name' => $subCategory->name,
        //         'slug' => $subCategory->slug,
        //         'type' => $request->super_sub_category_name == 10 ? 1 : 2,
        //         'status' => 1,
        //     ]);
        // }
        // return response()->json($request);
    }

    public function edit($slug)
    {
        $category = SubCategory::where('slug', $slug)->first();
        $categories = Category::where('is_active', 1)->orderBy('order_by', 'asc')->get();
        $superSubcategories = SuperSubcategory::where('is_active', 1)->select('id')->where('id', $category->super_sub_category_id)->orderBy('order_by', 'asc')->first();
        $superSubcategorieList = SuperSubcategory::where('is_active', 1)->orderBy('order_by', 'asc')->get();
        $seo = Seo::where('for_id', $category->id)->where('for', 'sub_category')->first();
        return view('admin.category.sub-category.edit', compact('category', 'categories', 'superSubcategories', 'superSubcategorieList', 'seo'));
    }

    public function update(Request $request, $slug)
    {

        $request->validate([
            'name' => "required|max:255|unique:sub_categories,name,$slug,slug",
            'slug' => "required|max:255|unique:sub_categories,slug,$slug,slug",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        if (!empty($request->file('image'))) {
            $image = $this->helpers->uploadImage($request->file('image'), 'sub-category');
            $request->merge([
                'media_id' => $image
            ]);
        }
        // return $request->all();

        SubCategory::where('slug', $slug)->update([
            'name' => $request->name,
            'category_id' => $request->parent_category_name,
            'slug' => Str::slug($request->slug),
            'media_id' => $request->media_id,
            'description' => $request->description,
            'is_active' => true,
            'content' => $request->input('content'),
            'sub_mobile_name' => $request->sub_mobile_name,
            'super_sub_category_id' => $request->input('super_sub_category'),
            'footer_content' => $request->input('footer_content')
        ]);

        $filter_update =  Filter::where('slug', $slug)->first();
        if (!empty($filter_update)) {
            $filter_update->type =  $request->super_sub_category == 10 ? 1 : 2;
            $filter_update->save();
        }
        // return $filter_update;
        return redirect()->route('admin.sub.category.index')->with(['success' => "Saved!"]);
    }

    public function destroy($id)
    {
        $color = SubCategory::findOrFail($id);
        $filter_sub_category = Filter::where('slug', $color->slug)->first();
        $color->delete();
        if (!empty($filter_sub_category)) {
            $filter_sub_category->delete();
        }
        return back()->with('success', 'Successfully Deleted');
    }

    public function selectSubCategoryList(Request $request)
    {
        $superSubcategorieList = [];
        if ($request->categoryId == 3) {
            $superSubcategorieList = SuperSubcategory::where('category_id', $request->categoryId)->get();
        }
        return response()->json(['data' => $superSubcategorieList, 'status' => 200]);
    }

    public function seo(Request $request)
    {
        // return $request->all();
        $rules = [
            'og_image' => 'mimes:jpg,jpeg,png',
        ];
        $customMessages = [
            'og_image.mimes' => 'The Supported Mimes Type jpg,png,jpeg',
        ];
        $this->validate($request, $rules, $customMessages);

        $seo = $this->helpers->StoreSEO($request, $request->id, 'sub_category');
        return response()->json($seo);
    }
}
