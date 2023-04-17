<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AddressLabelsExport;
use App\Exports\SampleDrawersExport;
use App\Exports\SampleInventoryExport;
use App\Exports\SampleOrderExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleOrderResource;
use App\Mail\OrderConfirmation;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Admin\Order\OrderStatus;
use App\Models\Admin\Order\SampleOrder;
use App\Models\Admin\Order\SampleOrderEntries;
use App\Models\Admin\Order\SampleOrderNote;
use App\Models\User;
use App\Notifications\OrderShippingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Yajra\Datatables\Datatables;


class SampleOrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = SampleOrder::orderByDesc('created_at')->paginate(15);
        $orderStatus = OrderStatus::all();
         return view('admin.sample.index',compact('orders','orderStatus'));
        //return view('admin.sample.order-management',compact('orders','orderStatus'));
    }
    /**
     * Search data of samplae useing datatable
     *
     * @param Request $request
     *
     * @return Json
     */

    public function orderInfo(Request $request){
        $orders = SampleOrder::query()->orderByDesc('created_at');
        if($request->status_search){
            $orders->where('order_status',$request->status_search);
        }
        if($request->day_range){
            $date = \Carbon\Carbon::today()->subDays($request->day_range);
            $orders->where('created_at','>=',$date);
        }
        if($request->date_range){
            $date = explode('/' ,$request->date_range);
            $fromDate  = date("Y-m-d", strtotime($date[0] ?? ' '));
            $toDate = date("Y-m-d",strtotime($date[1] ?? ' '));
            $orders->whereBetween('created_at',[$fromDate. ' 00:00:00', $toDate.' 23:59:59']);
        }


        return DataTables::of(SampleOrderResource::collection($orders->get()))
        ->addIndexColumn()
        ->addColumn('icon', function ($row) {
           $icon =  '<img src ="'.$row['order_icon'].'">';
            return $icon;
        })

        ->addColumn('user', function ($row) {
            return '<span class="text-success pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path><path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path></svg></span>';
           
        })
        ->addColumn('status', function ($row) {
            if($row['order_status'] <= 5){
                return '<button type="button" class="btn btn-sm status-pending-btn status-btn" data-toggle="tooltip" data-placement="top" title="'.$row['status_name'].'"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16"> <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" /><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" /><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" /></svg></button>';
            }
            elseif ($row['order_status'] == 8){
                return '<button type="button" class="btn btn-sm status-confirmed-btn status-btn" data-toggle="tooltip" data-placement="top"  title="'.$row['status_name'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" /></svg></button>';
            }
            else{
                return '<button type="button" class="btn btn-sm status-cancelled-btn" data-toggle="tooltip" data-placement="top" title="'.$row['status_name'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" /></svg></button>';
            }
        })
        ->addColumn('action', function ($row) {
            return  '<a href="'.route('admin.samples.show', $row['id']).'" class="order-view-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" /> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg></a>';
        })
        ->setRowClass(function ($row) {
            $color = '';
            if($row['more_than_day'] == true){
                $color = 'bg-light-warning';
            }
            if($row['more_than_order'] == true){
                $color =  'alert-success';
            }
            return $color;
        })
        ->rawColumns(['action','status','user','icon'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::first();
        Mail::to($user)->send(new OrderConfirmation());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Order\SampleOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function show(SampleOrder $order,$id)
    {
        $order = SampleOrder::where("id",$id)->first();
        $address = ShippingAddress::where("sample_cart_external_id",$order->sample_cart_external_id)->first();
        $orderStatus = OrderStatus::all();
        $status = OrderStatus::where('id',$order->order_status)->pluck('name')->first();
        return view('admin.sample.order-details',compact('order','orderStatus','status','address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Order\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(SampleOrder $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Order\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SampleOrder $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Order\SampleOrder  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(SampleOrder $order)
    {
        //
    }

    public function note(Request $request){

        $note = SampleOrderNote::create([
            "sample_order_id"=>$request->order_id,
            "receiver"=>$request->receiver,
            "note"=>$request->note,
        ]);

        if($note){
            return response()->json([
                'status'=>true,
                'message'=>"Note Saved Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }


    public function changeOrderStatus(Request $request){
        $request->validate([
            'order_id' => 'required',
            'status' => 'required|integer',
        ]);


        $order = SampleOrder::where('id',$request->order_id)->first();

        $status = $order->order_status;

        $update = $order->update(['order_status'=>$request->status]);

        if($request->status == 7){

            $shipping = $order->shipping_type == 0 ? "Canada Post" : "Xpresspost";
            $address = ShippingAddress::where("sample_cart_external_id",$order->sample_cart_external_id)->first();
            Notification::route('mail', $address->email)->notify(new OrderShippingNotification($order,$address,$shipping));

        }


        if($update){
            $message = Auth::guard('admin')->user()->name. " Changed the Sample Order ID ".$order->order_id." Status From ".$status." to ".$order->order_status;
            Log::info($message);
            return response()->json([
                'status'=>true,
                'message'=>"Status Changed Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }

    public function changeShippingMethod(Request $request){
        $request->validate([
            'order_id' => 'required',
            'shipping' => 'required',
        ]);


        $order = SampleOrder::where('id',$request->order_id)->first();

        $status = $order->delivery;

        $update = $order->update(['shipping_type'=>$request->shipping]);

        if($update){
            $message = Auth::guard('admin')->user()->name. " Changed the Sample Order ID ".$order->order_id." Shipping Method From ".$status." to ".$order->delivery;
            Log::info($message);
            return response()->json([
                'status'=>true,
                'message'=>"Status Changed Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }

    public function changeShippingDate(Request $request){
        $request->validate([
            'order_id' => 'required',
            'shippingDate' => 'required',
        ]);
        $order = SampleOrder::where('id',$request->order_id)->first();
        $status = $order->order_shipped;
        $update = $order->update(['order_shipped'=>$request->shippingDate]);

        if($update){
            $message = Auth::guard('admin')->user()->name. " Changed the Sample Order ID ".$order->order_id." Shipping Date From ".$status." to ".$order->order_shipped;
            Log::info($message);
            return response()->json([
                'status'=>true,
                'message'=>"Status Changed Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }


    public function changeShippingTrackingNumber(Request $request){
        $request->validate([
            'order_id' => 'required',
            'trackingNumber' => 'required',
        ]);

        $order = SampleOrder::where('id',$request->order_id)->first();
        $status = $order->order_tracking_number;

        $update = $order->update(['order_tracking_number'=>json_encode(array($request->trackingNumber))]);

        if($update){
            $message = Auth::guard('admin')->user()->name. " Changed the Sample Order ID ".$order->order_id." Tracking Number From ".$status." to ".$order->order_tracking_number;
            Log::info($message);
            return response()->json([
                'status'=>true,
                'message'=>"Status Changed Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }


    public function deleteOrderEntry(Request $request){
        $request->validate([
            'order_id' => 'required',
            'entry_id' => 'required|integer',
        ]);

        $entry = SampleOrderEntries::where('id',$request->entry_id)->where('order_id',$request->order_id)->first();
        $delete = $entry->delete();

        if($delete){

            $message = Auth::guard('admin')->user()->name. " Removed the Order Entry ID ".$entry;
            Log::info($message);

            return response()->json([
                'status'=>true,
                'message'=>"Entry Deleted Successfull"
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }
    /**
     * Sample order export
     *
     * @param Request $request
     *
     * @return Excel::XLSX
     */

    public function export(Request $request)
    {

        $status_search = $request->status_search;
        $day_range = '';
        $fromDate = '' ;
        $toDate = '';
        if($request->day_range){
            $day_range = \Carbon\Carbon::today()->subDays($request->day_range);
        }
        if($request->date_range){
            $date_range = explode('/' ,$request->date_range);
            $fromDate  = date("Y-m-d", strtotime($date_range[0] ?? ' '));
            $toDate = date("Y-m-d",strtotime($date_range[1] ?? ' '));
        }
        if($request->export_report == 'order_report'){
        return (new SampleOrderExport($status_search,$day_range, $fromDate ,$toDate))
            ->download('sample-order.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
        elseif($request->export_report == 'address_label'){
            return (new AddressLabelsExport($status_search,$day_range, $fromDate ,$toDate))->download('sample-address-label.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
        else{
            return (new SampleInventoryExport($status_search,$day_range, $fromDate ,$toDate))->download('sample-inventory.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    }
}
