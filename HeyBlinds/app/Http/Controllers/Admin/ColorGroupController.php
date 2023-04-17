<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers as HelpersAlias;
use App\Http\Controllers\Controller;
use App\Models\Admin\ColorGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ColorGroupController extends Controller
{
    // public HelpersAlias $helpers;
    public HelpersAlias $helpers;
    public function __construct()
    {
        $this->helpers = new HelpersAlias();
        View::share ( 'helpers', $this->helpers );
    }

    public function index(){
        $colorGroups = ColorGroup::orderByDesc('id')->get();

        return view('admin.color.group.index', compact('colorGroups'));
    }

    public function store(Request $request){
        $helper = New HelpersAlias();
        $request->validate([
            'name' => 'required|unique:color_groups|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (!empty($request->file('image'))){
            $image = $helper->uploadImage($request->file('image'), 'color/group');
            $request->merge(['media_id' => $image]);
        }
        $request->merge(['slug' => Str::slug($request->input('name'))]);
        $requestNeed = $request->only('name', 'is_enabled', 'slug', 'media_id');

        $colorGroup = ColorGroup::create($requestNeed);
        $collection = $colorGroup->toArray();
        if (!empty($colorGroup->media_id)){
            $collection['image'] = $this->helpers->getThumbnail($colorGroup->media_id);
        }
        return response()->json($collection);
    }
    public function edit($slug){
        $group = ColorGroup::where('slug', $slug)->first();
        return view('admin.color.group.edit', compact('group'));
    }
    public function update(Request $request, $slug){
        $helper = New HelpersAlias();
        $request->validate([
            'name' => "required|max:255|unique:color_groups,name,{$slug},slug",
            'image' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        if (!empty($request->file('image'))){
            $image = $helper->uploadImage($request->file('image'), 'color/group');
            $request->merge(['media_id' => $image]);
        }
        $request->merge([
            'slug' => Str::slug($request->input('name')),
            'is_enabled' => !empty($request->input('is_enabled') ? $request->input('is_enabled') : null)
        ]);

        $requestNeed = $request->only('name', 'is_enabled', 'slug', 'media_id');

        $colorGroup = DB::table('color_groups')->where('slug', $slug)->update($requestNeed);


        if (!empty($colorGroup)){
            return redirect()->route('admin.color.group.index')->with('success', 'Successfully Updated');
        }
        return back();
    }

    public function destroy($id){
        $color = ColorGroup::findOrFail($id);
        $color->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
