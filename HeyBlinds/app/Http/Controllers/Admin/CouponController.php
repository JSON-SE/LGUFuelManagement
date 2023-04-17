<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category\Category;
use App\Http\Resources\CouponResource;
use App\Models\Admin\Coupon\AssignCoupon;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Product\Product;
use App\Rules\CheckStartDate;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        
        if($request->ajax()){
            $coupons = Coupon::query()->orderByDesc('start_date');
            return DataTables::of($coupons)
                    ->addIndexColumn()
                    ->addColumn('icon',function($row){
                        return '<img src="'.$this->helpers->getThumbnail($row['icon']).'" style="width:70px">';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a class="btn text-secondary" href="'.route('admin.coupons.edit',$row['id']).'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /><path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" /></svg></a>';
                        $btn = $btn.'<button class="btn" type="button" onclick="deleteCoupon('.$row['id'].')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'icon'])
                    ->make(true);
                
        }
        return view('admin.coupons.index');
        
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $products = Product::select('id', 'name')->get();
        return view('admin.coupons.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'code' => ['required', 'unique:coupons'],
            'name' => ['required'],
            'amount' => 'required|numeric|gt:0',
            'min_amount' => 'nullable|numeric|gt:0',
//            'start_date' => ['required', new CheckStartDate()],
//            'end_date' => 'required|date|after:start_date',
            'icon' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            'description' => ['required']
        ],[
            'amount.required' => 'The discount amount is required',
            'amount.numeric' => 'The discount amount must be numeric',
            'amount.gt' => 'The discount amount must be greater than zero',
        ]
    );


        $helper = new Helpers;

        $data = $request->all();
        unset($data['category_id']);
        unset($data['product_id']);

        $data['is_active'] = $request->is_active ?? "0";

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            ]);

            $fileName = $helper->uploadImage($request->file('icon'), 'coupon');
            $request->merge([
                'icon' => $fileName
            ]);
            $data['icon'] = $fileName;
        }

        $coupon = Coupon::create($data);

        if ($coupon) {

            if ($request->has('category_id')) {
                foreach ($request->category_id as $category_id) {
                    AssignCoupon::create([
                        'coupon_id' => $coupon->id,
                        'category_id' => $category_id,
                    ]);
                }
            }

            if ($request->has('product_id')) {
                foreach ($request->input('product_id') as $product_id) {
                    AssignCoupon::create([
                        'coupon_id' => $coupon->id,
                        'product_id' => $product_id,
                    ]);
                }
            }

            $request->session()->flash('message', 'Coupon Added Successfully');
            return redirect()->route('admin.coupons.index');
            // return redirect()->back();

            return response()->json([
                'message' => "Category Added Successfully",
                'id' => $coupon->id,
            ], 201);
        } else {
            $request->session()->flash('message', 'Coupon adding Failed');
            return redirect()->back();
        }
    }

    public function edit(Coupon $coupon)
    {
        $categories = Category::select('id', 'name')->get();
        $products = Product::where('is_live', 1)
        ->where('draft', 0)
        ->where('display_media_id', '!=', NULL)
        ->get();

        $helper = new Helpers;
        $url = $helper->getThumbnail($coupon->icon);

        $categoryIds =  $coupon->assignCoupons()->where('category_id', '!=', null)->pluck("category_id")->toArray();
        $productIds =  $coupon->assignCoupons()->where('product_id', '!=', null)->pluck('product_id')->toArray();

        return view('admin.coupons.edit', compact('categories', 'products', 'coupon', 'categoryIds', 'productIds','url'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        //return $request->all();
        request()->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'name' => 'required|string',
            'amount' => 'required|numeric|gt:0',
            'min_amount' => 'nullable|numeric|gt:0',
//            'start_date' => ['required'],
//            'end_date' => 'required|date|after:start_date',
            'icon' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            'description' => ['required'],
        ],[
             'amount.required' => 'The discount amount is required',
            'amount.numeric' => 'The discount amount must be numeric',
            'amount.gt' => 'The discount amount must be greater than zero',
        ]);

        $data = $request->all();
        unset($data['category_id']);
        unset($data['product_id']);
        unset($data['icon']);

        $data['with_promo'] = $request->with_promo ?? "0";
        $data['pre_applied'] = $request->pre_applied ?? "0";
        $data['is_active'] = $request->is_active ?? "0";

        if ($request->hasFile('icon')) {

            $request->validate([
                'icon' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            ]);

            $helper = new Helpers;

            $fileName = $helper->uploadImage($request->file('icon'), 'coupon');

            $request->merge([
                'icon' => $fileName
            ]);

            $data['icon'] = $fileName;
        }

        $updateCoupon = $coupon->update($data);

        if ($updateCoupon) {

            AssignCoupon::where('coupon_id', $coupon->id)->where("category_id", '!=', null)->delete();

            if ($request->has('category_id')) {
                foreach ($request->category_id as $category_id) {
                    AssignCoupon::create([
                        'coupon_id' => $coupon->id,
                        'category_id' => $category_id,
                    ]);
                }
            }

            AssignCoupon::where('coupon_id', $coupon->id)->where("product_id", '!=', null)->delete();

            if ($request->has('product_id')) {

                foreach ($request->product_id as $product_id) {
                    AssignCoupon::create([
                        'coupon_id' => $coupon->id,
                        'product_id' => $product_id,
                    ]);
                }
            }

            $request->session()->flash('message', 'Coupon Updated Successfully');
            return redirect()->route('admin.coupons.index');
        } else {
            $request->session()->flash('message', 'Coupon Update Failed');
            return redirect()->back();
        }
    }

    public function destroy(Coupon $coupon)
    {
        $delete = $coupon->delete();
        return response()->json([
            'status' => true,
            'message' => "Successfully deleted."
        ]);
    }
}
