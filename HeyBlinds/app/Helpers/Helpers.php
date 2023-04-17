<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Admin;
use App\Models\Media;
use App\Models\Slider;
use App\Models\Subpromo;
use App\Models\SampleCart;
use App\Models\Admin\Color;
use Illuminate\Support\Str;
use App\Models\HandlingPrice;
use App\Models\ShippingPrice;
use App\Models\Front\Cart\Cart;
use App\Models\AbandonedCustomer;
use App\Models\Admin\Order\Order;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use App\Models\Front\Cart\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Product\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\AdditionalSettings;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductOption;
use App\Models\Admin\Category\SuperSubcategory;

class Helpers extends Facade
{
    /**
     * Description
     *
     * @param Request $request
     *
     * @return return Mix;
     */

    public function storeActionReport($request, $id)
    {
        AbandonedCustomer::updateOrCreate(
            [
                'cart_id' => $request->input('cart_id') ?? $id,
            ],
            [
                'cart_id' => $request->input('cart_id') ?? $id,
                'shipping_first_name' => $request->input('shipping_first_name') ?? '',
                'shipping_last_name' => $request->input('shipping_last_name') ?? '',
                'shipping_email' => $request->input('shipping_email') ?? '',
                'shipping_phone_number' => $request->input('shipping_phone_number') ?? '',
                'shipping_street' => $request->input('shipping_street') ?? '',
                'shipping_address' => $request->input('shipping_address') ?? '',
                'shipping_city' => $request->input('shipping_city') ?? '',
                'shipping_province' => $request->input('shipping_province') ?? '',
                'shipping_postal_code' => $request->input('shipping_postal_code') ?? '',
                'has_billing' => $request->input('billingInformation') ?? 0,
                'billing_first_name' => $request->input('billing_first_name') ?? '',
                'billing_last_name' => $request->input('billing_last_name') ?? '',
                'billing_email' => $request->input('billing_email') ?? '',
                'billing_phone_number' => $request->input('billing_phone_number') ?? '',
                'billing_street' => $request->input('billing_street') ?? '',
                'billing_address' => $request->input('billing_address') ?? '',
                'billing_city' => $request->input('billing_city') ?? '',
                'billing_province' => $request->input('billing_province') ?? '',
                'billing_postal_code' => $request->input('billing_postal_code') ?? '',
                'cart_type' => 1,
            ]
        );
    }
    public function shippingPriceForMaxwith($items)
    {
        $data = [];
        foreach ($items as $key => $item) {
            $value = json_decode($item->option_value, 1);
            $data[] =  $value['option_width'];
        }
        if (!empty($data)) {
            $min_width = min($data);
            $max_width = max($data);
            $shipping_price = ShippingPrice::where('min_width', '<=', $min_width)->where('max_width', '>', $max_width)->get()->first();
            return $shipping_price->amount ?? 0;
        }
        return 0;
    }
    public function haddlingPriceAddedTo($cart)
    {
        $cart_amount = (float)((float)$cart->cart_amount - (float)$cart->cart_item_discount);
        $handlingPrice = HandlingPrice::where('min_range', '<=', $cart_amount)->where('max_range', '>', $cart_amount)->get()->first();
        if (!empty($handlingPrice)) {
            return $handlingPrice->amount;
        }
        return 0;
    }
    public function addExtraPrice($cart)
    {

        $cart->shipping_extra_amount = $this->shippingPriceForMaxwith($cart->items) ?? 0;
        $extra_handling_price = $this->haddlingPriceAddedTo($cart);
        $cart->handling_extra_amount =  $extra_handling_price;
        $cart->save();
    }
    public function addExtraShippingPrice()
    {
        $shippingPrice = ShippingPrice::first();
        $shippingPrice =   ShippingPrice::where('min_range', '<=', $cart_amount)->where('max_range', '>', $cart_amount)->get()->first();
        $cart->shipping_extra_amount = $shippingPrice->amount ?? 0;
    }

