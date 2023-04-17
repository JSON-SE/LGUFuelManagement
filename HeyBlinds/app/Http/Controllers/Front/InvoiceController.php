<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customer\BillingAddress;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Front\Cart\Cart;
use App\Models\Front\Cart\CartItem;
use App\Notifications\InvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Order\Order;

class InvoiceController extends Controller
{
    public function sendInvoiceInEmail($id){

        $cart =  Cart::where('external_id',$id)->firstOrFail();

        $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');

        $billingAddress = BillingAddress::where('cart_id',$cart->id)->first();

        $shippingAddress = ShippingAddress::where('cart_id',$cart->id)->first();

        $cartItems = CartItem::where('cart_id',$cart->id)->get();

        $sumOfQty = CartItem::where('cart_id',$cart->id)->sum('quantity');

        $purchasePrice = CartItem::where('cart_id',$cart->id)->sum('purchase_price');
        $order = Order::where('cart_id',$cart->id)->latest()->first();
        $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
        $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
        // Notification::route('mail', $shippingAddress->email)

        //     ->notify(new InvoiceNotification(
        //         $billingAddress,$shippingAddress,
        //         $cartItems,$sumOfQty,$purchasePrice, 
        //         $cart,$coupon,$cartItemsCount,
        //         $order,
        //         $promo_items
        //     ));

        return redirect()->back()->with('message','Copy of Order Has Been Emailed..');
    }


    public function invoiceDownload($id){

        $cart =  Cart::where('external_id', $id)->firstOrFail();
        $billingAddress = BillingAddress::where('cart_id', $cart->id)->first();
        $shippingAddress = ShippingAddress::where('cart_id', $cart->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $sumOfQty = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $purchasePrice = CartItem::where('cart_id', $cart->id)->sum('purchase_price');
        $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
        $totalSave = $cart->cart_total_price - $cart->cart_amount;

       $orderId = Order::where("cart_id",$cart->id)->value("order_id");
        $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
       $pfdNmae = $orderId.".pdf";
     
        // $pdf = PDF::setOptions([
        //     'images' => true,
        // ])->loadView('frontend.invoice.invoice-pdf',compact('billingAddress','shippingAddress','cartItems','sumOfQty','purchasePrice','cart','coupon'));
        $pdf = PDF::setOptions([
            'images' => true,
        ])->loadView('frontend.invoice.invoice-pdf',compact('billingAddress', 'shippingAddress', 'cartItems', 'sumOfQty', 'purchasePrice', 'cart', 'coupon','totalSave', 'orderId','promo_items'));
            return $pdf->download($pfdNmae);

    }

    public function testInvoice(){
        return view('frontend.invoice.test-invoice');
    }
}
