<?php

namespace App\Http\Controllers\Front;

use Cookie;
use Session;
use Carbon\Carbon;
use App\libs\ModelTrait;
use App\Models\Headrail;
use App\Models\Subpromo;
use App\Models\SampleCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\HandlingPrice;
use App\Models\ProductReview;
use App\Models\ShippingPrice;
use App\Models\HeadrailOption;
use App\Models\Front\Cart\Cart;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Coupon\Coupon;
use App\Models\Front\Cart\CartItem;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Option;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\SubOption;
use App\Models\Admin\Product\OptionGroup;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductOption;
use App\Models\Admin\Product\ProductOptionRules;


class FrontProductController extends Controller
{
    //use ModelTrait;
    public function view($slug, Request $request, $cartId = null, $itemId = null)
    {
        $isEditProduct = false;
        $optionValue = [];
        $cartItem = [];
        $editProductColor = [];
        $optionArrayForJs = [];
        $initialDiscount = 0;
        $getCookieCartId = $this->getCookies();

        $width_fraction_val = !empty($request->input('wf')) ? str_replace('-', '/', $request->input('wf')) : null;
        $filter_height_fraction = !empty($request->input('hf')) ? str_replace('-', '/', $request->input('hf')) : null;

        $filter_width = ((int) $request->input('w') ?? 0) + (!empty($width_fraction_val) ? 1 : 0);
        $filter_height = ((int) $request->input('h') ?? 0) + (!empty($filter_height_fraction) ? 1 : 0);
        $getWidth = (int) $request->input('w') ?? 0;
        $getHeight = (int) $request->input('h') ?? 0;

        $product = $this->getProductDetails($slug);

        $allActiveOptions = $product->options;

        if (!empty($cartId)) {
            $cart = Cart::where('external_id', $cartId)->first();
            $cartItem = CartItem::where('id', $itemId)->where('cart_id', $cart->id)->where('product_id', $product->id)->first();
            if (empty($cart) || empty($cartItem))
                abort(404);
            try {
                $optionValue = json_decode($cartItem->option_value, true);
            } catch (\Exception $e) {
                abort(404);
            }
            $isEditProduct = true;
            $editProductColor = ProductColor::findOrFail($optionValue['option_color']);
        }

        $allSamples = $this->getSamples($getCookieCartId, $request, $product->id);

        $getGroups = $this->getGroups($allActiveOptions);
        $groupHeadings = $getGroups->groupHeadings;
        $showableGroups = $getGroups->showableGroups;
        $allGroups = $getGroups->allGroups;

        $finalWidth = (!empty($cartId) && !empty($optionValue['option_width'])) ? (int)$optionValue['option_width'] : (!empty($filter_width) ? (int) $filter_width : (int) $product->default_width);
        $finalHeight = (!empty($cartId) && !empty($optionValue['option_width'])) ? (int)$optionValue['option_height'] : (!empty($filter_height) ? (int) $filter_height : (int) $product->default_height);

        $getPrice = $this->getPrice($request, $product, $finalWidth, $finalHeight);

        $width = $getPrice->width;
        $height = $getPrice->height;

        $defaultWidth = (int) $getPrice->defaultWidth - (!empty($width_fraction_val) ? 1 : 0);
        $defaultHeight = (int) $getPrice->defaultHeight - (!empty($filter_height_fraction) ? 1 : 0);

        $defaultPrice = $getPrice->defaultPrice;

        $product_promo = $this->coupon($defaultPrice, !empty($cartItem) ? $cartItem->promo_name : null, $product->id);

        $finalPriceAfterDiscount = (float)$defaultPrice - ((float) !empty($product_promo) ? $product_promo['total'] : 0);
        $extra_price = (((float) !empty($product_promo) ? $product_promo['extra_discount'] : 0) / 100) * $finalPriceAfterDiscount;
        $finalPriceAfterDiscount = $finalPriceAfterDiscount - $extra_price;

        if (!empty($product_promo['type'])) {
            if ($product_promo['type'] == "percentage") {
                $initialDiscount = $product_promo['discount'] . "%";
            } elseif ($product_promo['type'] == "flat") {
                $initialDiscount = "$" . $product_promo['discount'];
            }
        }

        $productReviews = ProductReview::where('status', 1)->where('product_id', $product->id)->orderByDesc('created_at')->get();
        $avgOfproductReviews = ProductReview::where('status', 1)->where('product_id', $product->id)->avg('rating_point');
        $headrails = Headrail::where('product_id', $product->id)->get();
        $headrailOption = HeadrailOption::where('product_id', $product->id)->first();

        return view(
            'frontend.product',
            compact(
                'product',
                'showableGroups',
                'optionArrayForJs',
                'defaultPrice',
                'finalPriceAfterDiscount',
                'initialDiscount',
                'groupHeadings',
                'width',
                'height',
                'allGroups',
                'allSamples',
                'isEditProduct',
                'optionValue',
                'cartItem',
                'editProductColor',
                'width_fraction_val',
                'filter_height_fraction',
                'defaultHeight',
                'defaultWidth',
                'getWidth',
                'getHeight',
                'productReviews',
                'avgOfproductReviews',
                'headrails',
                'product_promo',
                'headrailOption'
            )
        );
    }

