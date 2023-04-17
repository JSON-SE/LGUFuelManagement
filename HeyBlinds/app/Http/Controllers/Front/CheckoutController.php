<?php

namespace App\Http\Controllers\Front;


use App\Models\User;
use App\Helpers\Helpers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NewOrderReceived;
use App\Rules\EmailExistOrNot;
use App\Rules\PostalCodeCheck;
use App\Mail\OrderConfirmation;
use App\Mail\PyamentStatusMail;
use App\Models\Front\Cart\Cart;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Order\Order;
use App\Models\Admin\Tax\SalesTax;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Front\Cart\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Product\Product;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\OrderNotification;
use App\Notifications\InvoiceNotification;
use App\Http\Controllers\PaymentController;
use App\Models\Admin\Order\OrderTransaction;
use Illuminate\Support\Facades\Notification;
use App\Models\Admin\Customer\BillingAddress;
use App\Models\Admin\Customer\ShippingAddress;
use App\Notifications\PaymentFailedNotification;
use App\Notifications\DiffrentShippingBillingAddressNotification;


class CheckoutController extends PaymentController
{
    public function __construct()
    {
        $this->middleware('prevent-back-history');
    }
    public function view()
    {
        return view('frontend.checkout');
    }

    public function thankyou($id)
    {
        \Cookie::forget('__cart_items');
        $cart =  Cart::where('external_id', $id)->firstOrFail();
        $billingAddress = BillingAddress::where('cart_id', $cart->id)->first();
        $shippingAddress = ShippingAddress::where('cart_id', $cart->id)->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $sumOfQty = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $purchasePrice = CartItem::where('cart_id', $cart->id)->sum('purchase_price');
        $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
        $order = Order::where('cart_id', $cart->id)->latest()->first();
        $totalSave = $cart->cart_total_price - $cart->cart_amount;
        $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
        $forGoogleTag = [];
        $forGoogleItem =  CartItem::where('cart_id', $cart->id)->get();
        foreach ($forGoogleItem as $item) {
            $forGoogleTag[] = [
                'sku' => $item->product->sku ?? '',
                'name' =>  str_replace(' ', ' ', preg_replace("/[^A-Za-z0-9 ]/", '', $item->product->name ?? '')),
                'category' => $item->product->category->name ?? '',
                'price' => (float)$item->purchase_price / (int) $item->quantity,
                'quantity' => (int)$item->quantity ?? 0,
                'size' => rand(10, 100),

            ];
        }
        $dataTag =   json_encode($forGoogleTag);

        $gtin = [];
        foreach ($cartItems as $item) {
            $gtin[] = [
                'gtin' => str_replace(' ', ' ', preg_replace("/[^A-Za-z0-9 ]/", '', $item->product->name ?? ' ')),
            ];
        }
        $dataGtin = json_encode($gtin);

        return view(
            'frontend.order-thankyou',
            compact(
                'billingAddress',
                'shippingAddress',
                'cartItems',
                'sumOfQty',
                'purchasePrice',
                'cart',
                'coupon',
                'totalSave',
                'order',
                'dataTag',
                'dataGtin',
                'promo_items'
            )
        );
    }


    public function order(Request $request)
    {
        $request->validate([
            'shipping_first_name' => ['required'],
            'shipping_last_name' => ['required'],
            'shipping_email' => ['required', 'email'],
            'confirm_shipping_email' => ['required', 'same:shipping_email'],
            'shipping_phone_number' => ['required', 'min:16'],
            'shipping_street' => ['required'],
            'shipping_city' => ['required'],
            'shipping_province' => ['required'],
        ], [
            'shipping_phone_number.min' => 'Shipping phone number is invalid.',
            'confirm_shipping_email.same' => 'Please make sure your email addresses match.'
        ]);

        if (config('global.is_heyblinds_com') == true) {
            $request->validate([
                'shipping_postal_code' => ['required'],
            ]);
        } else {
            $request->validate([
                'shipping_postal_code' => ['required', 'regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/'],
            ], [
                'shipping_postal_code.regex' => 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)',
            ]);
        }

