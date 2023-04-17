<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\State;
use App\libs\ModelTrait;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\HandlingPrice;
use App\Models\ShippingPrice;
use App\Models\Front\Cart\Cart;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Front\Cart\CartItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CopounNotification;
use Illuminate\Support\Facades\Notification;


class CartController extends Controller
{
    use ModelTrait;

    public function index()
    {
        $getCookieCartId = $_COOKIE['__cart_items'] ?? '';
        $cartItems = [];
        $id = $getCookieCartId;
        if (!empty(Auth::id()))
            $cart = Cart::where('external_id', $id)->where('user_id', Auth::id())->first();
        else
            $cart = Cart::where('external_id', $id)->first();

        if (!empty($cart->order) && $cart->order->order_status != 10)
            return redirect()->route('frontend.thank.you', $cart->external_id);

        if (!empty($cart)) {
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            $this->calculatingCart($cartItems, $cart);
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            //$promoType = $cartItems[0]->promo_type;
            $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
            //   $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();
            $totalSave = $cart->cart_total_price - $cart->cart_amount;
            $totalPercentage =  @($totalSave * 100  / $cart->cart_total_price);
            $this->helpers->checkIsCouponActive(($cart->coupon ?? ""), $cart->id);
            $this->helpers->addExtraPrice($cart);
            auth()->user() ? $this->storeActionReport($cart->id) : '';
            $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
            return view('frontend.cart', compact('cart', 'cartItems', 'id', 'totalPercentage', 'totalSave', 'cartItemsCount', 'promo_items'));
        }
        return view('frontend.cart', compact('cartItems'));
    }

    public function view($id)
    {
        $cartItems = [];

        $cart = Cart::where('external_id', $id)->first();

        if (!empty($cart->order) && $cart->order->order_status != 10)
            return redirect()->route('frontend.thank.you', $cart->external_id);
        if (empty($cart))
            return redirect()->to('cart');
        if ($cart) {
            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            // $this->helpers->checkIsCouponActive(($cart->coupon ?? ""), $cart->id);
            $this->calculatingCart($cartItems, $cart);

            $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');

            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            //  $promoType = $cartItems[0]->promo_type ?? "";
            $totalSave = (float)($cart->cart_total_price - $cart->cart_amount);

            $totalPercentage = (float)@(($totalSave * 100) / $cart->cart_total_price);

            $this->helpers->checkIsCouponActive(($cart->coupon ?? ""), $cart->id);
            $this->helpers->addExtraPrice($cart);
            auth()->user() ? $this->storeActionReport($cart->id) : ''; //$this->storeActionReport($cart->id);
            $promo_items =  CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();
        }

        return view('frontend.cart', compact('cart', 'cartItems', 'id', 'totalPercentage', 'totalSave', 'cartItemsCount', 'promo_items'));
    }

    private function calculatingCart($cartItems, $cart)
    {
        $cartTotalValue = [];
        $cartValue = [];
        foreach ($cartItems as $item) {
            $cartItem = $this->helpers->checkItemsDiscount($item->promo_name ?? "", $item->id);
            if (!empty($cartItem)) {
                $cartTotalValue[] =  $cartItem->unit_price;
                $cartValue[] = $cartItem->purchase_price;
            }
        }
        $cart->cart_amount = array_sum($cartValue);
        $cart->cart_total_price = array_sum($cartTotalValue);
        $cart->save();
    }