    public function price(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $prices = !empty($product->price) ? $product->price : [];
        $widthArray = [];
        $heightArray = [];
        foreach ($prices as $price) {
            $widthArray[] = $price->width;
            $heightArray[] = $price->height;
        }

        $arrayWidth = array_unique($widthArray);
        $arrayHeight = array_unique($heightArray);

        $width = (int)$request->input('option_width') + (!empty($request->input('option_width_fraction')) ? 1 : 0);
        $height = (int)$request->input('option_height') + (!empty($request->input('option_height_fraction')) ? 1 : 0);

        $defaultWidth = (int) $width < reset($arrayWidth) ? reset($arrayWidth) :  $width;
        $defaultHeight = (int) $height < reset($arrayHeight) ? reset($arrayHeight) : $height;
        Session::put('session_width', (int)$request->input('option_width'), 3600);
        Session::put('session_height', (int)$request->input('option_height'), 3600);
        Session::put('session_width_fraction', $request->input('option_width_fraction'), 3600);
        Session::put('session_height_fraction', $request->input('option_height_fraction'), 3600);

        $allRequest = $request->all();
        $optionsPrice = 0;
        $initialDiscount = 0;
        $rulesData = [];

        $headrailOption = HeadrailOption::where('product_id', $id)->first();
        if ($request->headrail_option == 1 && $headrailOption->is_separate_blinds == 1) {
            $headrail_left_width = (int)$request->headrail_left_filter_width;
            $headrail_right_width = (int)$request->headrail_filter_right_width;
            $getPrice_left_width = (float) DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $headrail_left_width)->where('height', '>=', $defaultHeight)->pluck('price')->first();
            $getPrice_right_width = (float) DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $headrail_right_width)->where('height', '>=', $defaultHeight)->pluck('price')->first();
            $getPrice = $getPrice_left_width + $getPrice_right_width;
        } else {
            $getPrice = (float) DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $defaultWidth)->where('height', '>=', $defaultHeight)->pluck('price')->first();
        }

        $productPriceDiscoutnt = $this->coupon($getPrice, null, $id);
        $discount = 0;

        if (isset($productPriceDiscoutnt['discount'])) {
            $discount =   (float)$productPriceDiscoutnt['discount'] ?? '0.00';
        }
        $afterDiscount = (float)($discount / 100) * $getPrice; // curent one
        // if($productPriceDiscoutnt['type'] == 'percentage'){
        //    $afterDiscount = (float)($discount / 100) * $getPrice; // curent one
        // }
        // else{
        //      $afterDiscount = $getPrice - $discount;
        // }
        $currentAmount = (float)$getPrice - $afterDiscount;

        $getProductOptions = ProductOption::where('product_id', (int)$id)->where('min_width', '<>', "")->where('max_width', '<>', "")->where("is_active", true)->get();

        if ($request->input('extra') === "option_width") {
            foreach ($getProductOptions as $getProductOption) {
                $options = Option::find($getProductOption->option_id);
                if (!empty($options) && ($width >= $getProductOption->min_width && $width <= $getProductOption->max_width) || (empty($getProductOption->min_width)  && empty($getProductOption->max_width))) {
                    $rulesData['option']['width'][] = [
                        'name' => "option_" . Str::slug($options->group->name ?? "", "_") ?? "",
                        'option_name' => $options->name ?? "",
                        'class' => $options->slug ?? "",
                        'type' => $options->option_type ?? "",
                        'action' => 'enabled',
                        'value' => $options->id ?? "",
                    ];
                } elseif (!empty($options)) {
                    $rulesData['option']['width'][] = [
                        'name' => "option_" . Str::slug($options->group->name ?? "", "_") ?? "",
                        'option_name' => $options->name ?? "",
                        'class' => $options->slug ?? "",
                        'type' => $options->option_type ?? "",
                        'action' => 'disabled',
                        'value' => $options->id ?? "",
                    ];
                }
            }
        } else {
            $rulesData['option']['width'] = [];
        }

        if ($request->input('extra') != "") {
            foreach ($allRequest as $key => $data) {
                $option = explode('_', $key);
                if ($key == "option_color") {
                    $optionColor = ProductColor::findOrFail($data);
                    if (!empty($optionColor->amount_percentage)) {
                        $optionsPrice += ($optionColor->amount_percentage / 100) * $currentAmount;
                    }
                } else if ($key !== "option_width" && $key !== "option_height" && $option[0] === "option" && !empty($data) && !is_string((int)$data)) {
                    $productOption = ProductOption::where('product_id', $id)->where('option_id', (int)$data)->first();
                    $rules = ProductOptionRules::where('product_id', $id)->where('option_id', (int)$data)->get();
                    if (!empty($productOption) && !empty($productOption->option->price)) {
                        foreach ($productOption->option->price as $optionPrice) {
                            if (empty($optionPrice->min_width) && empty($optionPrice->max_width)) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $currentAmount;
                                }
                            } elseif (!empty($optionPrice->min_width) && !empty($optionPrice->max_width) && ($width <= $optionPrice->max_width) && ($width >= $optionPrice->min_width)) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $currentAmount;
                                }
                            } elseif (empty($optionPrice->min_width) && !empty($optionPrice->max_width) && $width <= $optionPrice->max_width) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $currentAmount;
                                }
                            } elseif (!empty($optionPrice->min_width) && empty($optionPrice->max_width) && $width >= $optionPrice->min_width) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $currentAmount;
                                }
                            }
                        }
                    }


                    if (!empty($rules)) {
                        foreach ($rules as $rule) {
                            if ($rule->type === "option") {
                                $options = Option::find($rule->type_id);
                                $rulesData['option'][] = [
                                    'name' => "option_" . Str::slug($options->group->name ?? "", '_'),
                                    'option_name' => $options->name,
                                    'class' => $options->slug,
                                    'action' => $rule->operator,
                                    'value' => $rule->type_id,
                                    'type' => $options->option_type,
                                ];
                            } elseif ($rule->type === "group") {
                                $optionGroup = OptionGroup::find($rule->type_id);
                                $rulesData['group'][] = [
                                    'name' => "group_" . Str::slug($optionGroup->name, '_'),
                                    'group_name' => $optionGroup->name,
                                    'class' => $optionGroup->slug,
                                    'action' => $rule->operator,
                                    'value' => $rule->type_id,
                                ];
                            }
                        }
                    }
                } elseif ($key !== "option_width" && $key !== "option_height" && $option[0] === "suboption") {
                    $subOption = SubOption::find($data);
                    if (!empty($subOption)) {
                        $allData = SubOption::where('option_id', $subOption->option_id)->where('sub_option_name', $subOption->sub_option_name)->get();
                        foreach ($allData as $subData) {
                            if (($width >= $subData->sub_option_min_width && $width <= $subData->sub_option_min_height) || (empty($subData->sub_option_min_width) && empty($subData->sub_option_min_height)) && !empty($subData->sub_option_price)) {
                                if ($subData->sub_option_price_type == 1) {
                                    $optionsPrice += $subData->sub_option_price;
                                } elseif ($subData->sub_option_price_type == 2) {
                                    $optionsPrice += ($subData->sub_option_price / 100) * $currentAmount;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($request->headrail_option == 1) {
            $optionsPrice +=  $this->calculationHeadrail($allRequest, $id, $currentAmount, $width);
            // return $optionsPrice =  $this->calculationHeadrail($allRequest, $id, $currentAmount, $width);
        }

        $promo = $this->coupon($getPrice, null, $id);

        $finalPriceAfterDiscount = (float)  $getPrice - ((float) !empty($promo) ? (float)$promo['total'] : 0);
        $price = ((float)$finalPriceAfterDiscount + (float)$optionsPrice);
        $extra_price = (((float) !empty($promo) ? $promo['extra_discount'] : 0) / 100) * $price;
        $after_extra_discount = $price - $extra_price;


        if ($promo['type'] == 'percentage') {
            $finalOptionPrice = (float) $optionsPrice / (1  - (($promo['discount'] ?? 0) / 100));
        } else {
            $finalOptionPrice = (float)$optionsPrice;
        }

        $rulesData['price'] = $this->helpers->withoutRounding($after_extra_discount, 2);
        $rulesData['optionPrices'] = $this->helpers->withoutRounding($optionsPrice, 2);
        $rulesData['unitPrice'] = $this->helpers->withoutRounding(((float) $getPrice + $finalOptionPrice), 2);
        $rulesData['measurement'] = $this->helpers->withoutRounding(((float) $getPrice), 2);

        return response()->json($rulesData);
    }


    private function calculationHeadrail($request, $id, $currentAmount, $width)
    {
        $optionsPrice = 0;

        $width = (int)$width;
        $headrail_max = (int)Headrail::where('product_id', $id)->max('max_width');

        $headrail = Headrail::where('product_id', (int)$id)->where('max_width', '>=', $width)->first();

        if ($headrail) {
            if ($headrail->price_type == 1) {
                $optionsPrice += (float) $headrail->price;
            } elseif ($headrail->price_type == 2) {
                $optionsPrice += (float) ($headrail->price / 100) * $currentAmount;
            }
        }
        return $optionsPrice;
    }

    public function store(Request $request, $id)
    {
        $unitAmount =  (float) filter_var($request->input('unit_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $measurement =  (float) filter_var($request->input('measurement_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $purchaseAmount =  (float) filter_var($request->input('total_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        try {
            DB::beginTransaction();
            $coupon = $this->coupon($measurement, null, $id);
            $purchaseAmount = (float) $purchaseAmount / (1  - (((float) !empty($coupon) ? $coupon['extra_discount'] : 0) / 100));

            $cartD = Cart::where('external_id', $request->input('cart_id'))->first();

            if (
                (bool) $request->input('edit_product') == true
                && !empty($request->input('itemId'))
                && $cartD
                && DB::table('cart_items')->where('id', $request->input('itemId'))->exists()
                && $request->input('itemId') != "null"
                && $request->input('itemId') != ""
                && $request->input('itemId') != "0"
                && $request->input('itemId') != null
                && $request->input('itemId') != "undefined"
                && $request->input('cart_id') != "null"
                && $request->input('cart_id') != ""
                && $request->input('cart_id') != "0"
                && $request->input('cart_id') != null
                && $request->input('cart_id') != "undefined"
            ) {

                $cartItem = CartItem::findOrfail($request->input('itemId'));

                $totalAmount = (float)$cartD->cart_amount - (float)$cartItem->purchase_price;
                $totalUnitAmount = (float) $cartD->cart_total_price - (float) $cartItem->unit_price;

                $cartD->cart_amount = (float) $totalAmount + (float)$cartItem->purchase_price; //new calculation
                $cartD->cart_total_price = (float) $totalUnitAmount + (float) $unitAmount;


                if (!empty($cartD) && !empty($cartD->coupon)  && !empty($cartD->discount)) {
                    $cartAmount = (float)$cartD->cart_amount;

                    $couponCode = Coupon::where('code', $cartD->coupon)->first();

                    if ($cartD->cart_amount > $couponCode->min_amount) {
                        if ($cartD->coupon_type == "percentage") {
                            $totalDiscountAmount = (float)(((float)$cartAmount * (float)$cartD->discount) / 100);
                        } elseif ($cartD->coupon_type == "flat") {
                            $totalDiscountAmount = (float) $cartD->discount;
                        }
                        $cartD->cart_item_discount = (float)$totalDiscountAmount;
                    } else {
                        $cartD->cart_item_discount = "";
                        $cartD->coupon_type = "";
                        $cartD->coupon = "";
                        $cartD->discount = "0";
                    }
                }

                $cartD->user_id = Auth::id() ?? null;
                $cartD->save();
                $cartItem->promo_name = !empty($coupon) ? $coupon['name'] : "";
                $cartItem->unit_price = (float)$unitAmount * ((int) $cartItem->quantity ?? 0);
                $cartItem->promo_price = (float)$unitAmount * ((int) $cartItem->quantity ?? 0) - (float) $purchaseAmount * ((int) $cartItem->quantity ?? 0); //!empty($coupon) ? ((float) $coupon['total']  * ((int) $cartItem->quantity ?? 0) ): "";
                $cartItem->promo_type = !empty($coupon) ? $coupon['type'] : "";
                $cartItem->promo_discount = !empty($coupon) ? $coupon['discount'] : "";
                $cartItem->option_value = json_encode($request->except(['_token', 'itemId', 'edit_product', 'cart_id']));
                $cartItem->purchase_price = (float) $this->helpers->withoutRounding($purchaseAmount * ((int) $cartItem->quantity ?? 0), 2);
                $cartItem->sub_total = (float) $this->helpers->withoutRounding($purchaseAmount * ((int) $cartItem->quantity ?? 0), 2);
                $cartItem->save();
                // $this->helpers->addExtraPrice($cartD);
            } else {
                if (
                    DB::table('carts')->where('external_id', $request->input('cart_id'))->doesntExist()
                    || empty($request->input('cart_id'))
                    || $request->input('cart_id') == "null"
                    || $request->input('cart_id') == ""
                    || $request->input('cart_id') == "0"
                    || $request->input('cart_id') == null
                    || $request->input('cart_id') == "undefined"
                ) {
                    $genetare_cart_id = $this->generateNewCartIds('HBC');
                    $cartD = Cart::create([
                        'external_id' => Str::uuid(),
                        'cart_id' => $genetare_cart_id,
                        'user_id' => Auth::id() ?? null,
                        'cart_amount' => $purchaseAmount,
                        'cart_total_price' => $unitAmount,
                        'cart_draft' => Auth::id() ? true : false,
                    ]);

                    $cart = $cartD->id;
                } else {

                    $cartD->cart_amount = (float) $cartD->cart_amount + $purchaseAmount; //old calculation
                    //$cartD->cart_amount = (float) $cartD->cart_amount  +(float)$cartItem->purchase_price; //new calculation
                    $cartD->cart_total_price = (float) $cartD->cart_total_price + $unitAmount;


                    if (!empty($cartD) && !empty($cartD->coupon)  && !empty($cartD->discount)) {
                        $cartAmount = (float)$cartD->cart_amount;
                        $coupon = Coupon::where('code', $cartD->coupon)->first();

                        if ($cartD->cart_amount > $coupon->min_amount) {
                            if ($cartD->coupon_type == "percentage") {
                                $totalDiscountAmount = ((float)$cartAmount * (float)$cartD->discount) / 100;
                            } elseif ($cartD->coupon_type == "flat") {
                                $totalDiscountAmount = (float) $cartD->discount;
                            }
                            $cartD->cart_item_discount = (float)$totalDiscountAmount;
                        } else {
                            $cartD->cart_item_discount = "";
                            $cartD->coupon_type = "";
                            $cartD->coupon = "";
                            $cartD->discount = "0";
                        }
                    }
                    $cartD->user_id = Auth::id() ?? null;
                    $cartD->cart_draft = Auth::id() ? true : false;
                    $cartD->save();
                    $cart = $cartD->id;
                }

                if (!empty($cart)) {
                    $create_cart = CartItem::create([
                        'cart_id' => $cart,
                        'product_id' => $id,
                        'option_name' => 'line_items',
                        'promo_name' => !empty($coupon) ? $coupon['name'] : "",
                        'unit_price' => $unitAmount,
                        'promo_price' => (float) $unitAmount - (float) $purchaseAmount,
                        'promo_type' => !empty($coupon) ? $coupon['type'] : "",

                        'promo_discount' => !empty($coupon) ? $coupon['discount'] : "",
                        'option_value' => json_encode($request->except(['_token', 'itemId', 'edit_product', 'cart_id'])),
                        'purchase_price' => $purchaseAmount,
                        'sub_total' => $purchaseAmount,
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        //for action report
        $this->storeActionReport($cartD->id);
        return response()->json($cartD);
    }

    public function generateNewCartIds($prefix)
    {
        $number = $prefix . '-' . mt_rand(100000, 999999); // better than rand()
        // call the same function if the barcode exists already
        if ($this->cartNumberExists($number)) {
            return $this->generateNewCartIds($prefix);
        }
        return $number;
    }
    /**
     * query the database and return a boolean for instance, it might look like this in Laravel
     * @param  [type] $number
     * @return boolean
     */
    function cartNumberExists($number)
    {
        return Cart::whereCartId($number)->exists();
    }

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

    public function addToSampleCart(Request $request)
    {
        $cartId = Str::uuid();
        $sampleCart = [];
        if ((DB::table('sample_carts')->where('external_id', $request->input('cartid'))->where('product_id', $request->input('pid'))->where('color_id', $request->input('optid'))->doesntExist())) {
            if (empty($request->input('cartid')) || $request->input('cartid') == "null" || $request->input('cartid') == "" || $request->input('cartid') == "0" || $request->input('cartid') == null || $request->input('cartid') == "undefined") {
                $sampleCart = SampleCart::create([
                    'external_id' => $cartId,
                    'product_id' => $request->input('pid'),
                    'color_id' => $request->input('optid'),
                    'user_id' => Auth::id() ?? null
                ]);
            } else {
                $sampleCart = SampleCart::create([
                    'external_id' => $request->input('cartid'),
                    'product_id' => $request->input('pid'),
                    'color_id' => $request->input('optid'),
                    'user_id' => Auth::id() ?? null
                ]);
            }
            $sampleCart['productName'] = $sampleCart->product->name ?? "";
            $sampleCart['colorName'] = $sampleCart->color->name ?? "";
            $sampleCart['colorImage'] = $this->helpers->getThumbnail($sampleCart->color->color_image_id) ?? "";
        } else {
            $sampleCart['error'] = "null";
        }


        return response()->json($sampleCart);
    }

    public function removeSampleCart(Request $request)
    {
        if (!empty($request->input('pid')) && !empty($request->input('optid') && !empty($request->input('cartid')))) {
            $allSames =  SampleCart::where('external_id', $request->input('cartid'))->where('product_id', $request->input('pid'))->where('color_id', $request->input('optid'))->get();
            foreach ($allSames as $sample) {
                $sample->delete();
            }
        }

        return response()->json($request);
    }

    public function coupon($defaultPrice, $cartItem = null, $ProductId = null): ?array
    {
        $data = [];
        if (!empty($cartItem->promo_name)) {
            $promo = Promo::where('code', $cartItem->promo_name)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->where('is_active', true)->orderByDesc('id')
                ->first();
        } else {
            $promo = Promo::where('is_active', true)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->orderByDesc('id')
                ->first();
        }
        if ($promo) {
            $subpromo = Subpromo::where('product_id', $ProductId)->where('promo_id', $promo->id)->first();
            if ($subpromo) {
                if ($subpromo->promo_type == 'percentage') {
                    $discountPrice = (float) ($defaultPrice * $subpromo->discount) / 100;
                    $data = [
                        'id' => $promo->id,
                        'name' => $promo->code,
                        "type" => "percentage",
                        "discount" => $subpromo->discount,
                        'extra_discount' => $subpromo->extra_discount ?? 0,
                        "total" => (float) $this->helpers->withoutRoundingforOther($discountPrice, 2),
                    ];
                    return $data;
                } else {
                    // $discountPrice = (float) ($defaultPrice * $subpromo->discount) / 100;
                    $data = [
                        'id' => $promo->id,
                        'name' => $promo->code,
                        "type" => "flat",
                        "discount" => $subpromo->discount,
                        'extra_discount' => $subpromo->extra_discount ?? 0,
                        "total" => (float) $this->helpers->withoutRoundingforOther($subpromo->discount, 2),
                    ];
                    return $data;
                }
            } else {
                if (!empty($promo) && $promo->discount_type === "percentage") {
                    $discountPrice = (float) ($defaultPrice * $promo->amount) / 100;
                    $data = [
                        'id' => $promo->id,
                        'name' => $promo->code,
                        "type" => "percentage",
                        "discount" => $promo->amount,
                        'extra_discount' => $promo->extra_amount ?? 0,
                        "total" => (float) $this->helpers->withoutRoundingforOther($discountPrice, 2),
                    ];
                } elseif (!empty($promo) && $promo->discount_type === "flat") {
                    $data = [
                        'id' => $promo->id,
                        'name' => $promo->code,
                        "type" => "flat",
                        "discount" => $promo->amount,
                        'extra_discount' => $promo->extra_amount ?? 0,
                        "total" => (float) $this->helpers->withoutRoundingforOther($promo->amount, 2),
                    ];
                }
            }

            return $data ?? null;
        }
        return $data = [
            'id' => "",
            'name' => "",
            "type" => "percentage",
            "discount" => 0,
            'extra_discount' => 0,
            "total" => 0,
        ];
    }

    // Helper Method

    private function getCookies()
    {
        return $_COOKIE['__sb_sample_cart'] ?? '';
    }

    private function getPrice($request, $product, $dWidth, $dHeight)
    {

        $prices = !empty($product->price) ? $product->price : [];

        $widthArray = [];
        $heightArray = [];

        foreach ($prices as $price) {
            $widthArray[] = $price->width;
            $heightArray[] = $price->height;
        }

        $arrayWidth = array_unique($widthArray);
        $arrayHeight = array_unique($heightArray);

        $width = reset($arrayWidth) . "-" . end($arrayWidth);
        $height = reset($arrayHeight) . "-" . end($arrayHeight);

        $defaultWidth = (int) $dWidth < (int) reset($arrayWidth) ? (int) reset($arrayWidth) :  (int) $dWidth;
        $defaultHeight = (int) $dHeight < (int) reset($arrayHeight) ? (int) reset($arrayHeight) : (int) $dHeight;

        $defaultPrice = (float) DB::table('product_prices')
            ->where('product_id', $product->id)
            ->where('width', '>=', $defaultWidth)
            ->where('height', '>=', $defaultHeight)
            ->pluck('price')->first();

        return (object) [
            'width' => $width,
            'height' => $height,
            'defaultPrice' => $defaultPrice,
            'defaultWidth' => $defaultWidth,
            'defaultHeight' => $defaultHeight,
        ];
    }

    private function getGroups($allActiveOptions)
    {
        $groupHeadings = OptionGroup::whereNotNull('group_heading')->whereHas('option')->orderBy('order_by')->get()->unique('group_heading');

        $showableGroups = [];
        foreach ($allActiveOptions as $activeOption) {
            if (!empty($activeOption->option->group->group_heading)) {
                $showableGroups[] = $activeOption->option->group->group_heading;
            }
        }
        $allGroups = [];
        foreach ($groupHeadings as $heading) {
            $allGroups[] = OptionGroup::where('group_heading', $heading->group_heading)->get();
        }
        return (object)[
            'showableGroups' => $showableGroups ?? "",
            'allGroups' => $allGroups ?? "",
            'groupHeadings' => $groupHeadings ?? "",
        ];
    }

    private function getSamples($getCookieCartId, $request, $productId)
    {
        $allSamples = [];
        if (empty($getCookieCartId) || $request->input('cart_id') == "null" || $request->input('cart_id') == "" || $request->input('cart_id') == "0" || $request->input('cart_id') == null || $request->input('cart_id') == "undefined") {
            $allSamples = SampleCart::where('product_id', $productId)->where('external_id', $getCookieCartId)->get();
        }

        return $allSamples ?? null;
    }

    private function getProductDetails($slug)
    {
        return $product = Product::where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('colors')
            ->whereHas('options', function ($query) {
                $query->where('is_active', true);
            })

            ->where('slug', $slug)
            ->firstOrFail();
        // if (!empty($product))
        //     $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', true)->get();

        // return (object)[
        //     'product' => $product ?? null,
        //     'options' => $allActiveOptions ?? null
        // ];
    }

    private function isValidPRoduct($product, $options)
    {
        if ($product->draft == true || $product->is_live == false || empty($product->price) || empty($options) || empty($product->colors))
            return false;

        return true;
    }
    public function downlodPdf(Request $request, $id)
    {
        // $headers='application/json'

        $file = $this->helpers->getImage($id);

        $headers = array('Content-Type' => 'application/pdf',);

        return response()->download($file, 'ssss.pdf');
        //header('Content-Length: ' . filesize($file));

    }
}
