<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon\Coupon;
use App\Models\SubcriberCopoun;
use Illuminate\Http\Request;

class SubcriberCouponController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons  = Coupon::where('coupon_type','modal')->paginate('20');
        return view('admin.subcriber-modal.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcriber-modal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required|unique:coupons,code',
            'name' => 'required',
            'amount' => 'required|numeric|gt:0',
            'min_amount' => 'nullable|numeric|gt:0',
//            'start_date' => ['required', new CheckStartDate()],
//            'end_date' => 'required|date|after:start_date',
            'icon' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            'description' => 'required',
        ],[
            'code.unique' => 'coupon code must be unique',
            'amount.required' => 'The discount amount is required',
            'amount.numeric' => 'The discount amount must be numeric',
            'amount.gt' => 'The discount amount must be greater than zero',
        ]);

        Coupon::create([
            'code'  => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'icon' => $this->helpers->uploadImage($request->file('icon'), 'subcriber_copouns')?? '',
            'amount' => $request->amount,
            'min_amount' => $request->min_amount,
            'start_date' => $request->start_date,
            'end_date'  => $request->end_date,
            'coupon_use' => $request->coupon_use,
            'coupon_for' => $request->coupon_for,
            'is_active' => $request->is_active,
            'description' => $request->description,
            'coupon_type' => 'modal'
        ]);

        return redirect()->route('admin.modal-coupons.index')->with('message','Coupon created successfully');

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
        $coupon  = Coupon::findOrfail($id);
        return view('admin.subcriber-modal.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        request()->validate([
            'code' => 'required|unique:coupons,code,'.$id,
            'name' => 'required',
            'amount' => 'required|numeric|gt:0',
            'min_amount' => 'nullable|numeric|gt:0',
//            'start_date' => ['required', new CheckStartDate()],
//            'end_date' => 'required|date|after:start_date',
            'icon' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg|max:2048',
            'description' => 'required'
        ],[
            'amount.required' => 'The discount amount is required',
            'amount.numeric' => 'The discount amount must be numeric',
            'amount.gt' => 'The discount amount must be greater than zero',
        ]);

        Coupon::where('id',$id)->update([
            'code'  => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'icon' => $this->helpers->uploadImage($request->file('icon'), 'subcriber_copouns') ?? '',
            'amount' => $request->amount,
            'min_amount' => $request->min_amount,
            'start_date' => $request->start_date,
            'end_date'  => $request->end_date,
            'coupon_use' => $request->coupon_use,
            'coupon_for' => $request->coupon_for,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.modal-coupons.index')->with('message','Coupon updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $coupon = Coupon::where('id',$id)->firstOrFail();
        $coupon->delete();
        return redirect()->route('admin.modal-coupons.index')->with('message','Coupon deleted successfully');
    }
}