    public function update(Request $request, $cart_item_id)
    {
        $cartItem = CartItem::where('id', $cart_item_id)->first();

        $quantity = (int) $request->input('quantity');

        $singlePrice = ((float)$cartItem->sub_total / (int)$cartItem->quantity);
        $subTotalAndPrice = (float) $singlePrice * (int)$quantity;

        $singleUnit = ((float)$cartItem->unit_price / (int)$cartItem->quantity);
        $singleUnitPrice = (float) $singleUnit * (int) $quantity;

        $singlePromo = ((float)$cartItem->promo_price / (int)$cartItem->quantity);

        // if we calculate ths directly with percentage, we will not get difference in individual cartItem amout difference in front end, there is difference between promo amount and your price


        $totalPromo = (float)$singlePromo * (int)$quantity;
        $cartItem->customer_note = $request->note;
        $cartItem->room_name = $request->room;
        $cartItem->quantity = $quantity;
        $cartItem->sub_total = $subTotalAndPrice;
        $cartItem->purchase_price = $subTotalAndPrice;
        $cartItem->unit_price = $singleUnitPrice;
        $cartItem->promo_price = $totalPromo;
        $cartItem->save();

        $cart = Cart::find($cartItem->cart_id);

        $totalPurchasePrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('sub_total');
        $totalUnitPrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('unit_price');

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $cartCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $totalPercentage = 0;

        foreach ($cartItems as $items) {
            $unitPrice = $items->unit_price / (!empty($items->quantity) ? $items->quantity : 0);
            $purchasePrice = $items->purchase_price / (!empty($items->quantity) ? $items->quantity : 0);
            $totalPercentage += (($unitPrice - $purchasePrice) / $unitPrice) * 100;
        }


        $totalPercentage = $this->helpers->withoutRounding($totalPercentage / (!empty($cartItems) ? count($cartItems) : 0), 2);

        $cart->cart_amount = (float) $totalPurchasePrice;
        $cart->cart_total_price = (float) $totalUnitPrice;
        $totalDiscountAmount = 0;

        if (!empty($cart) && !empty($cart->coupon)  && !empty($cart->discount)) {
            $cartAmount = $cart->cart_amount;

            $coupon = Coupon::where('code', $cart->coupon)->first();

            if ($cart->cart_amount > $coupon->min_amount) {
                if ($cart->coupon_type == "percentage") {
                    $totalDiscountAmount = ((float)$cartAmount * (float)$cart->discount) / 100;
                    $couponType = "percentage";
                } elseif ($cart->coupon_type == "flat") {
                    $totalDiscountAmount = (float) $cart->discount;
                    $couponType = "flat";
                }
                $cart->cart_item_discount = $totalDiscountAmount;

                $existCoupon = true;
            } else {
                $existCoupon = false;
                $cart->cart_item_discount = "";
                $cart->coupon_type = "";
                $cart->coupon = "";
                $cart->discount = "0";
            }
        }
        if (!empty(auth()->user()->id)) {
            $cart->user_id = auth()->user()->id;
            $cart->cart_draft = true;
        }
        $cart->save();
        $this->helpers->addExtraPrice($cart);
        $your_price = ($cart->cart_amount - $cart->cart_item_discount) + ($cart->shipping_extra_amount + $cart->handling_extra_amount);

        $response = [
            'id' => $cartItem->id,
            'indSubTotal' => $this->helpers->withoutRounding($cartItem->unit_price, 2),
            'indPromo' => $this->helpers->withoutRounding($cartItem->promo_price, 2),
            'promo_price' => $this->helpers->withoutRounding($cartItem->promoPrice($cart->id, $cartItem->product_id), 2),
            'product_id' => $cartItem->product_id,
            'indTotal' => $this->helpers->withoutRounding($cartItem->purchase_price, 2),
            'quantity' => $quantity,
            'mainPrice' => $this->helpers->withoutRounding($cart->cart_total_price, 2),
            'mainPromo' => $totalPercentage,
            'mainPromoPrice' => $this->helpers->withoutRounding((float)$cart->cart_total_price - (float)$cart->cart_amount, 2),
            'mainTotalCart' => $this->helpers->withoutRounding($your_price, 2),
            'couponAmount' => $this->helpers->withoutRounding($cart->discount, 2) ?? "",
            'cartItemsCount' => $cartCount,
            'couponExist' =>  $existCoupon ?? false,
            'couponType' => $couponType ?? '',
            'couponSave' => $cart->cart_item_discount ?? '',
            'is_handling_price' => $cart->handling_extra_amount,
        ];

        return response()->json($response);
    }

