<?php

namespace App\Http\Controllers\Admin\Product;

use App\Helpers\Helpers;
use App\Models\Admin\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Option;
use App\Http\Resources\OptionResource;
use App\Models\Admin\Product\SubOption;
use App\Models\Admin\Product\OptionGroup;
use App\Models\Admin\Product\OptionPrice;

class OptionController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.product.options.index');
    }
    public function optionSearch(Request $request)
    {
        $options = Option::query()->orderBy('order_by', 'asc');
        return DataTables::of(OptionResource::collection($options->get()))
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="' . $this->helpers->getThumbnail($row['media_id']) . '" style="width:70px">';
            })
            ->addColumn('action', function ($row) {
                $btn = '<a class="btn text-secondary" href="' . route('admin.product.option.edit', $row['id']) . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                            viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /><path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" /></svg></a>';
                $btn = $btn . '<button class="btn" type="button" onclick="deleteOption(' . $row['id'] . ')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></button>';
                return $btn;
            })
            ->setRowClass('{{$is_active == "Inactive" ? "bg-light-danger" : ""}}')
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    public function create()
    {
        $optionGroup = OptionGroup::all();
        $subOptions = SubOption::whereNotNull('sub_group_id')->get()->unique('sub_group_id');
        $Colors = Color::all();
        return view('admin.product.options.create', compact('optionGroup', 'subOptions', 'Colors'));
    }

    public function store(Request $request)
    {

        $helper = new Helpers();
        $rules = [
            "name" => "required|max:255|string",
            'group_id' => "required",
            'option_type' => "required|not_in:0",
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'name.required' => 'The option name Is Required.',
            'group_id.required' => 'The Group name Is Required.',
        ];
        $this->validate($request, $rules, $customMessages);


        //        if (DB::table('options')->where('name', $request->group_id)->orWhere('id', $request->group_id)->doesntExist()) {
        //            $groupId = OptionGroup::create([
        //                'name' => $request->input('group_id'),
        //                'slug' => Str::slug($request->input('group_id'))
        //            ]);
        //            $request->merge(['group_id' => $groupId->id]);
        //        }
        if (!empty($request->file('image'))) {
            $featureImage = $helper->uploadImage($request->file('image'), 'product/option');
            $request->merge(['media_id' => $featureImage]);
        }
        if (!empty($request->file('tooltip_media_id'))) {
            $featureImage = $helper->uploadImage($request->file('tooltip_media_id'), 'product/option/tooltip');
            $request->merge(['tooltip_media_id' => $featureImage]);
        }

        $option = Option::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'group_id' => $request->input('group_id'),
            'is_free' => !empty($request->input('is_free')) ? $request->input('is_free') : false,
            'is_always_included' => $request->input('is_always_included') ?? 0,
            'is_active' => !empty($request->input('is_active')) ? $request->input('is_active') : false,
            'media_id' => $request->input('media_id'),
            'tooltip_media_id' => $request->input('tooltip_media_id'),
            'content' => $request->input('content'),
            'option_type' => $request->input('option_type'),
            'color' => json_encode($request->input('option_color')),
        ]);
        $prices = $request->input('price');

        if (!empty($prices)) {
            $price = [];
            for ($i = 0; $i < count($prices); $i++) {
                if (!empty($prices[$i])) {
                    $price[] = OptionPrice::create([
                        'option_id' => $option->id,
                        'min_width' => $request->input('min_width')[$i],
                        'max_width' => $request->input('max_width')[$i],
                        'type' => $request->input('price_type')[$i],
                        'price' => $request->input('price')[$i],
                    ]);
                }
            }
        }
        $subOptions = $request->input('sub_option_name');
        if (!empty($subOptions)) {
            for ($i = 0; $i < count($subOptions); $i++) {
                if (!empty($subOptions[$i])) {
                    SubOption::create([
                        'option_id' => $option->id,
                        'sub_option_name' => $request->input('sub_option_name')[$i],
                        'sub_group_id' => $request->input('sub_group_id')[$i],
                        'sub_option_type' => $request->input('sub_option_type')[$i],
                        'sub_option_min_width' => $request->input('sub_option_min_width')[$i],
                        'sub_option_min_height' => $request->input('sub_option_min_height')[$i],
                        'sub_option_price_type' => $request->input('sub_option_price_type')[$i],
                        'sub_option_price' => $request->input('sub_option_price')[$i],
                    ]);
                }
            }
        }

        return response()->json($option);
    }
    public function edit($id)
    {
        $helper = new Helpers();
        $option = Option::where('id', $id)->firstOrFail();
        $optionGroup = OptionGroup::all();
        $Colors = Color::all();
        $subOptions = SubOption::whereNotNull('sub_group_id')->get()->unique('sub_group_id');
        return view('admin.product.options.edit', compact('option', 'optionGroup', 'helper', 'subOptions', 'Colors'));
    }

    public function update(Request $request, $slug)
    {

        $helper = new Helpers();
        $price = [];

        $rules = [
            "name" => "required|max:255|string",
            'group_id' => "required",
            'option_type' => "required|not_in:0",
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'name.required' => 'The option name Is Required.',
            'group_id.required' => 'The Group name Is Required.',
        ];
        $this->validate($request, $rules, $customMessages);

        if (!empty($request->file('image'))) {
            $featureImage = $helper->uploadImage($request->file('image'), 'product/option');
            $request->merge(['media_id' => $featureImage]);
        }

        if (!empty($request->file('tooltip_media_id'))) {
            $featureImage = $helper->uploadImage($request->file('tooltip_media_id'), 'product/option/tooltip');
            $request->merge(['tooltip_media_id' => $featureImage]);
        }

        $option =  Option::where('slug', $slug)->first();

        $option->name = $request->input('name');
        $option->slug = Str::slug($request->input('name'));
        $option->group_id = $request->input('group_id');
        $option->is_free = !empty($request->input('is_free')) ? $request->input('is_free') : false;
        $option->is_active = !empty($request->input('is_active')) ? $request->input('is_active') : false;
        $option->is_always_included = $request->input('is_always_included') ?? 0;
        if (!empty($request->input('media_id'))) {
            $option->media_id = $request->input('media_id');
        }
        if (!empty($request->input('tooltip_media_id'))) {
            $option->tooltip_media_id = $request->input('tooltip_media_id');
        }
        $option->content = $request->input('content');
        $option->option_type = $request->input('option_type');
        $option->color = json_encode($request->input('option_color'));
        $option->save();
        //        if (isset($request->is_free) == false) {
        $prices = $request->input('price');
        if (!empty($prices)) {
            for ($i = 0; $i < count($prices); $i++) {
                if (!empty($request->input('option_price_id')[$i]) && $request->input('option_price_id')[$i] != null) {
                    $price[] = OptionPrice::where('option_id', $option->id)->where('id', $request->input('option_price_id')[$i])
                        ->update([
                            'min_width' => $request->input('min_width')[$i],
                            'max_width' => $request->input('max_width')[$i],
                            'type' => $request->input('price_type')[$i],
                            'price' => $request->input('price')[$i],
                        ]);
                } else {
                    $price[] = OptionPrice::create([
                        'option_id' => $option->id,
                        'min_width' => $request->input('min_width')[$i],
                        'max_width' => $request->input('max_width')[$i],
                        'type' => $request->input('price_type')[$i],
                        'price' => $request->input('price')[$i],
                    ]);
                }
            }
        }

        $subOptions = $request->input('sub_option_name');
        if (!empty($subOptions)) {
            for ($i = 0; $i < count($subOptions); $i++) {
                if (!empty($request->input('sub_option_id')[$i]) && $request->input('sub_option_id')[$i] != null) {
                    SubOption::where('option_id', $option->id)->where('id', $request->input('sub_option_id')[$i])->update([
                        'sub_option_name' => $request->input('sub_option_name')[$i],
                        'sub_option_type' => $request->input('sub_option_type')[$i],
                        'sub_group_id' => $request->input('sub_group_id')[$i],
                        'sub_option_min_width' => $request->input('sub_option_min_width')[$i],
                        'sub_option_min_height' => $request->input('sub_option_min_height')[$i],
                        'sub_option_price_type' => $request->input('sub_option_price_type')[$i],
                        'sub_option_price' => $request->input('sub_option_price')[$i],
                    ]);
                } else {
                    SubOption::create([
                        'option_id' => $option->id,
                        'sub_option_name' => $request->input('sub_option_name')[$i],
                        'sub_option_type' => $request->input('sub_option_type')[$i],
                        'sub_group_id' => $request->input('sub_group_id')[$i],
                        'sub_option_min_width' => $request->input('sub_option_min_width')[$i],
                        'sub_option_min_height' => $request->input('sub_option_min_height')[$i],
                        'sub_option_price_type' => $request->input('sub_option_price_type')[$i],
                        'sub_option_price' => $request->input('sub_option_price')[$i],
                    ]);
                }
            }
        }

        return response()->json($option);
    }


    public function destroy($id)
    {

        $option = Option::findOrfail($id);
        $delete = $option->delete();
        return response()->json([
            'status' => true,
            'message' => "Successfully Deleted."
        ]);
    }
    public function RemovePrice(Request $request)
    {

        if ($request->input('type') === "price")
            OptionPrice::findOrFail($request->id)->delete();
        if ($request->input('type') === "sub-group")
            SubOption::findOrFail($request->id)->delete();
    }
}