    public function couponAmountCalculate($cart_id)
    {
        $cart =  Cart::where('id', $cart_id)->first();
        if (!empty($cart->coupon) && !empty($cart->discount)) {
            if ($cart->coupon_type === "percentage") {
                $cart->cart_item_discount = $this->helpers->withoutRounding(($cart->cart_amount * $cart->discount / 100), 2); //round(($totalSaveAmount * $couponAmount / 100), 2,PHP_ROUND_HALF_UP);
            } elseif ($cart->coupon_type === "flat") {
                $cart->cart_item_discount = $cart->discount;
            }
        }
    }

    public function taxCalculation($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->first();
        if ($cart) {
            $total_tax_amount = ($cart->cart_amount - $cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
            $tax = json_decode($cart->cart_tax, true) ?? [];
            $tatal_tax = array_sum(array_values($tax));
            foreach ($tax as $key => $value)
                $amount = $this->withoutRounding((($total_tax_amount) * $value) / 100, 2);
            $total_tax_amount = $this->withoutRounding((($total_tax_amount) * $tatal_tax) / 100, 2);
            return  $total_tax_amount;
        }
        return '0.00';
    }
    /**
     * Calculate Grand total amount
     *
     * @param string $id
     *
     * @return number format
     */
    public function grand_total_amount($id)
    {
        $cart =  Cart::where('id', $id)->first();
        if ($cart) {
            $totalAmount = ($cart->cart_amount - $cart->cart_item_discount) + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
            $total_tax_amount = ($cart->cart_amount - $cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
            $tax = json_decode($cart->cart_tax, true) ?? [];
            foreach ($tax as $key => $value) {
                $amount = (float)((($total_tax_amount) * $value) / 100);
                $totalAmount += $amount;
            }
            return $this->withoutRounding($totalAmount, 2);
        }
        return '0.00';
    }
    /**
     * Calculate Grand total amount
     *
     * @param string $id
     *
     * @return number format
     */
    public function grand_total_amount_of_google_analytic($id)
    {
        $cart =  Cart::where('id', $id)->first();
        if ($cart) {
            $totalAmount = ($cart->cart_amount - $cart->cart_item_discount) + ($cart->shipping_extra_amount + $cart->handling_extra_amount);
            $tax = json_decode($cart->cart_tax, true) ?? [];
            $total_tax_amount = ($cart->cart_amount - $cart->cart_item_discount) + ((float)$cart->shipping_extra_amount + (float)$cart->handling_extra_amount);
            foreach ($tax as $key => $value) {
                $amount = (float)(((($total_tax_amount) * $value) / 100));
                $totalAmount += $amount;
            }
            return $totalAmount;
        }
        return '0.00';
    }
    /**
     * for border color chnages
     * @param  [string] $external_id

     * @return return boolen
     */
    public function changeColorForMoreOrder($external_id)
    {
        $no_of_sample = SampleCart::where('external_id', $external_id)->count();
        if ($no_of_sample > 12) {
            return true;
        }
        return false;
    }
    /**
     * display the bannr link
     *
     * @param string $id
     *
     * @return $url
     */
    public function bannerUrl($id)
    {
        $slider = Slider::where('promo_id', $id)->first();
        return $slider->slider_link ??  '';
    }


    public function isAdminActive($email): bool
    {
        $admin = Admin::where('email', $email)->IsActive()->exists();
        if ($admin) {
            return true;
        }
        return false;
    }
    public function uploadImage($image, $from)
    {
        if (!empty($image)) {
            $save = $this->resizeImage($image, $from);
            return $save;
        }
        return null;
    }
    public function resizeImage($file, $from)
    {
        $OrgthumbPath = "";
        $extension    = $file->getClientOriginalExtension();
        $fileName     = $this->createFilename($file);
        $mime         = str_replace('/', '-', $file->getMimeType());
        $dateFolder   = date("Y-m-W");
        $filePath     = "public/upload/{$from}/{$mime}/{$dateFolder}";
        $path         = Storage::disk('s3')->put($filePath, $file, 'public');
        $OrgPath      = Storage::disk('s3')->url($path);
        $uploadedPath = "";
        if (Str::contains($mime, ['images', 'image', 'jpg', 'jpeg', 'png', 'gif'])) {

            $uploadedPath = "public/upload/{$mime}/{$dateFolder}/thumbnail/{$fileName}";
            $resize       = Image::make($file)->resize(150, 150)->encode($extension, 100);
            Storage::disk('s3')->put($uploadedPath, $resize->__toString(), 'public');
            $OrgthumbPath = Storage::disk('s3')->url($uploadedPath);
        }
        $media = Media::create([
            'name'          => $fileName,
            'original_path' => $path,
            'thumb_path'    => $uploadedPath,
            'original_url'  => $OrgPath,
            'thumb_url'     => $OrgthumbPath,
            'mime'          => $mime,
        ]);

        if (!empty($media->id)) {
            return $media->id;
        } else {
            return null;
        }
    }

    protected function createFilename($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension
        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;
        return $filename;
    }

    public function getImage($id)
    {
        $path = DB::table('media')->where('id', $id)->latest('id')->pluck('original_url')->first();

        if (!empty($path)) {
          //  return "https://d1k1o1rn9vl8hs.cloudfront.net/" . $path;
            return $path;
        } else {
            return asset('images/thumbnail/sample-image-min.jpg');
        }
    }
    public function getSliderImage($id)
    {
        $path = DB::table('media')->where('id', $id)->latest('id')->pluck('original_url')->first();
        if (!empty($path)) {
            return $path;
        } else {
            return asset('images/banner/HeyBlinds-warranty-1920x749.webp');
        }
    }

    public function getThumbnail($id)
    {
        $path = DB::table('media')->where('id', $id)->latest('id')->pluck('thumb_url')->first();
        if (!empty($path)) {
            return $path;
        } else {
            return asset('images/thumbnail/sample-image-min.jpg');
        }
    }
    public function selectedSamapleCart($product_id, $cart_id, $color_id)
    {
        $checkCartProduct = SampleCart::where('color_id', $color_id)
            ->where('product_id', $product_id)
            ->where('external_id', $cart_id)
            ->first();

        if (empty($checkCartProduct->order->id) && $checkCartProduct) {
            return true;
        }
        return false;
    }

    public function isOptionSelected($productId, $OptionId)
    {

        if (DB::table('product_options')->where('product_id', $productId)->where('option_id', $OptionId)->where('is_active', true)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function GenerateId($tableName, $prefix): string
    {
        $num_of_ids = DB::table($tableName)->count();
        $i          = 0;
        $n          = 0;
        $l          = $prefix;
        $id         = '';
        while ($i <= $num_of_ids) {
            $id = $l . sprintf("%04d", $n);
            if ($n == 9999) {
                $n = 0;
                $l++;
            }
            $i++;
            $n++;
        }
        return $id;
    }

    public function CheckOptionActive($ProductId, $OptionId): bool
    {
        $check = DB::table('product_options')->where('product_id', $ProductId)->where('option_id', $OptionId)->first();
        if (!empty($check->is_active) && $check->is_active == true) {
            return true;
        } else {
            return false;
        }
    }
    public function productCountAsPerColor($categoryId, $color_id): int
    {
        $allProducts = [];
        $Groups      = ProductColor::where('color_group_id', $color_id)->get();
        foreach ($Groups as $group) {
            $product = $group->product;
            if (!in_array($product->id, $allProducts)) {
                $allActiveOptions = DB::table('product_options')->where('product_id', $product->id)->where('is_active', 1)->exists();
                if ($product->draft == false && !empty($product->category) && $categoryId === $product->category_id && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors)) {
                    $allProducts[] = $product->id;
                }
            }
        }
        return count($allProducts) ?? 0;
    }

    public function productCountAsPerColorForSub($color_id, $categoryId): int
    {
        $allProducts = [];
        $Groups      = ProductColor::where('color_group_id', $color_id)->get();
        foreach ($Groups as $group) {
            $product = $group->product;
            if (!in_array($product->id, $allProducts)) {
                $allActiveOptions = DB::table('product_options')->where('product_id', $product->id)->where('is_active', 1)->exists();
                if ($product->draft == false && $categoryId === $product->sub_category_id && !empty($product->category) && !empty($product->subCategory) && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors)) {
                    $allProducts[] = $product->id;
                }
            }
        }
        return count($allProducts) ?? 0;
    }
    public function productCountAsPerShop($color_id, $product_id): int
    {
        $allProducts = [];
        $Groups      = ProductColor::where('color_group_id', $color_id)->whereIn('product_id', $product_id)->get();
        foreach ($Groups as $group) {
            $product = $group->product;
            if (!in_array($product->id, $allProducts)) {
                $allActiveOptions = DB::table('product_options')->where('product_id', $product->id)->where('is_active', 1)->exists();
                if ($product->draft == false && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors)) {
                    $allProducts[] = $product->id;
                }
            }
        }
        return count($allProducts) ?? 0;
    }

    public function round_up($value, $precision)
    {
        $pow = pow(10, $precision);
        return (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
    }

    public function getProductPrice($id, $width, $height)
    {
        $product     = Product::find($id);
        $prices      = !empty($product->price) ? $product->price : [];
        $widthArray  = [];
        $heightArray = [];

        foreach ($prices as $price) {
            $widthArray[]  = (int) $price->width;
            $heightArray[] = (int) $price->height;
        }

        $arrayWidth  = array_unique($widthArray);
        $arrayHeight = array_unique($heightArray);

        $defaultWidth  = (int) $width < (!empty($arrayWidth) ? (int) min($arrayWidth) : 0) ? (int) min($arrayWidth) : (int) $width;
        $defaultHeight = (int) $height < (!empty($arrayHeight) ? (int) min($arrayHeight) : 0) ? (int) min($arrayHeight) : (int) $height;

        $productPrice = (float) DB::table('product_prices')
            ->where('product_id', $product->id)
            ->where('width', '>=', $defaultWidth)
            ->where('height', '>=', $defaultHeight)
            ->pluck('price')->first();
        return (float) trim($productPrice) ?? 0;
    }

    public function checkIsProductExist($categoryId, $CategoryType)
    {
        $status = false;
        if (!empty($categoryId) && $CategoryType === "category") {
            foreach (Product::where('category_id', $categoryId)->get() as $product) {
                $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', 1)->get();
                if ($product->draft == false && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors)) {
                    $status = true;
                }
            }
        } elseif (!empty($categoryId) && $CategoryType === "sub-category") {
            foreach (Product::where('sub_category_id', $categoryId)->get() as $product) {
                $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', 1)->get();
                if ($product->draft == false && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors)) {
                    $status = true;
                }
            }
        }
        return $status;
    }
    public function StoreSEO($request, $id, $for)
    {
        $checkSeo = Seo::where('for_id', $id)->where('for', $for)->first();

        if (!empty($request->file('og_image')) && empty($checkSeo->og_media_id)) {
            $og_image = $this->uploadImage($request->file('og_image'), "seo/{$for}");
        } else {
            $og_image = $checkSeo->og_media_id ?? null;
        }

        if (empty($checkSeo->id)) {
            $seo = Seo::create([
                'for'         => $for,
                'for_id'      => $id,
                'title'       => $request->input('seo_name'),
                'description' => $request->input('seo_description'),
                'og_media_id' => $og_image,
            ]);
        } else {
            $seo = Seo::where('for_id', $id)->where('for', $for)->update([
                'title'       => $request->input('seo_name'),
                'description' => $request->input('seo_description'),
                'og_media_id' => $og_image,
            ]);
        }
        return $seo ?? null;
    }
    public function seo($id, $for)
    {
        return Seo::where('for_id', $id)->where('for', $for)->first() ?? null;
    }

