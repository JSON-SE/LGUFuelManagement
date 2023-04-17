<?php

namespace App\Http\Controllers;

use App\Models\Admin\Coupon\Coupon;
use App\Models\Admin\Customer\BillingAddress;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Admin\Order\Order;
use App\Models\Front\Cart\Cart;
use App\Models\Front\Cart\CartItem;
use App\Models\Profile;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('prevent-back-history');

    }

    public function index()
    {
        $auth_id = Auth::id();
        $carts = Cart::where('user_id', $auth_id)->where('cart_draft', 1)->get();
        $orders = Order::where('user_id', $auth_id)->whereHas('cart')->get();
        // Order::where('user_id', $auth_id)->count();
        return view('user.index', compact('carts', 'orders'));
    }
    public function cart()
    {
        $auth_id = Auth::id();
        $carts = Cart::where('user_id', $auth_id)->where('cart_draft', 1)->get();
        return view('user.cart', compact('carts'));
    }

    public function account()
    {
        return view('user.account');
    }

    public function updateProfile(Request $request)
    {
        $auth_id = Auth::id();
        request()->validate([
            'first_name' => ['required','regex:/(^([a-zA-z]+)(\d+)?$)/u'],
            'last_name' => ['nullable','regex:/(^([a-zA-z]+)(\d+)?$)/u'],
            'phone_number' => ['required','min:16'],
            'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,'.$auth_id,
            'shipping_street' => ['required','regex:/^[\s\.\,\w-]*$/'],
            'shipping_city' => ['required','regex:/^[\s\.\,\w-]*$/'],
            'shipping_province' => ['required'],
            'postal_code' => ['required','regex:/^[\s\w-]*$/'],
        ],[
            'shipping_street.regex' => 'The street address is invalid.',
            'phone_number.min' => 'The phone number is invalid.'
        ]);

        User::find($auth_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);
       $find =  Profile::where('user_id',$auth_id)->first();

       if(empty($find)){
            Profile::create([
                'user_id' => $auth_id,
                'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->phone_number)),
                'street' => $request->shipping_street,
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'province' => $request->shipping_province,
                'postal_code' => $request->postal_code,
           ]);
        }
        else{
         Profile::where('user_id',$auth_id)->update([
            'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->phone_number)),
            'street' => $request->shipping_street,
            'address' => $request->shipping_address,
            'city' => $request->shipping_city,
            'province' => $request->shipping_province,
            'postal_code' => $request->postal_code,
       ]);
    }
        return  redirect()->back()->with('success', 'Account updated successfully.');
    }
    public function update(Request $request)
    {
        $auth_id = Auth::id();
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
            'confirm_password' => ['required','same:new_password'],
        ],[
            'new_password.min' => 'The password must be at least 8 characters long',
        ]);
        User::find($auth_id)->update(['password' => Hash::make($request->new_password)]);
        return  redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function cartPageShow($id)
    {
        $auth_id = Auth::id();
        $cart =  Cart::where('external_id', $id)->firstOrFail();
        $billingAddress = BillingAddress::where('cart_id', $cart->id)->first();
            
        $shippingAddress = ShippingAddress::where('cart_id', $cart->id)->first();

        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        $sumOfQty = CartItem::where('cart_id', $cart->id)->sum('quantity');

        $purchasePrice = CartItem::where('cart_id', $cart->id)->sum('purchase_price');

        $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
        $order = Order::where('cart_id',$cart->id)->latest()->first();

        $totalSave = $cart->cart_total_price - $cart->cart_amount;

        return view('user.cartDeatils', compact('billingAddress', 'shippingAddress',
                                                'cartItems', 'sumOfQty', 'purchasePrice',
                                                 'cart', 'coupon','totalSave','order'));
    }
}