        if (!isset($request->billingInformation)) {
            request()->validate([
                'billing_first_name' => ['required'],
                'billing_last_name' => ['required'],
                'billing_phone_number' => ['required', 'min:16'],
                'billing_street' => ['required'],
                'billing_city' => ['required'],
                'billing_province' => ['required'],
                'billing_postal_code' => ['required', 'regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/'],
            ], [
                'billing_phone_number.min' => 'Billing phone number is invalid.',
                'billing_postal_code' => 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)'
            ]);
        }
        request()->validate([
            'card_name' => ['required'],
            'card_number' => ['required'],
            'card_expiry' => ['required'],
            'card_cvc' => ['required'],
        ]);
        if ($request->guest_user == 0 && !Auth::check()) {
            request()->validate([
                'password' => ['required', 'confirmed'],
                'password_confirmation' => ['required'],
                'shipping_email' => [new EmailExistOrNot],
            ]);
        }

        try {
            $findEmail = $request->shipping_email; //for email
            $name = $request->shipping_first_name; //for email

            $cart = Cart::where('id', $request->cart_id)->first();
            $grand_total_price = Cart::where('id', $request->cart_id)->sum('cart_amount');

            $preAppliedTotalSave = $cart->cart_total_price - $cart->cart_amount;
            $preAppliedTotalPercentage =  @($preAppliedTotalSave * 100  / $cart->cart_total_price);

            $orderPrice = ($cart->cart_amount - $cart->cart_item_discount) + ($cart->shipping_extra_amount + $cart->handling_extra_amount);

            $order_id =  $this->generateOrderID('HBO');

            $customer_id = $request->shipping_first_name . ' ' . $request->shipping_last_name;

            $tax = json_decode($cart->cart_tax);
            $total = $orderPrice;
            $tax = json_decode($cart->cart_tax, true) ?? [];
            foreach ($tax as $key => $value) {
                $amount = (float)($orderPrice * $value / 100);
                $total += $amount;
            }
            //$total = $total + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
            $orderPrice = $this->withoutRoundingCart($total, 2);
            $payment = $this->paymentWithMonerisGetway($request, $orderPrice, $order_id, $customer_id);



            $rsponse = $payment->getMessage(); // payment response

            if (str_contains(strtolower(trim($rsponse)), strtolower('APPROVED')) !== false) {
                DB::beginTransaction();
                if (auth()->user()) {
                    $user = auth()->user();
                } else {
                    $check = User::where('email', $request->input('shipping_email'))->doesntExist();
                    if ($check) {
                        $user = User::create([
                            'first_name' => $request->input('shipping_first_name'),
                            'last_name'  => $request->input('shipping_last_name'),
                            'email' => $request->input('shipping_email'),
                            'password' => $request->guest_user == 0 ? bcrypt($request->password) : Hash::make(Str::random(20)),
                            'is_guest' => $request->guest_user == 0 ? true : false,
                        ]);
                    } else {
                        $user = User::where('email', $request->input('shipping_email'))->first();
                    }
                }

                $order = Order::updateOrCreate(
                    [
                        'cart_id' => $request->cart_id,
                    ],
                    [
                        'order_id' => $order_id,
                        'cart_id' => $request->cart_id,
                        'order_status' => 1,
                        'order_total_price' => $orderPrice,
                        'order_tax' => $cart->cart_tax,
                        'order_item_discount' => $cart->cart_item_discount ?? 0,
                        'grand_total_price' => $grand_total_price,
                        'order_date' => now(),
                        'user_id' => $user->id ?? null,
                    ]
                );

                $orderTransaction = OrderTransaction::updateOrCreate(
                    [
                        'order_id'  =>   $order->id,
                    ],
                    [
                        'invoice_id' => $request->cart_id,
                        'order_id'  =>   $order->id,
                        'payment_date' => now(),
                        'payment_amount' => $orderPrice,
                        "payment_status" => $payment->getComplete(),
                        "card_type" => $payment->getCardType(),
                        "txn_number" => $payment->getTxnNumber(),
                        "reference_num" => $payment->getReferenceNum(),
                        "message" => $payment->getMessage(),
                        "response" => $this->convertTheresponse($payment),
                    ]
                );
                $shippingAddress = ShippingAddress::updateOrCreate(
                    [
                        "cart_id" => $request->cart_id,
                    ],
                    [
                        "user_id" => $user->id,
                        'order_id' =>  $order->id,
                        "cart_id" => $request->cart_id,
                        "first_name" => $request->shipping_first_name,
                        "last_name" => $request->shipping_last_name,
                        "email" => $request->shipping_email,
                        "area_code" => $request->shipping_address,
                        "phone_number" => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->shipping_phone_number)),
                        "street" => $request->shipping_street,
                        "city" => $request->shipping_city,
                        "province" => $request->shipping_province,
                        "postal_code" => $request->shipping_postal_code,
                    ]
                );
                if ($request->billingInformation == 0) {
                    $billingAddress = BillingAddress::updateOrCreate(
                        [
                            "cart_id" => $request->cart_id,
                        ],
                        [
                            "user_id" => $user->id ?? null, //"1", //$request->shipping_first_name,
                            'order_id' =>  $order->id,
                            "cart_id" => $request->cart_id,
                            "first_name" => $request->billing_first_name,
                            "last_name" => $request->billing_last_name,
                            "email" => $request->email,
                            "area_code" => $request->billing_address,
                            "phone_number" => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->billing_phone_number)),
                            "street" => $request->billing_street,
                            "city" => $request->billing_city,
                            "province" => $request->billing_province,
                            "postal_code" => $request->billing_postal_code,
                        ]
                    );
                } else {
                    $billingAddress = BillingAddress::updateOrCreate(
                        [
                            "cart_id" => $request->cart_id,
                        ],
                        [
                            'order_id' =>  $order->id,
                            "user_id" => $user->id ?? null, //"1", //$request->shipping_first_name,
                            "cart_id" => $request->cart_id,
                            "first_name" => $request->shipping_first_name,
                            "last_name" => $request->shipping_last_name,
                            "email" => $request->shipping_email,
                            "area_code" => $request->shipping_address,
                            "phone_number" => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->shipping_phone_number)),
                            "street" => $request->shipping_street,
                            "city" => $request->shipping_city,
                            "province" => $request->shipping_province,
                            "postal_code" => $request->shipping_postal_code,
                        ]
                    );
                }
                DB::commit();
                $abandoned = AbandonedCustomer::where('cart_id', $request->cart_id)->first();
                if (!empty($abandoned)) {
                    $abandoned->delete();
                }
                // if ($order_staus == 1) { //check payment status
                $cartItems = CartItem::where('cart_id', $cart->id)->get();
                $sumOfQty = CartItem::where('cart_id', $cart->id)->sum('quantity');
                $purchasePrice = CartItem::where('cart_id', $cart->id)->sum('purchase_price');
                $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
                $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
                $order = Order::where('cart_id', $cart->id)->latest()->first();

                Cart::where('id', $cart->id)->update(['cart_draft' => 0, 'user_id' => $user->id]);
                $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
                Notification::route('mail', $findEmail)->notify(new OrderNotification(
                    $billingAddress,
                    $shippingAddress,
                    $cartItems,
                    $sumOfQty,
                    $purchasePrice,
                    $cart,
                    $coupon,
                    $cartItemsCount,
                    $order,
                    $promo_items
                ));
                //If shipping address and billing adress are not
                if ($request->billingInformation == 0) {
                    if (($request->billing_address != $request->shipping_address) || ($request->billing_city != $request->shipping_city) || ($request->billing_street != $request->shipping_street) || ($request->billing_province != $request->shipping_province) || ($request->billing_postal_code != $request->shipping_postal_code)) {
                        Notification::route('mail', ['robert@heyblinds.ca', 'help@heyblinds.ca'])
                            ->notify(new DiffrentShippingBillingAddressNotification($order, $shippingAddress, $billingAddress));
                    }
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Order placed successfully',
                    'cart_id' => $cart->external_id,
                ]);
            } else {
                if (config('app.env') == 'production') {
                    Notification::route('mail', ['robert@heyblinds.ca', 'help@heyblinds.ca'])->notify(new PaymentFailedNotification($rsponse, $request, $request->current_url, $cart));
                }
                return response()->json([
                    'status' => false,
                    //'message' => $rsponse,
                    'message' => 'Sorry, there’s a problem processing your payment. Please check your info and try again, or contact us for assistance.',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    public function taxCalculation(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->first();
        $tax = SalesTax::where('province_code', $request->provience)->first();
        $price = CartItem::where('cart_id', $cart->id)->sum('purchase_price');

        $amount =  ($price - $cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
        $pst = "";
        $gst = "";
        $hst = "";
        $response = "";
        $total = $amount;
        $taxData = array();

        if (!empty($tax->pst)) {
            $pst = $amount * $tax->pst / 100;
            $response = '<h6 class="d-flex text-primary mb-2 __coupon-discount"> <span class="w-100">PST( ' . $tax->pst . '% )</span> <b class="w-50 text-end"><span id="pstamount">$' . $this->round_up($pst, 2) . '</span></b>  </h6>';
            $total += $pst;
            $taxData['pst'] = $tax->pst;
        }
        if (!empty($tax->gst)) {
            $gst = $amount * $tax->gst / 100;
            $response .= '<h6 class="d-flex text-primary mb-2 __coupon-discount"> <span class="w-100">GST( ' . $tax->gst . '% )</span> <b class="w-50 text-end"><span id="pstamount">$' . $this->round_up($gst, 2) . '</span></b>  </h6>';
            $total += $gst;
            $taxData['gst'] = $tax->gst;
        }
        if (!empty($tax->hst)) {
            $hst = $amount * $tax->hst / 100;
            $response .= '<h6 class="d-flex text-primary mb-2 __coupon-discount"> <span class="w-100">HST( ' . $tax->hst . '% )</span> <b class="w-50 text-end"><span id="pstamount">$' . $this->round_up($hst, 2) . '</span></b>  </h6>';
            $total += $hst;
            $taxData['hst'] = $tax->hst;
        }
        //$total = $total+($cart->shipping_extra_amount + $cart->handling_extra_amount);
        $total =  $this->round_up($total, 2);
        // $total =  $this->helpers->withoutRounding($total, 2);
        $cart->cart_tax = json_encode($taxData);
        $cart->save();
        AbandonedCustomer::where('cart_id', $request->cart_id)->update([
            'shipping_province' => $request->provience,
        ]);

        return response()->json([
            'pst' => $pst,
            'gst' => $gst,
            'hst' => $hst,
            'tax' => $tax,
            'response' => $response,
            'total' => $total,
            'status' => true
        ]);
    }

    public function round_up($number, $total_decimals)
    {
        return number_format($number, $total_decimals);
        $number = (string) $number;
        if ($number === '') {
            $number = '0';
        }
        if (strpos($number, '.') === false) {
            $number .= '.';
        }
        $number_arr = explode('.', $number);
        $decimals   = substr($number_arr[1], 0, $total_decimals);
        if ($decimals === false) {
            $decimals = '0';
        }
        $return = '';
        if ($total_decimals == 0) {
            $return = $number_arr[0];
        } else {
            if (strlen($decimals) < $total_decimals) {
                $decimals = str_pad($decimals, $total_decimals, '0', STR_PAD_RIGHT);
            }
            $return = $number_arr[0] . '.' . $decimals;
        }
        return $return;
    }
    public function withoutRoundingCart($number, $total_decimals)
    {
        $number = (string) $number;
        if ($number === '') {
            $number = '0';
        }
        if (strpos($number, '.') === false) {
            $number .= '.';
        }
        $number_arr = explode('.', $number);
        $decimals   = substr($number_arr[1], 0, $total_decimals);
        if ($decimals === false) {
            $decimals = '0';
        }
        $return = '';
        if ($total_decimals == 0) {
            $return = $number_arr[0];
        } else {
            if (strlen($decimals) < $total_decimals) {
                $decimals = str_pad($decimals, $total_decimals, '0', STR_PAD_RIGHT);
            }
            $return = $number_arr[0] . '.' . $decimals;
        }
        return $return;
    }
    public function postalCode(Request $request)
    {
        $postal_code = $request->postal_code;
        $response = Http::get('https://geocoder.ca/' . $postal_code . '?json=1');
        if (isset($response['standard']['prov'])) {
            if (!empty($response['standard']['prov'])) {
                return  $response;
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)'
        ]);
    }
    public function productPurchangesPrice($product_id, $cart_id)
    {
        return  CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->sum('purchase_price');
    }
    public function productSumOfQuantity($product_id, $cart_id)
    {
        return  CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->sum('quantity');
    }
    public function productSumOfTotal($product_id, $cart_id)
    {
        return  CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->sum('unit_price');
    }
    public function productDiscount($product_id, $cart_id)
    {
        return  CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->sum('promo_price');
    }
    public function couponDiscount($product_id, $cart_id)
    {
        return  CartItem::where('cart_id', $cart_id)->where('product_id', $product_id)->sum('discount_amount');
    }
    public function googleReviwStaus(Request $request)
    {
        Order::where('cart_id', $request->cart_id)->update([
            'google_review_status' => true,
        ]);
    }
}
