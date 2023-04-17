<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Seo;
use App\Models\Media;
use App\Models\Tooltip;
use App\Helpers\Helpers;
use App\Models\Headrail;
use App\Rules\ExcelRule;
use App\Models\Admin\Color;
use Illuminate\Support\Str;
use App\Models\Admin\Filter;
use Illuminate\Http\Request;
use App\Models\HeadrailOption;
use App\Models\Admin\ColorGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductPriceImport;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\Product\Product;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Product\OptionGroup;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductPrice;
use App\Models\Admin\Product\ProductOption;
use App\Models\Admin\Product\ProductShipping;
use App\Models\Admin\Product\ProductMeasurement;
use App\Models\Admin\Product\ProductOptionRules;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //return  Product::where('order_by','');
        return view('admin.product.index');
    }
    public function productSearch(Request $request)
    {
        $products = Product::query()->orderBy('order_by', 'asc');
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="' . $this->helpers->getThumbnail($row['media_id']) . '" class="img-fluid thumb" alt="{{$product->name}}">';
            })
            ->addColumn('show_home_page', function ($row) {
                if ($row['show_home_page'] == 1) {
                    return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked(' . $row['id'] . ')" checked />';
                }
                return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked(' . $row['id'] . ')" />';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . $this->helpers->getThumbnail($row['media_id']) . '" class="img-fluid thumb" alt="' . $row['name'] . '">';
            })
            ->addColumn('category_name', function ($row) {
                return $row->category->name ?? '';
            })
            ->addColumn('subcategory_name', function ($row) {
                return $row->subcategory->name ?? '';
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('admin.product.edit', $row['external_id']) . '" class="btn btn-sm text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path></svg></a>';
                $btn = $btn . '<a href="' . route('frontend.product.details', $row['slug']) . '" class="btn btn-sm text-primary" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="bi bi-pencil-square" ><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg></a>';
                $btn = $btn . '<button class="btn" type="button" onclick="delteProduct(' . $row['id'] . ')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></button>';

                return $btn;
            })
            ->setRowId('item-{{$id}}')
            ->setRowClass('{{$is_live == false ? "bg-light-danger" : ""}} {{$draft == true ? "bg-light-warning" : ""}} " ')
            ->rawColumns(['action', 'image', 'show_home_page'])
            ->make(true);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {

        if ($request->input('type') === "save") {
            $request->merge([
                'draft' => false,
            ]);
        } elseif ($request->input('type') === "draft") {
            $request->merge([
                'draft' => true,
            ]);
        }
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'sku' => 'required',
            'default_width' => 'required|integer',
            'default_height' => 'required|integer',
            'slug' => 'required|unique:products',
            'features.*' => 'max:100'
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'name.required' => 'Product name Is Required.',
            'display_media_id.required' => 'Display Image Is Required.',
            'features.*.max' => 'Feature Should be more than 100 characters',
        ];

        $this->validate($request, $rules, $customMessages);

        $product = new Product();
        $product->external_id = Str::uuid();
        $product->name = $request->input('name');
        $product->sku = $request->input('sku');
        $product->stock = $request->input('stock');
        $product->slug = Str::slug($request->input('slug'), '-');
        $product->category_id = $request->input('category');
        $product->sub_category_id = $request->input('sub_category');
        $product->default_width = $request->input('default_width');
        $product->default_height = $request->input('default_height');
        $product->features =  !empty($request->input('features')) ? json_encode($request->input('features')) : [];
        $product->product_image_alt_title = $request->input('product_image_alt_title');
        $product->excerpt = $request->input('excerpt');
        $product->video_url = !empty($request->video_url) ? json_encode($request->video_url) : null;
        $product->video_id = !empty($request->video_id) ? json_encode($request->video_id) : null;
        $product->display_media_id = $request->input('display_media_id');
        $product->slider_id = !empty($request->slider_id) ? json_encode($request->slider_id) : null;
        $product->content = $request->input('content');
        $product->created_by = Auth::id();
        $product->is_live = empty($request->input('is_live')) ? true : false;
        $product->is_new = !empty($request->input('is_new')) ? true : false;
        $product->is_feature = !empty($request->input('is_feature')) ? true : false;
        $product->show_home_page = !empty($request->input('show_home_page')) ? true : false;
        $product->is_on_sale = !empty($request->input('is_on_sale')) ? true : false;
        $product->draft = $request->input('draft');
        //        ]);
        $product->save();

        return response()->json($product);
    }

    public function edit($id)
    {
        $product = Product::where('external_id', $id)->firstOrFail();
        $features = !empty($product->features) ? json_decode($product->features) : [];
        $productID = $product->id;
        $getProductColorIds = ProductColor::where('product_id', $productID)->orderByDesc('color_id')->get();
        $filterPorducts = Filter::where('status', 1)->orderByDesc('id')->get();
        $productColors = [];
        foreach ($getProductColorIds as $getProductColorId) {
            $getColor = Color::find($getProductColorId->color_id);
            $productColors[] = [
                'main_color_id' => $getProductColorId->id,
                'id' => !empty($getProductColorId->color_id) ? $getProductColorId->color_id : "",
                'vendor_name' =>  !empty($getColor->vendor_color_name) ? $getColor->vendor_color_name : "",
                'vendor_color_id' => !empty($getColor->vendor_color_id) ? $getColor->vendor_color_id : "",
                'name' => !empty($getColor->name) ? $getColor->name : "",
                'color_group_name' => !empty($getColor->group->name) ? $getColor->group->name : "",
                'color_id' => !empty($getColor->color_id) ? $getColor->color_id : "",
                'color_image_id' => !empty($getColor->color_image_id) ? $this->helpers->getThumbnail($getColor->color_image_id) : "",
                'feature_image_id' => !empty($getColor->feature_image_id) ? $this->helpers->getThumbnail($getColor->feature_image_id) : "",
                'amount_percentage' => $getProductColorId->amount_percentage
            ];
        }
        $allPrices = ProductPrice::where('product_id', $productID)->get();
        $uniqueWidths = $allPrices->unique('width');
        $uniqueHeights = $allPrices->unique('height');
        $uniqueWidths->all();
        $uniqueHeights->all();
        $prices = [];
        foreach ($uniqueHeights as $key => $height) {
            foreach ($uniqueWidths as $widthKey => $width) {
                $price = ProductPrice::select('id', 'price')->where('product_id', $productID)->where('width', $width->width)->where('height', $height->height)->first();
                if (!empty($price->id)) {
                    $prices[] = [
                        'id' => $price->id,
                        'height' => $height->height,
                        'width' => $width->width,
                        'price' => $price->price
                    ];
                }
            }
        }

        $outer_array = array();
        $unique_array = array();
        foreach ($prices as $key => $value) {
            $inner_array = array();
            $fid_value = $value['height'];
            if (!in_array($value['height'], $unique_array)) {
                array_push($unique_array, $fid_value);
                unset($value['height']);
                array_push($inner_array, $value);
                $outer_array[$fid_value] = $inner_array;
            } else {
                unset($value['height']);
                array_push($outer_array[$fid_value], $value);
            }
        }
        $categories = Category::all();
        $colorGroups = ColorGroup::all();
        $groupHeadings = OptionGroup::whereNotNull('group_heading')->get()->unique('group_heading');
        $Options = Option::with(['option', 'rules'])->where('is_active', true)->get();
        $optionGroups = OptionGroup::all();
        $ProductOptions = ProductOption::where('product_id', $productID)->get();
        $productShipping = ProductShipping::where('product_id', $productID)->orderByDesc('id')->first();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $productMeasurement = ProductMeasurement::where('product_id', $productID)->first();
        $seo = Seo::where('for_id', $productID)->where('for', 'product')->first();
        $headrails = Headrail::where('product_id', $productID)->get();
        $colors = Color::where('is_enable', true)->get();
        $headrailOption = HeadrailOption::where('product_id', $productID)->first();
        // $rules = ProductOptionRules::where('product_id', $productID)->get();

        return view('admin.product.edit', compact('product', 'colors', 'groupHeadings', 'seo', 'productShipping', 'features', 'productMeasurement', 'subCategories', 'productID', 'ProductOptions', 'categories', 'colorGroups', 'uniqueWidths', 'outer_array', 'Options', 'productColors', 'optionGroups', 'filterPorducts', 'headrails', 'headrailOption'));
    }

    public function update(Request $request, $id)
    {
        if ($request->input('type') === "save") {
            $request->merge([
                'draft' => false,
            ]);
        } elseif ($request->input('type') === "draft") {
            $request->merge([
                'draft' => true,
            ]);
        }
        $request->merge([
            'features' => !empty($request->features) ? json_encode($request->features) : null
        ]);
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'sku' => 'required',
            'default_width' => 'required|integer',
            'default_height' => 'required|integer',
            'slug' => "required|unique:products,external_id,$id",
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.',
            'name.required' => 'Product name Is Required.',
            //            'display_media_id.required' => 'Display Image Is Required.',
        ];

        $this->validate($request, $rules, $customMessages);
        //return $request->all();

        $product = Product::where('id', $id)->update([
            'name' => $request->input('name'),
            'sku' => $request->input('sku'),
            'headrail_price' => $request->input('headrail_price'),
            'stock' => $request->input('stock'),
            'slug' => Str::slug($request->input('slug'), '-'),
            'category_id' => $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
            'default_width' => $request->input('default_width'),
            'default_height' => $request->input('default_height'),
            'features' => $request->input('features'),
            'product_image_alt_title' => $request->input('product_image_alt_title'),
            'excerpt' => $request->input('excerpt'),
            'video_url' => !empty($request->video_url) ? json_encode($request->video_url) : null,
            'video_id' => !empty($request->video_id) ? json_encode($request->video_id) : null,
            'display_media_id' => !empty($request->input('display_media_id')) ? $request->input('display_media_id') : null,
            //'slider_id' => !empty($request->slider_id) ? json_encode($request->slider_id) : null,
            'content' => $request->input('content'),
            'updated_by' => Auth::id(),
            'is_live' => empty($request->input('is_live')) ? true : false,
            'is_new' => !empty($request->input('is_new')) ? true : false,
            'is_feature' => !empty($request->input('is_feature')) ? true : false,
            'show_home_page' => !empty($request->input('show_home_page')) ? true : false,
            'is_on_sale' => !empty($request->input('is_on_sale')) ? true : false,
            'made_in_canada' => !empty($request->input('made_in_canada')) ? true : false,
            'draft' => $request->input('draft'),
        ]);
        if ($request->new_slider != 1) {
            Product::where('id', $id)->update([
                'slider_id' => !empty($request->slider_id) ? json_encode($request->slider_id) : null,
            ]);
        }


        return response()->json($product);
    }

    public function option(Request $request, $id)
    {
        $check = $request->input('h_option_id');
        for ($i = 0; $i < count($check); $i++) {
            $checkProductOption = DB::table('product_options')->where('product_id', $id)->where('option_id', $request->h_option_id[$i])->first();
            if (!empty($checkProductOption)) {
                $option = ProductOption::find($checkProductOption->id);
                $option->min_width = $request->option_min_width[$i];
                $option->max_width  = $request->option_max_width[$i];
                $option->is_active =  $request->input('is_active')[$i];
                $option->price = !empty($request->input('option_price')[$i]) ? $request->input('option_price')[$i] : 0;
                $option->save();
            } else {
                $option = ProductOption::create([
                    'product_id' => $id,
                    'option_id' => $request->h_option_id[$i],
                    'min_width' => $request->option_min_width[$i],
                    'max_width' =>  $request->option_max_width[$i],
                    'is_active' =>  $request->is_active[$i],
                    'price' => !empty($request->input('option_price')[$i]) ? $request->input('option_price')[$i] : 0,
                ]);
            }
        }

        $optionList = $request->input('product_option_id');
        if (!empty($optionList)) {
            $rules = [
                'option_list' => 'required',
                "option_list.*"  => "required|string",
                'option_operator' => 'required',
                "option_operator.*"  => "required|string",
            ];
            $customMessages = [
                'required' => 'The :attribute field is required.',
                'option_list.*.required' => 'List Option/Group Option Required',
                'option_operator.*.required' => 'Operator Required',
            ];

            $this->validate($request, $rules, $customMessages);
            for ($x = 0; $x < count($optionList); $x++) {
                $checkProductRulesId = [];
                if (!empty($request->input('product_option_rules_id')[$x])) {
                    $checkProductRulesId = ProductOptionRules::find($request->input('product_option_rules_id')[$x]);
                }
                $type = !empty($request->option_list) ? $request->option_list[$x] : "0:0";
                $split = explode(':', $type);

                if (!empty($checkProductRulesId)) {
                    $checkProductRulesId->is_active =  !empty($request->is_rule_active[$x]) ? $request->is_rule_active[$x] : false;
                    $checkProductRulesId->type = !empty($split[0]) ? $split[0] : "";
                    $checkProductRulesId->type_id = !empty($split[1]) ? $split[1] : "";
                    $checkProductRulesId->operator = $request->option_operator[$x];
                    //                    $checkProductRulesId->min_width = $request->option_rule_min_width[$x];
                    //                    $checkProductRulesId->max_width = $request->option_rule_max_width[$x];
                    $checkProductRulesId->save();
                } else {
                    if (DB::table('product_option_rules')->where('type_id', $split)->doesntExist()) {
                        ProductOptionRules::create([
                            'product_id' => $id,
                            'option_id' => $request->input('product_option_id')[$x],
                            'is_active' => !empty($request->is_rule_active[$x]) ? $request->is_rule_active[$x] : false,
                            'type' => !empty($split[0]) ? $split[0] : "",
                            'type_id' => !empty($split[1]) ? $split[1] : "",
                            'operator' => $request->option_operator[$x],
                            //                            'min_width' => $request->option_rule_min_width[$x],
                            //                            'max_width' => $request->option_rule_max_width[$x],
                        ]);
                    } else {
                        $data = [
                            'id' => false,
                        ];
                        $customMessages = [
                            'error' => 'You can not use same option multiple time in your rules'
                        ];
                        Validator::make($data, [
                            'id' => 'error',
                        ], $customMessages);
                    }
                }
            }
        }

        return response()->json($option);
    }

    public function storePrice(Request $request, $id)
    {
    }
    public function updateSinglePrice(Request $request)
    {
        if (!empty($request->input('type')) && $request->input('type') === "width") {
            $prices = ProductPrice::where('width', $request->input('dataValue'))->where('product_id', $request->input('productId'))->get();
            foreach ($prices as $price) {
                $price->width = $request->value;
                $price->save();
            }
        } elseif (!empty($request->input('type')) && $request->input('type') === "height") {
            $prices = ProductPrice::where('height', $request->input('dataValue'))->where('product_id', $request->input('productId'))->get();
            foreach ($prices as $price) {
                $price->height = $request->value;
                $price->save();
            }
        } else {
            $price = ProductPrice::find($request->id);
            $price->price = $request->value;
            $price->save();
        }
        return response()->json($price);
    }

    public function measure(Request $request, $id)
    {

        // $request->validate([
        //     'installation_media_id' => 'file|mimes:pdf',
        //     'measure_media_id' => 'file|mimes:pdf',
        // ]);
        $checkMeasurement = ProductMeasurement::where('product_id', $id)->first();

        if (!empty($request->file('installation_media_id'))) {
            $request->validate([
                'installation_media_id' => 'file|mimes:pdf',
            ]);
            $installation_media_id = $this->helpers->uploadImage($request->file('installation_media_id'), 'product/measurement');
        } else {
            $installation_media_id = $checkMeasurement->installation_media_id ?? '';
        }

        if (!empty($request->file('measure_media_id'))) {
            $request->validate([
                'measure_media_id' => 'file|mimes:pdf',
            ]);
            $measure_media_id = $this->helpers->uploadImage($request->file('measure_media_id'), 'product/measurement');
        } else {
            $measure_media_id = $checkMeasurement->measure_media_id ?? null;
        }
        //return $measure_media_id;

        if (empty($checkMeasurement)) {
            $measurement = ProductMeasurement::create([
                'product_id' => $id,
                'installation_media_id' => $installation_media_id,
                'installation_media_id_2' => $request->input('installation_media_id_2'),
                'measure_media_id' => $measure_media_id,
                'content' => $request->input('content'),
            ]);
        } else {
            $measurement = ProductMeasurement::where('id', $checkMeasurement->id)->update(
                [
                    'installation_media_id' => $installation_media_id,
                    'installation_media_id_2' => $request->input('installation_media_id_2'),
                    'measure_media_id' => $measure_media_id,
                    'content' => $request->input('content'),
                    'content' => $request->input('content'),
                ]
            );
        }

        return response()->json($measurement);
    }
    public function shipping(Request $request, $id)
    {
        $request->merge([
            'product_id' => $id,
            'freight_surcharge' => json_encode($request->freight_surcharge),
            'heyblind_cost' => json_encode($request->heyblind_cost),
            'other_online_blind_cost' => json_encode($request->other_online_blind_cost),
        ]);
        $productShipping = ProductShipping::updateOrCreate($request->except('type'));

        return response()->json($productShipping);
    }
    public function price(Request $request)
    {
        $extensions = array("xls", "xlsx", "csv");
        $result = array($request->file('file')->getClientOriginalExtension());

        if (in_array($result[0], $extensions)) {
            $file = $request->file('file');
            $product = Product::find($request->input('id'));

            Excel::import(new ProductPriceImport($product), $file, 1);
            $allPrice = ProductPrice::select('id', 'product_id', 'width', 'height', 'price')->where('product_id', $request->input('id'))->get();
        } else {
            $allPrice = ['error' => 'The file must be a file of type: csv, xlsx, xls'];
        }
        return response()->json($allPrice);
    }


    public function getColors(Request $request)
    {
        $colors = Color::select('id', 'name', 'color_id')->where('color_group_id', $request->id)->get();

        return response()->json($colors);
    }

    public function getSubCategory(Request $request)
    {
        $colors = SubCategory::select('id', 'name')->where('category_id', $request->id)->get();

        return response()->json($colors);
    }

    public function storeColors(Request $request)
    {

        $RequestColors = $request->input('color');
        $result = [];
        $minWidth = !empty($request->input('min_width')) ? $request->input('min_width') : null;
        $maxWidth = !empty($request->input('max_width')) ? $request->input('max_width') : null;
        $rules = [
            //            'group' => 'required',
            'color' => 'required',
            'amount_percentage' => 'integer',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            //            'color_group_id.required' => 'Color Group Is Required.',
            'color_id.required' => 'Color Is Required.',
            'amount_percentage.integer' => 'Please add a valid number',
        ];

        $this->validate($request, $rules, $customMessages);

        if (!empty($RequestColors)) {
            foreach ($RequestColors as $requestColor) {
                $getColor = Color::find($requestColor);
                $productColors = ProductColor::where('color_id', $requestColor)->where('product_id', $request->input('id'))->get();
                if (!empty($productColors)) {
                    foreach ($productColors as $productColor) {
                        if (!empty($productColor->id) && (!empty($minWidth) && ($minWidth >= $productColor->min_wdth)) && (!empty($maxWidth) && ($maxWidth <= $productColor->max_wdth))) {
                            $result[] = [
                                'msg' => "You Have Already Added " . $productColor->color->name ?? "" . " Color Within This Width!"
                            ];
                        } elseif (!empty($productColor->id) && !empty($minWidth) && ($minWidth >= $productColor->min_wdth)) {
                            $result[] = [
                                'msg' => "You Have Already Added " . $productColor->color->name ?? "" . " Color Within This Min Width!"
                            ];
                        } elseif (!empty($productColor->id) && !empty($maxWidth) && ($maxWidth <= $productColor->max_wdth)) {
                            $result[] = [
                                'msg' => "You Have Already Added " . $productColor->color->name ?? "" . " Color Within This Max Width!"
                            ];
                        } elseif (!empty($productColor->id) && empty($maxWidth) && empty($minWidth)) {
                            $productColor->min_width = $minWidth;
                            $productColor->max_width = $maxWidth;
                            $productColor->save();
                            $result[] = [
                                'msg' => "You Have Already Added " . $productColor->color->name ?? "" . " Color!"
                            ];
                        } else {
                            $color = ProductColor::create([
                                'product_id' => $request->input('id'),
                                'color_group_id' => $getColor->color_group_id,
                                'color_id' => $requestColor,
                                'min_width' => $request->input('min_width'),
                                'max_width' => $request->input('max_width'),
                                'amount_percentage' => $request->input('amount_percentage')
                            ]);
                        }
                    }
                } else {
                    $color = ProductColor::create([
                        'product_id' => $request->input('id'),
                        'color_group_id' => $getColor->color_group_id,
                        'color_id' => $requestColor,
                        'min_width' => $request->input('min_width'),
                        'max_width' => $request->input('max_width'),
                        'amount_percentage' => $request->input('amount_percentage')
                    ]);
                }
                if (!empty($color)) {
                    $result[] = [
                        'msg' => "success",
                        'main_color_id' => $color->id,
                        'min_width' => !empty($color->min_width) ? $color->min_width : "",
                        'max_width' => !empty($color->max_width) ? $color->max_width : "",
                        'amount_percentage' =>  $color->amount_percentage ?? "",
                        'id' => !empty($color->color_id) ? $color->color_id : $getColor->color_id,
                        'vendor_name' =>  !empty($getColor->vendor_color_name) ? $getColor->vendor_color_name : "",
                        'vendor_color_id' =>  !empty($getColor->vendor_color_id) ? $getColor->vendor_color_id : "",
                        'name' =>  !empty($getColor->name) ? $getColor->name : "",
                        'color_group_name' =>  !empty($getColor->group->name) ? $getColor->group->name : "",
                        'color_id' =>  !empty($getColor->color_id) ? $getColor->color_id : "",
                        'color_image_id' =>  $this->helpers->getThumbnail($getColor->color_image_id),
                        'feature_image_id' =>  $this->helpers->getThumbnail($getColor->feature_image_id),
                    ];
                }
            }
        }
        return response()->json($result);
    }

    public function updatePercentage(Request $request)
    {
        return $request->all();
    }
    public function destroy(Product $product)
    {
        $delete = $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfull.'
        ]);
    }
    public function destroyColors(Request $request)
    {

        $color = ProductColor::findOrFail($request->id);
        $color->delete();

        return response()->json($color);
    }
    public function optionRemove(Request $request)
    {
        $rules = ProductOptionRules::findOrFail($request->id);
        $rules->delete();
        return response()->json($rules);
    }

    public function seo(Request $request)
    {
        $rules = [
            'og_image' => 'mimes:jpg,jpeg,png',
        ];
        $customMessages = [
            'og_image.mimes' => 'The Supported Mimes Type jpg,png,jpeg',
        ];
        $this->validate($request, $rules, $customMessages);

        $seo = $this->helpers->StoreSEO($request, $request->id, 'product');
        return response()->json($seo);
    }

    public function removeMedia(Request $request)
    {
        $product = Product::findOrFail($request->pId);

        if ($request->input('type') === "display") {
            $product->display_media_id = null;
        } elseif ($request->input('type') === "slider") {
            $decodeArray = json_decode($product->slider_id, true);
            if (($key = array_search($request->input('id'), $decodeArray)) !== false) {
                unset($decodeArray[$key]);
            }
            $product->slider_id = json_encode($decodeArray, true);
        } elseif ($request->input('type') === "video") {
            $decodeArray = json_decode($product->video_id);
            if (($key = array_search($request->input('id'), $decodeArray)) !== false) {
                unset($decodeArray[$key]);
            }
            $product->video_id = json_encode($decodeArray, true);
        }

        $product->save();
    }

    public function showHomePageStatus(Request $request)
    {
        $porduct = Product::where('id', $request->product_id)->first();
        if ($porduct->show_home_page == 1) {

            Product::where('id', $request->product_id)->update(['show_home_page' => 0]);
        } else {
            Product::where('id', $request->product_id)->update(['show_home_page' => 1, 'updated_at' => \Carbon\Carbon::now()]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]);
    }
    public function tooltips(Request $request)
    {
        //
        Tooltip::updateOrCreate([
            'product_id' => $request->product_id,

        ], [
            'product_id' => $request->product_id,
            'blind_guarantee' => $request->blinds_guarantee,
            'riight_fit_guarantee' => $request->riight_fit_guarantee,
            'devlivery_time' => $request->devlivery_time,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Updates successfully."
        ]);
    }
    public function removeMeasureMedia(Request $request)
    {
        $media = Media::find($request->media_id);
        if ($media) {
            $measure = ProductMeasurement::where('product_id', $request->product_id)->first();
            $measure->delete();
            $media->delete();
            return response()->json([
                'status' => true,
                'message' => "Successfully deleted."
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Something went wrong"
        ]);
    }

    public function homeMediaForm(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        //return $request->all();
        if ($product) {
            if (!empty($request->file('home_media_id'))) {
                $media_id = $this->helpers->uploadImage($request->file('home_media_id'), 'product');
                $product->update(['home_media_id' => $media_id]);
            }
            if (!empty($request->input('product_home_image_alt_title'))) {
                $product->update(['product_home_image_alt_title' => $request->input('product_home_image_alt_title')]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Image uploaded successfully.'
            ]);
        }
    }
}
