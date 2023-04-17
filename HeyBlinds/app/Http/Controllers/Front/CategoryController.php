<?php

namespace App\Http\Controllers\Front;


use Session;
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

class CategoryController extends Controller
{
    /**
     * all product page display
     *
     * @param $slug, $subcategory_slug
     *
     * @return Mix
     */
    public function view($slug, $subcategory_slug = '')
    {
        $isSubCategory = false;
        $products = [];
        $subCategory = [];

        if (!empty($subcategory_slug)) {
            $subCategory = SubCategory::with('product')->where('slug', $subcategory_slug)->firstOrFail();
            $category = Category::with('product')->where('slug', $slug)->firstOrFail();
            if (!empty($subCategory->product)) {
                $products = $this->getProduct(null, $subCategory->id);
            }
            $isSubCategory = true;
        } else {
            $category = Category::with('product')->where('slug', $slug)->firstOrFail();
            if (!empty($category->product)) {
                $products = $this->getProduct($category->id, null);
            }
        }
        $allMinHeights = [];
        $allMaxHeights = [];
        $allMinWidths = [];
        $allMaxWidths = [];
        $colorGroups = [];
        $colorGroupsNew = [];

        foreach ($products as $product) {
            $min_width = (int)$product->price->min('width');
            $max_width =  (int)$product->price->max('width');

            $min_height = (int)$product->price->min('height');
            $max_height = (int)$product->price->max('height');

            foreach ($product->options as $opt) {
                if ($opt->option->option_type == "height") {
                    $allMinHeights[] = $opt->min_width ?? $min_height;
                    $allMaxHeights[] = $opt->max_width ?? $max_height;
                }
                if ($opt->option->option_type == "width") {
                    $allMinWidths[] = $opt->min_width ?? $min_width ;
                    $allMaxWidths[] = $opt->max_width ?? $max_width;
                }
            }
        }
      

        $minWidth = min(array_diff($allMinWidths ?? 0, [0])) ?? $min_width;
        $maxWidth = max(array_diff($allMaxWidths ?? 0, [0])) ?? $max_width;

        $minHeight =  min(array_diff($allMinHeights ?? 0, [0])) ?? $min_height;
        $maxHeight =  max(array_diff($allMaxHeights ?? 0, [0])) ?? $max_height;

        $productReviews = ProductReview::where('status', 1)->orderByDesc('created_at')->get();
        return view('frontend.category', compact('isSubCategory', 'category', 'products', 'subCategory', 'colorGroups', 'minWidth', 'maxWidth', 'minHeight', 'maxHeight', 'productReviews'));
    }

    public function getProduct($category_id = null, $subcategory_id = null)
    {
        $products = Product::where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('colors')
            ->whereHas('options')
            ->with('options')
            ->orderBy('order_by', 'asc');
        if (!empty($subcategory_id)) {
            $products->where('sub_category_id', $subcategory_id);
        } else {
            $products->where('category_id', $category_id);
        }

        return $products->get();
    }

    public function search(Request $request)
    {
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

        if (!empty($category)) {
            $getCat = Category::with('product')->first();
        } elseif (!empty($subCategory)) {
            $getCat = SubCategory::with('product')->findOrFail($subCategory);
        }
        $removeDuplicate = [];
    
        $products = Product::with('price','options')->where('sub_category_id', $getCat->id)->where('is_live', 1)
        ->where('draft', 0)
        ->where('display_media_id', '!=', null)
        ->whereHas('price')
        ->whereHas('colors')
        ->whereHas('options')->get();
        $filter_product_id = [];
        $filter_product_width=[];
        $filter_product_height=[];
        foreach($products as $product){

            $option_max_width =  $product['options'][0]['max_width'] ?? null;
            $option_min_width =  $product['options'][0]['min_width'] ?? null;
            $option_max_height =  $product['options'][1]['max_width'] ?? null;
            $option_min_height =  $product['options'][1]['min_width'] ?? null;

            if(isset( $option_max_width) && $option_min_height !=null && isset( $option_min_width) && $option_min_width !=null && isset( $option_max_height) && isset( $option_min_height)){
                if($option_min_height <= (int)$width && $option_max_height >= (int)$width && $option_min_width <= (int)$height && $option_max_width >= (int)$height){
                    $filter_product_id[] = $product->id;
                }else{

                }
            }
            else{
                    foreach ($product['price'] as $key => $value) {
                        $filter_product_width[$key] = $value['width'];
                        $filter_product_height[$key] = $value['height'];
                    }
                    $min_width = min($filter_product_width);
                    $max_width = max($filter_product_width);
                    $min_height = min($filter_product_height);
                    $max_height = max($filter_product_height);
                    if($min_width <= (int)$width && $max_width >= (int)$width && $min_height <= (int)$height && $max_height >= (int)$height){
                        $filter_product_id[] = $product['price'][0]['product_id'];
                    }
                  
                    else{
                    }
            }
            
        }  
        $final_filter_product_id = array_unique($filter_product_id);

        
        $product_id = [];
       
        $searchProduct =  Product::whereIn('id',$final_filter_product_id)->where('is_live', 1)
        ->where('draft', 0)
        ->where('display_media_id', '!=', null)
        ->whereHas('price')
        ->whereHas('colors')
        ->whereHas('options')->get();
      
        if ($searchProduct) {
            foreach ($searchProduct as $product) {
                    $productPrice = $product->getExtraDiscountProductPrice($product->id, !empty($width) ? (int)$width : $product->default_width, !empty($height) ? (int)$height : $product->default_height);

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
