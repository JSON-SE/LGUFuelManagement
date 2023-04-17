<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\libs\ModelTrait;
use App\Models\SampleCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductReview;
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


class ProductController extends Controller
{
    //use ModelTrait;
    public function show($slug, Request $request, $cartId = null, $itemId = null)
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

        $getProductDetails = $this->getProductDetails($slug);
        $product = $getProductDetails->product;
        $allActiveOptions = $getProductDetails->options;


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

        $coupon = $this->coupon($defaultPrice, !empty($cartItem) ? $cartItem->promo_name : null);

        $finalPriceAfterDiscount = (float)$defaultPrice - ((float) !empty($coupon) ? $coupon['total'] : 0);

        if (!empty($coupon['type']) == "percentage") {
            $initialDiscount = $coupon['discount'] . "%";
        } elseif (!empty($coupon['type']) == "flat") {
            $initialDiscount = "$" . $coupon['discount'];
        }
        $productReviews = ProductReview::where('status', 1)->where('product_id', $product->id)->orderByDesc('created_at')->get();
        $avgOfproductReviews = ProductReview::where('status', 1)->where('product_id', $product->id)->avg('rating_point');
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

        $allRequest = $request->all();
        $optionsPrice = 0;
        $initialDiscount = 0;
        $rulesData = [];


