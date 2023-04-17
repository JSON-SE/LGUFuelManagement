<?php

namespace App\Http\Controllers\Admin\Product;

use App\Helpers\Helpers;
use App\Helpers\Helpers as HelpersAlias;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\OptionGroup;
use App\Models\MetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class OptionGroupController extends Controller
{
    // public Helpers $helpers;
    public HelpersAlias $helpers;

    public function  __construct()
    {
        $this->helpers = new Helpers();
        View::share ( 'helpers', $this->helpers );
    }
    public function index(){
        $optionGroups = OptionGroup::orderBy('order_by')->get();
        $groupHeadlines = MetaData::where('meta_key', 'option_group_headlines')->get();

        return view('admin.product.options.option-group.index' , compact('optionGroups', 'groupHeadlines'));
    }
    public function create(){
        $groupNames = OptionGroup::select('group_heading')->whereNotNull('group_heading')->get()->unique('group_heading');

//        dd($groupNames[0]->group_heading);

        return view('admin.product.options.option-group.create', compact('groupNames'));
    }
    public function store(Request $request){
        $helper = New HelpersAlias();
        $request->merge(['slug' => Str::slug($request->input('name'))]);
        $request->validate([
            'name' => 'required|unique:option_groups|max:255',
            'group_heading' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
//        if (DB::table('meta_data')->where('meta_value', $request->input('group_heading'))->Where('meta_for', 'option_group')->doesntExist()) {
//            $headLinesId = MetaData::create([
//                'meta_key' => '',
//                'slug' => Str::slug($request->input('group_id'))
//            ]);
//            $request->merge(['group_id' => $groupId->id]);
//        }
        if (!empty($request->file('image'))){
            $image = $helper->uploadImage($request->file('image'), 'option/group');
            $request->merge(['media_id' => $image]);
        }
        $colorGroup = OptionGroup::create($request->except(['_token', '_method', 'image']));

        if (!empty($colorGroup)){
            return redirect()->route('admin.product.option.group.index')->with('success', 'Successfully Updated');
        }
        return back();

    }
    public function edit($slug){
        $helper = New HelpersAlias();

        $group = OptionGroup::where('slug', $slug)->first();

        $groupNames = OptionGroup::select('group_heading')->whereNotNull('group_heading')->get()->unique('group_heading');

        return view('admin.product.options.option-group.edit', compact('group', 'helper', 'groupNames'));
    }
    public function update(Request $request, $slug){
        $helper = New HelpersAlias();
        $request->merge(['slug' => Str::slug($request->input('name'))]);
        $request->validate([
            'name' => "required|max:255|unique:option_groups,name,$slug,slug",
            'group_heading' => "required|max:255",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (!empty($request->file('image'))){
            $image = $helper->uploadImage($request->file('image'), 'product/option/group');
            $request->merge(['media_id' => $image]);
        }

        $request->merge([
            'is_enabled' => !empty($request->input('is_enabled') ? $request->input('is_enabled'): false),
            'show_group_name' => !empty($request->input('show_group_name') ? $request->input('show_group_name'): false),
        ]);


       DB::table('option_groups')->where('slug', $slug)->update($request->except(['_token', '_method', 'image']));

        return redirect()->route('admin.product.option.group.index')->with('success', 'Successfully Updated');
    }
    public function destroy($id){
        $color = OptionGroup::findOrFail($id);
        $color->delete();
        return back()->with('success', 'Successfully Deleted');
    }
}