    public function saveCart($cartId, $userId, $reason = null)
    {

        if (!empty($cartId) && !empty($userId) && !empty($reason)) {
            $cart = Cart::where('external_id', $cartId)->update(['user_id' => $userId, 'cart_draft' => true, 'draft_reason' => $reason]);
            if (!empty($cart)) {
                return true;
            }
        }
        return false;
    }

    public function orderItemCount()
    {
        $auth_id    = Auth::id();
        return $orders     = Order::where('user_id', $auth_id)->count();
        // $orderCount = 0;
        // $data       = [];
        // foreach ($orders as $key => $value) {
        //     $data[] = $value->items_count;
        // }
        return $orderCount = array_sum($data ?? []);
    }
    public function cartItemCount()
    {
        $auth_id = Auth::id();
        return $carts    = Cart::where('user_id', $auth_id)->where('cart_draft', 1)->count();

        $cartQuantity = 0;
        foreach ($carts as $cart) {
            $cartQuantity += $cart->items->sum('quantity');
        }
        return $cartQuantity ?? 0;
    }
    public function hasCartItems($cartId): bool
    {
        $carts = Cart::find($cartId);
        return $carts->itemsCount() > 0;
    }

    public function estimatedShippingDate($dateNow = '')
    {
        if (empty($dateNow)) {
            $dateNow = date("Y-m-d");
        }
        $date = new \DateTime($dateNow);
        $date->modify('+10 weekday');
        return $date->format('M d, Y');
    }
    public function estimatedShippingDateForGoogle($dateNow = '')
    {
        if (empty($dateNow)) {
            $dateNow = date("Y-m-d");
        }
        $date = new \DateTime($dateNow);
        $date->modify('+10 weekday');
        return $date->format('Y-m-d');
    }
    public function getProductName($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        return $product->name ?? '';
    }
    public function getProductColorName($color_id)
    {
        $color = Color::where('color_id', $color_id)->first();
        return $color->name ?? '';
    }