    public function destroy(Request $request, $entry_id)
    {
        $cartItem = CartItem::where('id', $entry_id)->first();
        $cart = Cart::where('id', $cartItem->cart_id)->first();
        $totalPurchasePrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('sub_total');
        $totalUnitPrice = (float)CartItem::where('cart_id', $cartItem->cart_id)->sum('unit_price');
        $cart->cart_amount = (float) $totalPurchasePrice;
        $cart->cart_total_price = (float) $totalUnitPrice;
        $totalDiscountAmount = 0;
        if (!empty($cart) && !empty($cart->coupon)  && !empty($cart->discount)) {

            $saveAmount = (float)$cart->cart_amount - (float)$cartItem->purchase_price;
            $totalUnitAmount = (float) $cart->cart_total_price - (float) $cartItem->unit_price;

            $cart->cart_amount = $saveAmount; //old calculation
            $cart->cart_total_price = (float) $totalUnitAmount + (float) $totalUnitPrice;

            if (!empty($cart) && !empty($cart->coupon)  && !empty($cart->discount)) {

                $couponCode = Coupon::where('code', $cart->coupon)->first();

                if ($cart->cart_amount > $couponCode->min_amount) {
                    if ($cart->coupon_type == "percentage") {
                        $totalDiscountAmount = (float)(($saveAmount * (float)$cart->discount) / 100);
                    } elseif ($cart->coupon_type == "flat") {
                        $totalDiscountAmount = (float) $cart->discount;
                    }
                    $cart->cart_item_discount = (float)$totalDiscountAmount;
                } else {
                    $cart->cart_item_discount = "";
                    $cart->coupon_type = "";
                    $cart->coupon = "";
                    $cart->discount = "0";
                }
            }
        }
        $cart->save();
        $cartCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $your_price = ((float)$cart->cart_amount - (float)$cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
        $response = [
            'id' => $cartItem->id,
            'indSubTotal' => $this->helpers->withoutRounding($cartItem->unit_price, 2),
            'indPromo' => $this->helpers->withoutRounding($cartItem->promo_price, 2),
            'indTotal' => $this->helpers->withoutRounding($cartItem->purchase_price, 2),
            'mainPrice' => $this->helpers->withoutRounding($cart->cart_total_price, 2),
            'mainPromoPrice' => $this->helpers->withoutRounding((float)$cart->cart_total_price - (float)$cart->cart_amount, 2),
            'mainTotalCart' => $this->helpers->withoutRounding($your_price, 2),
            'cartItemsCount' => $cartCount,
            'couponExist' =>  $existCoupon ?? false,
            'couponType' => $couponType ?? '',
            'couponSave' => $cart->cart_item_discount ?? '',
            'couponAmount' => $cart->discount ?? 0,
        ];
        $cartItem->delete();
        $this->helpers->addExtraPrice($cart);
        if ($cart->itemsCount() < 1) {
            $cart->delete();
            setcookie('__cart_items', null, -1, '/');
        }
        return response()->json($response);
    }

    public function applyCoupon(Request $request, $cart_id)
    {
        $message = null;
        $couponCode = $request->input('coupon_code');
        $cart = Cart::where('external_id', $cart_id)->orderBy('id')->first();

        $coupon = Coupon::where('code', $couponCode)->where('is_active', true)->orderBy('id')->first();
        $promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->orderByDesc('id')->first();

        if (empty($coupon) || !$coupon->is_active) {
            $message = "Invalid Coupon";
            $this->copounNotification($cart->cart_id, $couponCode, $cart->cart_total_price, $message);
            return [
                'error' => "Invalid Coupon"
            ];
        } elseif (empty($promo) && $coupon->with_promo != true) {
            $message = "This coupon is not applicable in this on going promotion";
            $this->copounNotification($cart->cart_id, $couponCode, $cart->cart_total_price, $message);
            return [
                'error' => $message
            ];
        }

        $today = Carbon::now(); // Carbon::createFromFormat('m/d/Y H:i:s', Carbon::now());
        $startDate = $coupon->start_date;
        $endDate = $coupon->end_date;
        $couponType = $coupon->type;
        $couponAmount = $coupon->amount;
        $min_amount = $coupon->min_amount;

        if (!(Carbon::parse($startDate)->lte($today) && Carbon::parse($endDate)->gte($today))) {
            $message = "Coupon Date Expired";
            $this->copounNotification($cart->cart_id, $couponCode, $cart->cart_total_price, $message);
            return [
                'error' => $message
            ];
        }

        $totalSaveAmount = $cart->cart_amount;

        if ($totalSaveAmount < $min_amount) {
            $message = "Minimum $$min_amount purchase required";
            $this->copounNotification($cart->cart_id, $couponCode, $cart->cart_total_price, $message);
            return [
                'error' =>  $message
            ];
        }

        if ($couponType === "percentage") {
            $cart->cart_item_discount = $this->helpers->withoutRoundingforOther(($totalSaveAmount * $couponAmount / 100), 2); //round(($totalSaveAmount * $couponAmount / 100), 2,PHP_ROUND_HALF_UP);
            $cart->coupon_type = "percentage";
        } elseif ($couponType === "flat") {
            $cart->cart_item_discount = $couponAmount;
            $cart->coupon_type = "flat";
        }
        $get_cart_price = ($cart->cart_amount - $cart->cart_item_discount);
        if ($get_cart_price < 0) {
            $message = "The coupon is not applicable for this cart, Shopping more.";
            $this->copounNotification($cart->cart_id, $couponCode, $get_cart_price, $message);
            return [
                'error' =>  $message
            ];
        }
        $cart->coupon = $couponCode;
        $cart->discount = $couponAmount;
        $cart->save();

        $sub_total = $cart->cart_amount;
        $price = $cart->cart_total_price;
        $this->helpers->addExtraPrice($cart);
        $your_price = ($cart->cart_amount - $cart->cart_item_discount) + ($cart->shipping_extra_amount + $cart->handling_extra_amount);

        if ($cart) {
            $message = "Valid coupon";
            $this->copounNotification($cart->cart_id, $couponCode, $your_price, $message);

            return [
                "discount" => number_format($cart->cart_item_discount, 2),
                "cart_sub_total" => number_format($price, 2),
                'cart_price' => $sub_total,
                'status' => true,
                'type' => $couponType,
                'your_price' => number_format($your_price, 2),
                'discount_amount' => $couponAmount
            ];
        } else {
            $message = "Invalid coupon";
            $this->copounNotification($cart->cart_id, $couponCode, $cart->cart_total_price, $message);
            return [
                "cart_sub_total" => number_format($price, 2),
                'cart_price' => number_format($sub_total, 2),
                'status' => false,
                'type' => $couponType,
            ];
        }
    }
    /**
     * Send the notification of cart copoun
     * @param  $cart_id
     * @param  $coupon_code
     * @param  $cart_amount
     * @param  $message
     * @return Mix
     */
    public function copounNotification($cart_id, $coupon_code, $cart_amount, $message = null)
    {
        Notification::route('mail', 'heyblindsorders@gmail.com')
            ->notify(new CopounNotification($cart_id, $coupon_code, $cart_amount, $message));
    }


    public function round_up($value, $precision)
    {
        $pow = pow(10, $precision);
        return (float) $this->helpers->withoutRounding((($pow * $value) + (($pow * $value) - ($pow * $value))) / $pow, 2) ?? 0;
    }



    public function removeCoupon(Request $request, $cart_id)
    {
        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('code', $couponCode)->orderBy('id')->first();

        if (empty($coupon)) {
            return [
                'error' => "Invalid Coupon Id"
            ];
        }

        $cart = Cart::where('external_id', $cart_id)->orderBy('id')->first();

        // $this->helpers->addExtraPrice($cart);

        $couponType = "";
        $cart->coupon = "";
        $cart->cart_item_discount = 0;
        $cart->coupon_type = "";
        $cart->discount = 0;
        $cart->save();

        // $price = (float)$cart->cart_amount + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
        $your_price = (float)$cart->cart_amount  + (float)($cart->shipping_extra_amount + $cart->handling_extra_amount);

        $sub_total = $cart->cart_total_price;


        if ($cart) {
            return [
                "discount" => "",
                "cart_sub_total" => $sub_total,
                'cart_price' => $your_price,
                'status' => true,
                'type' => $couponType,
                'discount_amount' => "0"
            ];
        } else {
            return [
                "cart_sub_total" => $price,
                'cart_price' => $sub_total,
                'status' => false,
                'type' => $couponType,
            ];
        }
    }

    public function checkOut($external_id)
    {
        $cart = Cart::where('external_id', $external_id)->firstOrFail();
        if (!empty($cart->order) && $cart->order->order_status != 10)
            return redirect()->route('frontend.thank.you', $cart->external_id);
        $this->helpers->checkIsCouponActive(($cart->coupon ?? ""), $cart->id);

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $this->calculatingCart($cartItems, $cart);
        $promoType = $cartItems[0]->promo_type;
        $count = CartItem::where('cart_id', $cart->id)->count();

        $sub_total = CartItem::where('cart_id', $cart->id)->sum('unit_price');

        $price = CartItem::where('cart_id', $cart->id)->sum('purchase_price');

        $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');

        $coupon = Coupon::where('code', $cart->coupon)->orderBy('id')->first();

        $totalSave = ($cart->cart_total_price - $cart->cart_amount);

        $totalPercentage = $promoType === "percentage" ? @($totalSave * 100  / $cart->cart_total_price) : $cart->discount;
        $promo_items = CartItem::where('cart_id', $cart->id)->groupBy('product_id')->get();

        $proviences = Province::all();
        $states =  State::all();

        return view('frontend.checkout', compact('count', 'sub_total', 'price', 'cart', 'coupon', 'totalSave', 'totalPercentage', 'cartItemsCount', 'promoType', 'proviences', 'states', 'promo_items'));
    }

    public function saveCart(Request $request, $id)
    {
        return view('frontend.save-cart', compact('id'));
    }

    public function saveCartStore(Request $request): bool
    {

        $rules = [
            'reason' => 'required',
        ];
        $customMessages = [
            'reason.required' => 'Please Select one of the dropdown',
        ];
        $this->validate($request, $rules, $customMessages);
        $cart =  $this->helpers->saveCart($request->input('cartId'), Auth::id(), $request->input('reason'));

        if ($cart) {
            return true;
        }
        return false;
    }

    // public function updateCartStore(Request $request)
    // {
    //     $rules = [
    //         'cartId' => 'required',
    //     ];
    //     $customMessages = [
    //         'reason.required' => 'Something wrong with you Cart!',
    //     ];
    //     $this->validate($request, $rules, $customMessages);

    //     if (DB::table('carts')->where('external_id', $request->input('cartId'))
    //         ->where('user_id', Auth::id())->where('cart_draft', true)->exists()){
    //         return response()->json([
    //             'status' => true,
    //         ]);
    //     }
    //     return response()->json([
    //         'status' => false,
    //     ]);
    // }
    public function storeActionReport($id)
    {
        AbandonedCustomer::updateOrCreate(
            [
                'cart_id' => $id,
            ],
            [
                'cart_id' => $id,
                'cart_type' => 1,
                'shipping_first_name' => auth()->user()->first_name ?? '',
                'shipping_last_name' => auth()->user()->last_name ?? '',
                'shipping_email' => auth()->user()->email ?? '',
                'shipping_phone_number' => auth()->user()->profile->phone_number ?? '',
                'billing_province' => auth()->user()->profile->province ?? '',
            ]
        );
    }

    public function updateCartStore(Request $request)
    {
        $rules = [
            'cartId' => 'required',
        ];
        $customMessages = [
            'reason.required' => 'Something wrong with you Cart!',
        ];
        $this->validate($request, $rules, $customMessages);
        $cart = Cart::where('external_id', $request->input('cartId'))->first();
        $cart->user_id;
        if (!empty($cart)) {
            $cart->update([
                'user_id' => Auth::id(),
                'cart_draft' => true,
            ]);
            return response()->json([
                'status' => true
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    public function clone(Request $request)
    {
        $data = false;
        $cart = Cart::findOrFail($request->input('CartId'));
        if (!empty($cart)) {
            $cartItem = CartItem::where('cart_id', $request->input('CartId'))->where('id', $request->input('ItemId'))->firstOrFail();
            $sub_total = ((float) $cartItem->sub_total / (float)  $cartItem->quantity);
            $unit_price = (float) $cartItem->unit_price / (float)  $cartItem->quantity;
            $cart->cart_amount = (float) $cart->cart_amount + (float) $sub_total;
            $cart->cart_total_price = (float) $cart->cart_total_price + (float) $unit_price;

            if (!empty($cart) && !empty($cart->coupon)  && !empty($cart->discount)) {
                $cartAmount = $cart->cart_amount;

                $coupon = Coupon::where('code', $cart->coupon)->first();

                // return ($coupon);

                if ($cart->cart_amount > $coupon->min_amount) {
                    if ($cart->coupon_type == "percentage") {
                        $totalDiscountAmount = ((float)$cartAmount * (float)$cart->discount) / 100;
                    } elseif ($cart->coupon_type == "flat") {
                        $totalDiscountAmount = (float) $cart->discount;
                    }
                    $cart->cart_item_discount = $totalDiscountAmount;
                } else {
                    $cart->cart_item_discount = "";
                    $cart->coupon_type = "";
                    $cart->coupon = "";
                    $cart->discount = "0";
                }
            }

            $cart->save();

            if ($cart) {
                $cartItem->sub_total = $sub_total;
                $cartItem->unit_price = $unit_price;
                $cartItem->promo_price =   (float) $cartItem->promo_price / (float)$cartItem->quantity;
                $cartItem->purchase_price = (float) $cartItem->purchase_price / (float)$cartItem->quantity;
                $cartItem->quantity = 1;
                $copyItem = $cartItem->replicate();
                $copyItem->save();
                if (!empty($copyItem)) {
                    return true;
                }
            }
        } else {
            $data = [
                'error' => 'This is something you cannot clone'
            ];
        }
        return response()->json($data);
    }

    public function destroyCart(Request $request)
    {

        Cart::where('external_id', $request->input('cartId'))->delete();
        return true;
    }
    public function saveCheckout(Request $request, $id)
    {

        AbandonedCustomer::updateOrCreate([
            'cart_id' => $request->input('cart_id'),
        ], [
            'cart_id' => $request->input('cart_id'),
            'shipping_first_name' => $request->input('shipping_first_name'),
            'shipping_last_name' => $request->input('shipping_last_name'),
            'shipping_email' => $request->input('shipping_email'),
            'shipping_phone_number' => $request->input('shipping_phone_number'),
            'shipping_street' => $request->input('shipping_street'),
            'shipping_address' => $request->input('shipping_address'),
            'shipping_city' => $request->input('shipping_city'),
            'shipping_province' => $request->input('shipping_province'),
            'shipping_postal_code' => $request->input('shipping_postal_code'),
            'has_billing' => $request->input('billingInformation') ?? 0,
            'billing_first_name' => $request->input('billing_first_name'),
            'billing_last_name' => $request->input('billing_last_name'),
            'billing_email' => $request->input('billing_email'),
            'billing_phone_number' => $request->input('billing_phone_number'),
            'billing_street' => $request->input('billing_street'),
            'billing_address' => $request->input('billing_address'),
            'billing_city' => $request->input('billing_city'),
            'billing_province' => $request->input('billing_province'),
            'billing_postal_code' => $request->input('billing_postal_code'),
        ]);
    }
}
