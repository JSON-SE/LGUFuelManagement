<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\OrderConfirmation;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Customer\BillingAddress;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Admin\Order\Note;
use App\Models\Admin\Order\Order;
use App\Models\Admin\Order\OrderStatus;
use App\Models\Admin\Order\OrderTransactionEntry;
use App\Models\Front\Cart\Cart;
use App\Models\Front\Cart\CartItem;
use App\Models\Province;
use App\Models\User;
use App\Notifications\OrderShippingNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class Ordercontroller extends Controller
{
    public function index(Request $request)
    {
        //return $this->showOrderInfo($request);
        $orderStatus = OrderStatus::all();
        return view('admin.order.index',compact('orderStatus'));
    }
    public function showOrderInfo(Request $request){
        $orders = Order::query()->orderByDesc('created_at');
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
        return DataTables::of(OrderResource::collection($orders->get()))
        ->addIndexColumn()
        ->addColumn('icon',function($row){
                    $icon =  '<span><img src="'.asset('admin/images/icon1.png').'"/></span>';
                    if ($row['order_count'] > 1){
                        $icon = $icon.'<span><img src="'.asset('admin/images/icon2.png').'"/></span>';
                    }
                    if($row['grand_total_price'] > 1000){
                        $icon = $icon.'<span><img src="'.asset('admin/images/icon3.png').'"/></span>';
                    }
                    $icon = $icon.'<span><img src="'.asset('admin/images/icon4.png').'"/></span>';
                return  $icon;
        })
         ->addColumn('tota_amount',function($row){
            return '$'.$this->helpers->grand_total_amount($row['cart_id']);
         })
        ->addColumn('created_at',function($row){
            return $row['created_at_time']. '('.$row['created_at_human'].')';
        })
        ->addColumn('user',function($row){
                return '<h5 class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" /><path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" /></svg></h5>';
        })
        ->addColumn('status', function ($row) {
            if($row['order_status'] <= 5){
                return '<button type="button" class="btn btn-sm status-pending-btn status-btn" data-toggle="tooltip" data-placement="top" title="'.$row['status_name'].'"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16"> <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" /><path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" /><path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" /></svg></button>';
            }
            elseif ($row['order_status'] == 6){
                return '<button type="button" class="btn btn-sm status-confirmed-btn status-btn" data-toggle="tooltip" data-placement="top"  title="'.$row['status_name'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" /></svg></button>';

            }elseif($row['order_status'] == 10){
                return '<span class=" badge-primary tex-danger">Transaction failed.</span>';
            }
            else{
                return '<button type="button" class="btn btn-sm status-cancelled-btn" data-toggle="tooltip" data-placement="top" title="'.$row['status_name'].'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" /><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" /></svg></button>';
            }
        })
        ->addColumn('action', function ($row) {
            return  '<a href="'.route('admin.order.show', $row['id']).'" class="order-view-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" /> <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg></a>';
        })
       ->setRowClass('{{ $color_status == true ? "bg-light-warning" : "" }}')
        ->rawColumns(['action','tota_amount','user','icon','status'])
        ->make(true);
    }
    public function create()
    {
        $user = User::first();
        Mail::to($user)->send(new OrderConfirmation());
    }

    public function show(Order $order)
    {
        $shippingAddress = ShippingAddress::where('cart_id',$order->cart_id)->first();
        $billingAddress = BillingAddress::where('cart_id',$order->cart_id)->first();
        $cart =  Cart::where('id', $order->cart_id)->firstOrFail();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $sumOfQty = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $purchasePrice = CartItem::where('cart_id', $cart->id)->sum('purchase_price');
        $totalSave = $cart->cart_total_price - $cart->cart_amount;
        $orderStatus = OrderStatus::all();
        $proviences = Province::all();
        $status = OrderStatus::where('id',$order->order_status)->pluck('name')->first();
        $total_tax_amount = ($cart->cart_amount - $cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
        $tax = json_decode($cart->cart_tax,true) ?? [];
        $tatal_tax = array_sum(array_values($tax));
        $total_tax_amount = 0;
        foreach ($tax as $key => $value){
            $amount = (float)(( ($total_tax_amount) * $value ) / 100);
            $total_tax_amount = (float)((($total_tax_amount) * $tatal_tax ) / 100);
        }
        return view('admin.order.show',compact('order','orderStatus','shippingAddress','billingAddress','status','cartItems','purchasePrice','totalSave','cart','total_tax_amount','proviences'));
    }


    public function note(Request $request){

        $note = Note::create([
            "order_id"=>$request->order_id,
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

        $order = Order::where('id',$request->order_id)->first();

        $status = $order->order_status;

        $update = $order->update(['order_status' => $request->status]);
        if($request->is_email_active == 'true' && $request->status == 7){
            $trackingNumber = $order->update(['order_tracking_number' => json_encode($request->trackingNumber)]);
            $shipping = "";
            $address = $order->shippingAddress;
            Notification::route('mail', $address->email)->notify(new OrderShippingNotification($order,$address,$shipping));
        }

        if($update){
            $message = Auth::guard('admin')->user()->name. " Changed the Order ID ".$order->order_id." Status From ".$status." to ".$order->order_status;
            Log::info($message);
            return response()->json([
                'status'=>true,
                'message'=>"Status Changed Successfull",
                'trackingUpdate' => @$trackingNumber
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'message'=>"Something Went Wrong"
            ]);
        }
    }


    public function deleteOrderEntry(Request $request){;

        $request->validate([
            'order_id' => 'required',
            'entry_id' => 'required|integer',
        ]);

        $entry = CartItem::where('id',$request->entry_id)->first();

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
                'status'=>false,
                'message'=>"Something Went Wrong"
            ]);
        }
    }


    public function updateOrderEntry(Request $request){
        $cartItem = CartItem::where('id',$request->id)->first();
        $order = Order::where('cart_id',$cartItem->cart_id)->first();
        $width = '';
        $height = '';
        if($request->option_width){
            $width = $request->option_width;
        }
        if($request->option_height){
            $height = $request->option_height;
        }

        if($request->option_width_fraction != '0/0'){
            $width = $width +1;  
        }
        if($request->option_height_fraction != '0/0'){
            $height = $height + 1;  
        }
        $product_price = $cartItem->product->afterOrderProductPrice($cartItem->product_id, $width,$height,$cartItem->id);
         //$product_price = $cartItem->product->getProductPrice($cartItem->product_id, $width,$height);
         
        DB::beginTransaction();
        if($request->quantity){
            $cartItem->quantity = $request->quantity;
            $cartItem->unit_price = (float)$product_price['productPrice'] * (int)$request->quantity; 
            $cartItem->purchase_price = $product_price['price'] * (int)$request->quantity;
            $cartItem->sub_total = (float)$product_price['price'] * (int)$request->quantity;
           if($cartItem->promo_type == 'percentage'){
                $promo_price = ($cartItem->unit_price * $cartItem->promo_discount)/100;
                $cartItem->promo_price = $promo_price;
           }
            $cartItem->save();

            $cart = Cart::where('id',$cartItem->cart_id)->first();
            $totalPurchasePrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('sub_total');
            $totalUnitPrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('unit_price');
         
            $cart->cart_amount = (float)$totalPurchasePrice;
            $cart->cart_total_price = (float) $totalUnitPrice;
            if($cart->coupon_type == 'percentage'){
                 $discountPrice = (float) ($cart->cart_amount * $cart->discount) / 100;
                 $cart->cart_item_discount = $discountPrice;
            }
            elseif($cart->coupon_type == 'fixed_amount'){
                $discountPrice = (float)$cart->discount;
                $cart->cart_item_discount = $discountPrice;
            }
            $cart->save();
        }
          
        $cartItem->update([
            "option_value->total_price"=> $cartItem->sub_total,
            "option_value->unit_price"=> $cartItem->unit_price,
            "option_value->measurement_price"=> $cartItem->unit_price,
            "option_value->option_color"=> $request->option_color,
            "option_value->option_width"=> $request->option_width,
            'option_value->option_height' => $request->option_height,
            "option_value->option_width_fraction"=>$request->option_width_fraction,
            "option_value->option_height_fraction"=>$request->option_height_fraction,
        ]);
        DB::commit();
        $tax = json_decode($cart->cart_tax,true) ?? [];
        $totalAmount = $cart->cart_amount - $cart->cart_item_discount;

        foreach ($tax as $key => $value ){
            $amount = $this->helpers->withoutRounding(( (($cart->cart_amount - $cart->cart_item_discount) * $value ) / 100),2);
            $totalAmount += $amount;
        }
        $message = Auth::guard('admin')->user()->name. " Removed the Order Entry ID ";
        Log::info($message);
       // return $cart;
        return response()->json([
            'status'=>true,
            'message'=>"Entry Updated Successfully",
            'item' => number_format($cartItem->purchase_price,2),
            'subTotal' => number_format($cart->cart_total_price,2),
            'totalDiscount' => number_format($cart->cart_total_price - $cart->cart_amount,2),
            'your_price' => number_format($cart->cart_amount - $cart->cart_item_discount, 2),
            'total' =>  number_format($totalAmount ,2)
        ]);
    
    }
    
    /**
     * Export the order repoert
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
        
        return (new OrderExport($status_search, $day_range, $fromDate,$toDate))
            ->download( 'order.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        
        
    }


}