        $getPrice = (float) DB::table('product_prices')->where('product_id', $id)->where('width', '>=', $defaultWidth)->where('height', '>=', $defaultHeight)->pluck('price')->first();

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
        if ($request->input('extra') != "option_width") {
            foreach ($allRequest as $key => $data) {
                $option = explode('_', $key);
                if ($key == "option_color") {
                    $optionColor = ProductColor::findOrFail($data);
                    if (!empty($optionColor->amount_percentage)) {
                        $optionsPrice += ($optionColor->amount_percentage / 100) * $getPrice;
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
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $getPrice;
                                }
                            } elseif (!empty($optionPrice->min_width) && !empty($optionPrice->max_width) && ($width <= $optionPrice->max_width) && ($width >= $optionPrice->min_width)) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $getPrice;
                                }
                            } elseif (empty($optionPrice->min_width) && !empty($optionPrice->max_width) && $width <= $optionPrice->max_width) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $getPrice;
                                }
                            } elseif (!empty($optionPrice->min_width) && empty($optionPrice->max_width) && $width >= $optionPrice->min_width) {
                                if ($optionPrice->type == 1) {
                                    $optionsPrice += (float) $optionPrice->price;
                                } elseif ($optionPrice->type == 2) {
                                    $optionsPrice += (float) ($optionPrice->price / 100) * $getPrice;
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
                                    $optionsPrice += ($subData->sub_option_price / 100) * $getPrice;
                                }
                            }
                        }
                    }
                }
            }
        }
        //        $coupon = [];
        $coupon = $this->coupon($getPrice);

        $finalPriceAfterDiscount = (float)  $getPrice - ((float) !empty($coupon) ? (float)$coupon['total'] : 0);
        $price = ((float)$finalPriceAfterDiscount + (float)$optionsPrice);
        $finalOptionPrice = (float) $optionsPrice / (1  - (($coupon['discount'] ?? 0) / 100));
        $rulesData['price'] = $this->helpers->withoutRounding($price, 2);
        $rulesData['optionPrices'] = $this->helpers->withoutRounding($optionsPrice, 2);
        $rulesData['unitPrice'] = $this->helpers->withoutRounding(((float) $getPrice + $finalOptionPrice), 2);
        $rulesData['measurement'] = $this->helpers->withoutRounding(((float) $getPrice), 2);

        return response()->json($rulesData);
    }

    public function store(Request $request, $id)
    {
        $unitAmount =  (float) filter_var($request->input('unit_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $measurement =  (float) filter_var($request->input('measurement_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $purchaseAmount =  (float) filter_var($request->input('total_price'), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $coupon = $this->coupon($measurement);

        $cartD = Cart::where('external_id', $request->input('cart_id'))->first();

        if (
            (bool) $request->input('edit_product') == true
            && !empty($request->input('itemId'))
            && DB::table('carts')->where('external_id', $request->input('cart_id'))->exists()
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

            $cartD->cart_amount = (float) $totalAmount + (float)$purchaseAmount;
            $cartD->cart_total_price = (float) $totalUnitAmount + (float) $unitAmount;


            if (!empty($cartD) && !empty($cartD->coupon)  && !empty($cartD->discount)) {
                $cartAmount = (float)$cartD->cart_amount;

                $couponCode = Coupon::where('code', $cartD->coupon)->first();

                // return ($coupon);

                if ($cartD->cart_amount > $couponCode->min_amount) {
                    if ($cartD->coupon_type == "percentage") {
                        $totalDiscountAmount = ((float)$cartAmount * (float)$cartD->discount) / 100;
                    } elseif ($cartD->coupon_type == "flat") {
                        $totalDiscountAmount = (float) $cartD->discount;
                    }
                    $cartD->cart_item_discount = $totalDiscountAmount;
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
            $cartItem->unit_price = (float) $this->helpers->withoutRounding($unitAmount * ((int) $cartItem->quantity ?? 0), 2);
            $cartItem->promo_price = (float) $this->helpers->withoutRounding($unitAmount * ((int) $cartItem->quantity ?? 0) - (float) $purchaseAmount * ((int) $cartItem->quantity ?? 0), 2); //!empty($coupon) ? ((float) $coupon['total']  * ((int) $cartItem->quantity ?? 0) ): "";
            $cartItem->promo_type = !empty($coupon) ? $coupon['type'] : "";
            $cartItem->promo_discount = !empty($coupon) ? $coupon['discount'] : "";
            $cartItem->option_value = json_encode($request->except(['_token', 'itemId', 'edit_product', 'cart_id']));
            $cartItem->purchase_price = (float) $this->helpers->withoutRounding($purchaseAmount * ((int) $cartItem->quantity ?? 0), 2);
            $cartItem->sub_total = (float) $this->helpers->withoutRounding($purchaseAmount * ((int) $cartItem->quantity ?? 0), 2);
            $cartItem->save();
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
                $cartD->cart_amount = (float) $cartD->cart_amount + $purchaseAmount;
                $cartD->cart_total_price = (float) $cartD->cart_total_price + $unitAmount;

                if (!empty($cartD) && !empty($cartD->coupon)  && !empty($cartD->discount)) {
                    $cartAmount = $cartD->cart_amount;
                    $coupon = Coupon::where('code', $cartD->coupon)->first();
                    // return ($coupon);
                    if ($cartD->cart_amount > $coupon->min_amount) {
                        if ($cartD->coupon_type == "percentage") {
                            $totalDiscountAmount = ((float)$cartAmount * (float)$cartD->discount) / 100;
                        } elseif ($cartD->coupon_type == "flat") {
                            $totalDiscountAmount = (float) $cartD->discount;
                        }
                        $cartD->cart_item_discount = $totalDiscountAmount;
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
                CartItem::create([
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
        //for action report
        $this->storeActionReport($cartD->id);
        return response()->json($cartD);
    }
    public function generateNewCartIds($prefix)
    {
        $cart_id = $prefix . '-' . random_int(100000, 999999);
        while (Cart::where('cart_id', $cart_id)->doesntExist()) {
            return $cart_id = $prefix . '-' . random_int(100000, 999990);
        }

        // do{
        //     $cart_id = $prefix.'-'.random_int(10000, 99999);
        //     $data = Cart::where('cart_id', $cart_id)->first();
        // }while (!empty($data));
        // return $cart_id;
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
            $coupon = Promo::where('code', $cartItem->promo_name)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->where('is_active', true)->orderByDesc('id')
                ->first();
        } else {
            $coupon = Promo::where('is_active', true)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->orderByDesc('id')
                ->first();
        }
        if (!empty($coupon) && $coupon->discount_type === "percentage") {
            $Discount = $coupon->amount;
            $discountPrice = (float) ($defaultPrice * $Discount) / 100;
            $data = [
                'id' => $coupon->id,
                'name' => $coupon->code,
                "type" => "percentage",
                "discount" => $Discount,
                "total" => (float) $this->helpers->withoutRounding($discountPrice, 2)
            ];
        } elseif (!empty($coupon) && $coupon->discount_type === "flat") {
            $discountPrice = $coupon->amount;
            $data = [
                'id' => $coupon->id,
                'name' => $coupon->code,
                "type" => "flat",
                "discount" => $discountPrice,
                "total" => (float) $this->helpers->withoutRounding($discountPrice, 2)
            ];
        }

        return $data ?? null;
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
        $groupHeadings = OptionGroup::whereNotNull('group_heading')->orderBy('order_by')->get()->unique('group_heading');

        $showableGroups = [];
        foreach ($allActiveOptions as $activeOption) {
            if (!empty($activeOption->option) && !empty($activeOption->option->group->group_heading)) {
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
        $product = Product::where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('colors')
            ->whereHas('options')
            ->where('slug', $slug)
            ->firstOrFail();

        //$product = Product::where('slug', $slug)->with(['category', 'colors', 'options', 'price'])->first();
        if (!empty($product))
            $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', true)->get();

        return (object)[
            'product' => $product ?? null,
            'options' => $allActiveOptions ?? null
        ];
    }

    private function isValidPRoduct($product, $options)
    {
        if ($product->draft == true || $product->is_live == false || empty($product->price) || empty($options->toArray()) || empty($product->colors))
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