    public function getYoutubeEmbedUrl($url)
    {
        $youtube_id    = null;
        $youUrl        = '';
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex  = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (!empty($youtube_id)) {
            $youUrl = 'https://www.youtube.com/embed/' . $youtube_id . "?controls=0";
        }

        return $youUrl;
    }

    public function checkExtension($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION) ?? "";
    }

    public function checkItemsDiscount($PromoName, $id)
    {
        $item = [];
        $item     = CartItem::find($id);
        if ($id) {
            if ($PromoName) {
                $promo = Promo::where('code', $PromoName)
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
                $subpromo = Subpromo::where('product_id', $item->product_id)->where('promo_id', $promo->id)->first();

                if ($subpromo) {
                    if ($subpromo->promo_type === "percentage") {
                        $discountAmount   = (float) $item->unit_price * ($subpromo->discount / 100);
                        $item->promo_type = "percentage";
                        $promo->amount = $subpromo->discount;
                    } elseif ($subpromo->promo_type === "flat") {
                        $discountAmount   = $subpromo->discount;
                        $item->promo_type = "flat";
                        $promo->amount = $subpromo->discount;
                    } else {
                        $discountAmount   = 0;
                        $item->promo_type = "";
                    }
                } else {
                    if (!empty($promo) && $promo->discount_type === "percentage") {
                        $discountAmount   = (float) $item->unit_price * ($promo->amount / 100);
                        $item->promo_type = "percentage";
                    } elseif (!empty($promo) && $promo->discount_type === "flat") {
                        $discountAmount   = $promo->amount;
                        $item->promo_type = "flat";
                    } else {
                        $discountAmount   = 0;
                        $item->promo_type = "";
                    }
                }
                $item->purchase_price = $item->unit_price - $discountAmount;
                $item->sub_total      = $item->unit_price - $discountAmount;
                $item->promo_discount = $promo->amount;
                $item->promo_price    = $discountAmount;
                $item->promo_name     = $promo->code ?? "";
                $item->save();
            }
        }
        return $item;
    }
    public function checkIsCouponActive($CouponName, $id)
    {
        $cart = Cart::findOrFail($id);
        $coupon = DB::table('coupons')
            ->where('code', $CouponName)
            ->where('with_promo', true)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('is_active', true)->orderByDesc('id')
            ->first();
        if (!empty($coupon) && !empty($cart)) {
            if ($coupon->type === "percentage") {
                $cart->cart_item_discount = (float)(($cart->cart_amount * $coupon->amount) / 100);
                $cart->coupon_type        = "percentage";
            } elseif ($coupon->type === "flat") {
                $cart->cart_item_discount = $coupon->amount;
                $cart->coupon_type        = "flat";
            }
            
            $cart->discount = $coupon->amount;
        } else {
            $cart->cart_item_discount = 0;
            $cart->coupon             = '';
            $cart->coupon_type        = '';
            $cart->discount           = 0;
        }
        $cart->save();
        return $cart;
    }
    // Coupon
    public function coupon($product_id, $defaultPrice)
    {
        $data = [];
        if (!empty($defaultPrice) && (is_float($defaultPrice) || is_integer($defaultPrice) || is_int($defaultPrice))) {
            $promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->orderByDesc('id')->first();
            if ($promo) {
                $subpromo = Subpromo::where('product_id', $product_id)->where('promo_id', $promo->id)->first();
                if ($subpromo) {
                    if ($subpromo->promo_type == 'percentage') {
                        $discountPrice = (float) ($defaultPrice * $subpromo->discount) / 100;
                        $data = [
                            'id' => $promo->id,
                            'name' => $promo->code,
                            "type" => "percentage",
                            "discount" => $subpromo->discount,
                            'extra_discount' => $subpromo->extra_discount ?? 0,
                            "total" => (float) $this->withoutRoundingforOther($discountPrice, 2),
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
                            "total" => (float) $this->withoutRoundingforOther($subpromo->discount, 2),
                        ];
                        return $data;
                    }
                }
                if (!empty($promo->amount) && $promo->discount_type === "percentage") {
                    $discount      = $promo->amount;
                    $discountPrice = (float) ($defaultPrice * $discount) / 100;
                    $data          = [
                        'id'       => $promo->id,
                        'name'     => $promo->name,
                        "type"     => "percentage",
                        "discount" => $discount,
                        'extra_discount' => $promo->extra_amount ?? 0,
                        "total"    => (float) $this->withoutRounding($discountPrice, 2),
                    ];
                } elseif (!empty($promo->amount) && $promo->discount_type === "fixed_amount") {
                    $discountPrice = $promo->amount;
                    $data          = [
                        'id'       => $promo->id,
                        'name'     => $promo->name,
                        "type"     => "fixed_amount",
                        "discount" => $discountPrice,
                        'extra_discount' => $promo->extra_amount ?? 0,
                        "total"    => (float) $this->withoutRounding($discountPrice, 2),
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

    public function generateCouponCode($length = 8): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $ret   = '';
        for ($i = 0; $i < $length; ++$i) {
            $random = str_shuffle($chars);
            $ret .= $random[0];
        }
        return $ret;
    }

    public function roundUp($value, $precision)
    {
        $pow = pow(10, $precision);
        return (float) $this->withoutRounding((($pow * $value) + (($pow * $value) - ($pow * $value))) / $pow, 2) ?? 0;
    }

    public function withoutRounding($number, $total_decimals)
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
    public function withoutRoundingforOther($number, $total_decimals)
    {
        // return number_format($number,$total_decimals);
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
    public function vendorColorName($color_id)
    {
        $product_color = ProductColor::find($color_id);
        return $product_color->color->vendor_color_name ?? '';
    }

    public function getSettings($key): string
    {
        return AdditionalSettings::where('key', $key)->pluck('value')->first() ?? "";
    }
}
