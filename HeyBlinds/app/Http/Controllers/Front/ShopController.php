<?php

namespace App\Http\Controllers\Front;

use Session;
use Carbon\Carbon;
use App\Models\Seo;
use App\Helpers\Helpers;
use App\Models\Admin\Filter;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\Admin\ColorGroup;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\ProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductOption;

class ShopController extends Controller
{

    /**
     * show the product
     * @param  String $slug
     * @return $mixed
     */
    public function show($slug)
    {
        $findFiltr = Filter::where('slug', $slug)->whereHas('haveProducFtilter')->firstOrFail();
        $SubCategory_footerContent = SubCategory::where('slug', $slug)->select('footer_content', 'id')->first();
        $findProductsId = ProductFilter::where('filter_id', $findFiltr->id)->pluck('product_id');

        $products = Product::whereIn('id', $findProductsId)
            ->where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('options')
            ->get();
        $allMinHeights = [];
        $allMaxHeights = [];
        $allMinWidths = [];
        $allMaxWidths = [];
        $colorGroups = [];
        $colorGroupsNew = [];

        foreach ($products as $product) {
            foreach ($product->options as $opt) {
                if ($opt->option->option_type === "height") {
                    $allMinHeights[] = $opt->min_width;
                    $allMaxHeights[] = $opt->max_width;
                }
                if ($opt->option->option_type === "width") {
                    $allMinWidths[] = $opt->min_width;
                    $allMaxWidths[] = $opt->max_width;
                }
            }
        }
        $minWidth =  min($allMinWidths) ?? 24;
        $maxWidth =  max($allMaxWidths) ?? 120;

        $minHeight = min($allMinHeights) ?? 36;
        $maxHeight = max($allMaxHeights) ?? 140;

        $productReviews = ProductReview::where('status', 1)->orderByDesc('created_at')->get();

        return view('frontend.shop', compact('findFiltr', 'findProductsId', 'products', 'colorGroups', 'minWidth', 'maxWidth', 'minHeight', 'maxHeight', 'SubCategory_footerContent'));
    }
    public function getProduct($products)
    {

        $allProducts = [];
        if (!empty($products)) {
            foreach ($products as $product) {
                $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', 1)->get();
                if ($product->draft == false && $product->is_live == true && !empty($product->price) && !empty($allActiveOptions) && !empty($product->display_media_id) && !empty($product->colors->toArray())) {
                    $allProducts[] = $product;
                }
            }
        }
        return $allProducts ?? [];
    }
    public function search(Request $request)
    {

        $slug = $request->input('slug');
        $extra = $request->input('extra');
        $filter_height = $request->input('filter_height');
        $filter_height_fraction = $request->input('filter_height_fraction');
        $filter_short = $request->input('filter_short');
        $filter_width = $request->input('filter_width');
        $width_fraction_val = $request->input('width_fraction_val');
        $filter_colors = $request->input('filter_color');

        $width = !empty($width_fraction_val) ? (int) $filter_width + 1 : $filter_width;
        $height = !empty($filter_height_fraction) ? (int) $filter_height + 1 : $filter_height;

        Session::put('session_width', $filter_width, 3600);
        Session::put('session_height', $filter_height, 3600);
        Session::put('session_width_fraction', $width_fraction_val, 3600);
        Session::put('session_height_fraction', $filter_height_fraction, 3600);

        $findFiltrId = Filter::where('slug', $slug)->whereHas('haveProducFtilter')->first();
        $findProductsId = ProductFilter::where('filter_id', $findFiltrId->id)->pluck('product_id');

        $products = Product::whereIn('id', $findProductsId)
            ->where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('options')
            ->whereHas('colors')
            ->get();

        $allProducts = [];
        $groups = [];


        $removeDuplicate = [];

        if (!empty($filter_colors)) {
            foreach ($filter_colors as $filter_color) {
                $groups = ProductColor::where('color_group_id', $filter_color)->get();
                if (!empty($groups)) {
                    foreach ($groups as $group) {
                        $product = $group->product;
                        if (!in_array($product->id, $removeDuplicate)) {
                            $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', 1)->get();
                            $getProductDetails = Product::find($product->id);

                            if ((!empty($group->colorGroup->is_enabled)
                                    && $group->colorGroup->is_enabled == true)
                                && (!empty($category)
                                    && $getCat->id === $product->category_id)
                                || (!empty($subCategory) && $getCat->id === $product->sub_category_id)
                            ) {
                                if (
                                    $product->draft == false && $product->is_live == true
                                    && !empty($product->price) && !empty($getProductDetails)
                                    && !empty($allActiveOptions) && !empty($product->display_media_id)
                                    && !empty($product->colors)
                                ) {

                                    $productPrice = $getProductDetails->getExtraDiscountProductPrice($getProductDetails->id, !empty($width) ? (int)$width : $product->default_width, !empty($height) ? (int)$height : $product->default_height);

                                    $allProducts[] = [
                                        'features' => json_decode($product->features),
                                        'is_new' => $product->is_new,
                                        'made_in_canada' => $product->made_in_canada,
                                        'is_on_sale' => $product->is_on_sale,
                                        'name' => $product->name,
                                        'slug' => $product->slug,
                                        'display_media_id' => $this->helpers->getImage($product->display_media_id),
                                        'price' => $this->helpers->withoutRounding($productPrice['productPrice'] ?? 0, 2),
                                        'discount' => $productPrice['discount'] ?? "",
                                        'purchasePrice' => $this->helpers->withoutRoundingforOther($productPrice['price'] ?? 0, 2) ?? "",
                                        'extra_discount' => $productPrice['extra_discount'] ?? 0,
                                        'width' => $filter_width ?? 24,
                                        'height' => $filter_height ?? 36,
                                        'width_fraction' => str_replace('/', '-', $width_fraction_val),
                                        'height_fraction' => str_replace('/', '-', $filter_height_fraction),
                                        'rating_avg'  => ((100 / 5) * $product->avgRatingOfProduct($product->id)),
                                        'avg_rating' => is_float($product->avgRatingOfProduct($product->id) ?? 0) == true ? number_format($product->avgRatingOfProduct($product->id), 1) : number_format($product->avgRatingOfProduct($product->id)),
                                        'review_count' => $product->review->count(),
                                    ];
                                    $removeDuplicate[] = $product->id;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($products as $product) {
                $allActiveOptions = ProductOption::where('product_id', $product->id)->where('is_active', 1)->get();
                $getProductDetails = Product::find($product->id);
                foreach ($allActiveOptions as $activeOption) {
                    if (!empty($activeOption->option->option_type) && $activeOption->option->option_type === "width") {
                        $getMinWidth = $activeOption->min_width;
                        $getMaxWidth = $activeOption->max_width;
                    } elseif (!empty($activeOption->option->option_type) && $activeOption->option->option_type === "height") {
                        $getMinHeight = $activeOption->min_width;
                        $getMaxHeight = $activeOption->max_width;
                    }
                }
                $getMinWidthFromPrice = DB::table('product_prices')->where('product_id', $product->id)->min('width');
                $getMaxWidthFromPrice = DB::table('product_prices')->where('product_id', $product->id)->max('width');
                $getMinHeightFromPrice = DB::table('product_prices')->where('product_id', $product->id)->min('height');
                $getMaxHeightFromPrice = DB::table('product_prices')->where('product_id', $product->id)->max('height');

                if (
                    $product->draft == false && $product->is_live == true
                    && !empty($product->price) && !empty($getProductDetails)
                    && !empty($allActiveOptions) && !empty($product->display_media_id)
                    && !empty($product->colors)
                    && (!empty($width) ? $width : $product->default_width) >= $getMinWidth ?? ($getMinWidthFromPrice ?? 0)
                    && (!empty($width) ? $width : $product->default_width) <= $getMaxWidth ?? ($getMaxWidthFromPrice ?? 0)
                    && (!empty($height) ? $height : $product->default_height) >= $getMinHeight ?? ($getMinHeightFromPrice ?? 0)
                    && (!empty($height) ? $height : $product->default_height) <= $getMaxHeight ?? ($getMaxHeightFromPrice ?? 0)
                ) {
                    $productPrice = $getProductDetails->getExtraDiscountProductPrice($getProductDetails->id, !empty($width) ? (int)$width : $product->default_width, !empty($height) ? (int)$height : $product->default_height);

                    $allProducts[] = [
                        'features' => json_decode($product->features),
                        'is_new' => $product->is_new,
                        'made_in_canada' => $product->made_in_canada,
                        'is_on_sale' => $product->is_on_sale,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'display_media_id' => $this->helpers->getImage($product->display_media_id),
                        'price' => $this->helpers->withoutRounding($productPrice['productPrice'] ?? 0, 2),
                        'discount' => $productPrice['discount'] ?? "",
                        'purchasePrice' => $this->helpers->withoutRoundingforOther($productPrice['price'] ?? 0, 2) ?? "",
                        'extra_discount' => $productPrice['extra_discount'] ?? 0,
                        'width' => $filter_width ?? 24,
                        'height' => $filter_height ?? 36,
                        'width_fraction' => str_replace('/', '-', $width_fraction_val),
                        'height_fraction' => str_replace('/', '-', $filter_height_fraction),
                        'rating_avg'  => ((100 / 5) * $product->avgRatingOfProduct($product->id)),
                        'avg_rating' => is_float($product->avgRatingOfProduct($product->id) ?? 0) == true ? number_format($product->avgRatingOfProduct($product->id), 1) : number_format($product->avgRatingOfProduct($product->id)),
                        'review_count' => $product->review->count(),
                    ];
                }
            }
        }
        if ($filter_short === "min_price") {
            usort($allProducts, function ($item1, $item2) {
                return $item1['price'] <=> $item2['price'];
            });
        } elseif ($filter_short === "max_price") {
            usort($allProducts, function ($item1, $item2) {
                return $item2['price'] <=> $item1['price'];
            });
        }

        return response()->json([
            'products' => $allProducts,
        ]);
    }

    public function coupon($defaultPrice)
    {
        $data = [];
        if (!empty($defaultPrice) && (is_float($defaultPrice) || is_integer($defaultPrice) || is_int($defaultPrice))) {
            $coupon = DB::table('coupons')
                ->where('pre_applied', true)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->where('is_active', true)->orderByDesc('id')
                ->first();

            if (!empty($coupon) && $coupon->type === "percentage") {
                $Discount = $coupon->amount;
                $discountPrice = (float)($defaultPrice * $Discount) / 100;
                $data = [
                    'id' => $coupon->id,
                    'name' => $coupon->code,
                    "type" => "percentage",
                    "discount" => $Discount,
                    "total" => (float)number_format($discountPrice, 2)
                ];
            } elseif (!empty($coupon) && $coupon->type === "flat") {
                $discountPrice = $coupon->amount;
                $data = [
                    'id' => $coupon->id,
                    'name' => $coupon->code,
                    "type" => "flat",
                    "discount" => $discountPrice,
                    "total" => (float)number_format($discountPrice, 2)
                ];
            }
        }
        return $data ?? null;
    }

}
