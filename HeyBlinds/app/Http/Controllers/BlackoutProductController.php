<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\Admin\ColorGroup;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductPrice;
use App\Models\Admin\Product\ProductOption;
use Cookie;
use Session;


class BlackoutProductController extends Controller
{
    /**
     * all product blackout page display
     *
     * @param $slug, $subcategory_slug
     *
     * @return Mix
     */
    public function index()
    {
        $isSubCategory = false;
        $products = [];
        $subCategory = [];
        $category = [];

        $products = Product::where('name', 'LIKE', '%'.'blackout'.'%')
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
            foreach ($product->colors as $color) {
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
                
                $colorGroupsNew[] = $color->color->group->id;
            }
        }
   
        $minWidth =  !empty($allMinWidths) ? min($allMinWidths) : 0;
        $maxWidth =  !empty($allMaxWidths) ? max($allMaxWidths) : 0;

        $minHeight = !empty($allMinHeights) ? min($allMinHeights) : 0;
        $maxHeight = !empty($allMaxHeights) ? max($allMaxHeights) : 0;



       
        $productReviews = ProductReview::where('status', 1)->orderByDesc('created_at')->get();
        return view('frontend.blackout-product', compact('isSubCategory', 'category', 'products', 'subCategory', 'colorGroups', 'minWidth', 'maxWidth', 'minHeight', 'maxHeight', 'productReviews'));
    }

    public function search(Request $request)
    {
        // return $request->all();
        $category = $request->input('category');
        $subCategory = $request->input('sub-category');
        $filter_height = $request->input('filter_height');
        $filter_height_fraction = $request->input('filter_height_fraction');
        $filter_short = $request->input('filter_short');
        $filter_width = $request->input('filter_width');
        $width_fraction_val = $request->input('width_fraction_val');
        $filter_colors = $request->input('filter_color');
        
        Session::put('session_width', $filter_width, 3600);
        Session::put('session_height', $filter_height, 3600);
        Session::put('session_width_fraction', $width_fraction_val, 3600);
        Session::put('session_height_fraction', $filter_height_fraction, 3600);
        
        $width = !empty($width_fraction_val) ? (int) $filter_width + 1 : $filter_width;
        $height = !empty($filter_height_fraction) ? (int) $filter_height + 1 : $filter_height;
      
    
        $allProducts = [];



        $products = Product::where('name', 'LIKE', '%'.'blackout'.'%')
        ->where('is_live', 1)
        ->where('draft', 0)
        ->where('display_media_id', '!=', null)
        ->whereHas('price')
        ->whereHas('options')
        ->get();


        if (!empty($products)) {
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
                    && !empty($product->price->toArray()) && !empty($getProductDetails)
                    && !empty($allActiveOptions->toArray()) && !empty($product->display_media_id)
                    && !empty($product->colors->toArray())
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
                        'price' => $this->helpers->withoutRoundingforOther($productPrice['productPrice'] ?? '0.00', 2),
                        'discount' => $productPrice['discount'] ?? "",
                        'purchasePrice' => $this->helpers->withoutRoundingforOther($productPrice['price'] ?? 0, 2) ?? "",
                        'extra_discount' => $productPrice['extra_discount'] ?? 0,
                        'width' => $filter_width,
                        'height' => $filter_height,
                        'width_fraction' => str_replace('/', '-', $width_fraction_val),
                        'height_fraction' => str_replace('/', '-', $filter_height_fraction),
                        'rating_avg'  => ((100 / 5) * $product->avgRatingOfProduct($product->id)),
                        'avg_rating' => is_float($product->avgRatingOfProduct($product->id) ?? 0) == true ? number_format($product->avgRatingOfProduct($product->id), 1) : number_format($product->avgRatingOfProduct($product->id)),
                        'review_count' => $product->review->count(),
                    ];
                }
            }
        }

        // return $allProducts;
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
}
