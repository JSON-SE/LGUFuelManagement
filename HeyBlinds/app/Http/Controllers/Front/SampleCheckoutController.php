<?php

namespace App\Http\Controllers\Front;


use App\Helpers\Helpers;
use App\Http\Controllers\PaymentController;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Color;
use App\Models\Admin\Customer\BillingAddress;
use App\Models\Admin\Customer\ShippingAddress;
use App\Models\Admin\Order\SampleOrder;
use App\Models\Admin\Promo\Promo;
use App\Models\Front\Cart\Cart;
use App\Models\SampleCart;
use App\Models\User;
use App\Notifications\SampleOrderAdminNotification;
use App\Notifications\SampleOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;



class SampleCheckoutController extends PaymentController
{
    public function index(Request $request)
    {
        $getCookieCartId = $_COOKIE['__sb_sample_cart'] ?? '';
        return $request->all();
    }
    public function view($id)
    {
        $sample_cart = SampleCart::where('external_id', $id)->first();
        if(empty($sample_cart)){
            return redirect('/');
        }
        $colorGroups = [];
        $sampleCartProducts = SampleCart::where('external_id', $id)->groupBy('product_id')->get();
        $allSampleCarts = SampleCart::where('external_id', $id)->get();
        $CheckOrder = DB::table('sample_orders')->where('sample_cart_external_id', $id)->first();

        if (!empty($CheckOrder->sample_order_id)) {
            return redirect()->route('frontend.sample.thank.you', $id);
        }
        $sample_cart = SampleCart::where('external_id', $id)->first();

        $AutoSavedData = AbandonedCustomer::where('sample_cart_id', $sample_cart->id)->first();

        return view('frontend.sample-checkout', compact('sampleCartProducts', 'colorGroups', 'id', 'allSampleCarts', 'AutoSavedData'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'shipping_first_name' => 'required',
            'shipping_last_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required|min:16',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_province' => 'required',
            'shipping_postal_code' => ['required', 'regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/'],
        ], [
            'shipping_phone.min' => 'Shipping phone number is invalid.',
            'shipping_postal_code.required' => 'Please fill out the postal code field.',
            'shipping_postal_code.regex' => 'Please enter in a proper Canadian postal code.'
        ]);

        if (!empty($request->input('postal_service')) && $request->input('postal_service') == true) {
            $request->validate([
                'card_number' => 'required',
                'card_name' => 'required',
                'card_expiry' => 'required',
                'card_cvc' => 'required',
            ]);
        }
        if ($request->input('BillingInformation') != 1) {
            $request->validate([
                'billing_first_name' => 'required',
                'billing_last_name' => 'required',
                'billing_email' => 'required',
                'billing_phone' => 'required|min:16',
                'billing_address' => 'required',
                'billing_city' => 'required',
                'billing_province' => 'required',
                'billing_postal' => 'required|regex:/^[ABCEGHJKLMNPRSTVXY]\d[A-Z] *\d[A-Z]\d$/',
            ], [
                'billing_phone.min' => 'Billing phone number is invalid.',
                'billing_postal.required' => 'Please fill out the postal code field.',
                'billing_postal.regex' => 'Please enter your postal code following this format X0X 0X0 (for example H3Y 2B6)'
            ]);
        }

        $orderPrice = '20.00';

        $order_id = $this->generateOrderID('HBS');;

        $customer_id = ucfirst($request->shipping_first_name) . ' ' . ucfirst($request->shipping_last_name);

        if (!empty($request->input('postal_service')) && $request->input('postal_service') == true) {
            $payment = $this->paymentWithMonerisGetway($request, $orderPrice, $order_id, $customer_id);
            $rsponse = $payment->getMessage();
            if (str_contains($rsponse, 'APPROVED') !== false) {
                return $this->samapleOrderDataStore($request, $order_id, $id, $payment);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'There is a problem with the card details provided.',
                ]);
            }
        }
        return $this->samapleOrderDataStore($request, $order_id, $id);
    }
    private function samapleOrderDataStore($request, $order_id, $id, $paymentResponse = null)
    {
        $no_of_sample = SampleCart::where('external_id', $id)->count();
        try {
            if ($paymentResponse) {
                $reponse = $this->convertTheresponse($paymentResponse);
            }

            DB::beginTransaction();
            $sampleOrder = new SampleOrder();
            $sampleOrder->sample_cart_id = $request->input('new_cart_id');

            $sampleOrder->sample_cart_external_id = $id;

            $sampleOrder->sample_order_id = $order_id;
            $sampleOrder->order_status = true;
            $sampleOrder->shipping_type = $request->input('postal_service');
            $sampleOrder->card_number = $request->input('card_number');
            $sampleOrder->card_name = $request->input('card_name');
            $sampleOrder->card_expiry = $request->input('card_expiry');
            $sampleOrder->card_cvc = $request->input('card_cvc');
            $sampleOrder->is_have_billing = !empty($request->input('BillingInformation')) ? $request->input('BillingInformation') : 0;
            $sampleOrder->no_of_windows = $request->input('windows');
            $sampleOrder->hear_us = $request->input('hear_us');
            $sampleOrder->payment_response = $reponse ?? '';

            if (!empty($request->input('BillingInformation')) && $request->input('BillingInformation') == true) {
                $sampleOrder->card_number = $request->input('card_number');
                $sampleOrder->card_name = $request->input('card_name');
                $sampleOrder->card_expiry = $request->input('card_expiry');
                $sampleOrder->card_cvc = $request->input('card_cvc');
            }
            $sampleOrder->save();

            if (!empty($sampleOrder->id)) {
                if (DB::table('users')->where('email', $request->input('shipping_email'))->doesntExist()) {
                    $userData = User::firstOrCreate([
                        'first_name' => $request->input('shipping_first_name'),
                        'last_name' => $request->input('shipping_last_name'),
                        'email' => $request->input('shipping_email'),
                        'password' => bcrypt(Str::random(20)),
                        'is_guest' => true
                    ]);
                } else {
                    $userData = User::where('email', $request->input('shipping_email'))->first();
                }
                $shipping = ShippingAddress::create([
                    'user_id' => $userData->id,
                    'sample_cart_id' => $request->input('new_cart_id'),
                    'sample_cart_external_id' => $id,
                    'sample_order_id' => $sampleOrder->id,
                    'first_name' => $request->input('shipping_first_name'),
                    'last_name' => $request->input('shipping_last_name'),
                    'email' => $request->input('shipping_email'),
                    'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->input('shipping_phone'))),
                    'street' => $request->input('shipping_address'),
                    'area_code' => $request->input('shipping_apt'),
                    'city' => $request->input('shipping_city'),
                    'province' => $request->input('shipping_province'),
                    'postal_code' => $request->input('shipping_postal_code'),
                ]);
                if (empty($request->input('BillingInformation'))) {
                    $billing = BillingAddress::create([
                        'user_id' => $userData->id,
                        'sample_cart_id' => $request->input('new_cart_id'),
                        'sample_cart_external_id' => $id,
                        'sample_order_id' => $sampleOrder->id,
                        'first_name' => $request->input('billing_first_name'),
                        'last_name' => $request->input('billing_last_name'),
                        'email' => $request->input('billing_email'),
                        'phone_number' => str_replace(' ', '', preg_replace("/[^A-Za-z0-9 ]/", '', $request->input('billing_phone'))),
                        'street' => $request->input('billing_address'),
                        'area_code' => $request->input('billing_apt'),
                        'city' => $request->input('billing_city'),
                        'province' => $request->input('billing_province'),
                        'postal_code' => $request->input('billing_postal'),
                    ]);
                }
            }

            $name = $request->input('shipping_first_name');
            DB::commit();
            $this->abandonedCustomerInfo($sampleOrder->id,$request);

            //for email data
            $sampleCartProducts = SampleCart::where('external_id', $id)->groupBy('product_id')->get();
             $allSampleCarts = SampleCart::where('external_id', $id)->get();

            foreach($allSampleCarts as $color){
                $order_color = Color::where('id', $color->color_id)->first();
                $order_quantity = $order_color->remaining_quantity + 1;
                $order_color->update(['remaining_quantity' => $order_quantity]);
            }
            $allSampleCarts = SampleCart::where('external_id', $id)->get();

            $promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->orderBy('created_at', 'desc')->first();

            Notification::route('mail', $request->input('shipping_email'))
                ->notify(new SampleOrderNotification($shipping, $sampleCartProducts, $allSampleCarts, $name, $order_id, $promo));
            if ($no_of_sample > '12') {
                Notification::route('mail', 'HeyBlindsOrders@gmail.com')
                    ->notify(new SampleOrderAdminNotification($shipping, $sampleCartProducts, $allSampleCarts, $name, $order_id, $promo));
            }

            return response()->json([
                'status' => true,
                'data' => $sampleOrder,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.'
            ]);
        }
    }

    public function allCart(Request $request)
    {
        $allCarts = SampleCart::where('external_id', $request->input('cart_id'))->get();
        $colors = [];
        $helpers = new Helpers();
        foreach ($allCarts as $sample) {
            $colors[] = [
                'name' => $sample->color->name,
                'group_name' => $sample->color->group->name ?? "",
                'image' => $helpers->getThumbnail($sample->color->color_image_id),
                'cart_id' => $sample->id,
                'product_id' => $sample->product_id,
                'color_id' => $sample->color_id,
            ];
        }
        return response()->json($colors);
    }

    public function thankYou($id)
    {
        $sampleOrder = SampleOrder::where('sample_cart_external_id', $id)->where('order_status', true)->firstOrFail();
        $cartItems = SampleCart::where('external_id', $id)->groupBy('product_id')->get();
        $allSampleCarts = SampleCart::where('external_id', $id)->get();
        $forGoogleTag = [];
        foreach ($cartItems as $item) {
            $forGoogleTag[] = [
                'sku' => $item->product->sku ?? '',
                'name' =>  str_replace(' ', ' ', preg_replace("/[^A-Za-z0-9 ]/", '', $item->product->name ?? '')),
                'category' => $item->product->category->name ?? '',
                'price' => number_format(!empty($item->purchase_price) ? $item->purchase_price : 0.00, 2),
                'quantity' => $item->quantity ?? '1',
            ];
        }
        $dataTag =   json_encode($forGoogleTag);
        
        return view('frontend.thank-you', compact('sampleOrder', 'item', 'dataTag'));
    }

    public function abandonedCustomerInfo($sampleOrderId,$request)
    {
        $getCookieCartId = $_COOKIE['__cart_items'] ?? '';
        $cart = Cart::where('external_id', $getCookieCartId)->first();
        if($cart){
        sampleOrder::where('id',$sampleOrderId)->update([
            'order_cart_status' => 1
        ]);
        AbandonedCustomer::updateOrCreate(
            [
                'cart_id' => $cart->id,
                //'created_at' => date('Y-m-d h:i:s'),
            ],
            [
                'cart_id' => $cart->id,
                'cart_type' => 2,
                'shipping_first_name' => $request->shipping_first_name ?? '',
                'shipping_last_name' => $request->shipping_last_name ?? '',
                'shipping_email' => $request->shipping_email ?? '',
                'shipping_phone_number' => $request->shipping_phone ?? '',
                'billing_province' => $request->shipping_province ?? '',
                'created_at' => date('Y-m-d h:i:s'),
            ]
        );
    }
        return null;
    }
}
