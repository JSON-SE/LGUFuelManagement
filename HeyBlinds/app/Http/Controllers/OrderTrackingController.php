<?php

namespace App\Http\Controllers;

use App\Models\Admin\Order\Order;
use App\Rules\CheckEmailOnBilling;
use App\Rules\OrderIDExist;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    /**
     * Display the order tracking page
     *
     * @return View
     */
    public function index(){
    	return view('frontend.tracking.index');
    }
    /**
     * Check the  order status of product
     *
     * @param Request $request
     *
     * @return Response $response
     */
    public function checkOrderStatus(Request $request){
    	$request->validate([
    		'order_number' => ['required',new OrderIDExist],
    		'email' => ['required','email',new CheckEmailOnBilling]
    	]);
    	try{
            $order = Order::where('order_id',$request->order_number)->first();
            $status = '';
            if($order->order_status){
                if($order->order_status == 1){
                    $status = 'On Hold';
                }
                else if($order->order_status == 2){
                    $status = 'Review';
                }
                else if($order->order_status == 3){
                    $status = 'Export';
                }  
                else if($order->order_status == 4){
                    $status = 'Approved';
                } 
                else if($order->order_status == 5){
                    $status = 'In Progress';
                } 
                else if($order->order_status == 6){
                    $status= 'Packed';
                } else if($order->order_status == 7){
                    $status = 'Shipped';
                } else if($order->order_status == 8){
                    $status = 'Delivered';
                } else if($order->order_status == 9){
                    $status = 'Cancelled';
                }
            }
            return response()->json([
                'status' => true,
                'order_id' => $order->order_id,
                'order_status' => $status,
                'expected_date' => $this->helpers->estimatedShippingDate($order->created_at->format('Y-m-d')),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }
}
