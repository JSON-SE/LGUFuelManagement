<?php

namespace App\Http\Controllers\Front;

use App\Models\SampleCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\ProductColor;
use App\Models\Admin\Product\ProductOption;

class SampleController extends Controller
{
    public function index()
    {
        $colorGroups = [];
        $getCookieCartId = $id = $this->getCookies();
        $sampleCartProducts = SampleCart::where('external_id', $getCookieCartId)->groupBy('product_id')->get() ?? [];

        $allSampleCarts = SampleCart::where('external_id', $getCookieCartId)->get() ?? [];

        $CheckOrder = DB::table('sample_orders')->where('sample_cart_external_id', $getCookieCartId)->first();
        if (!empty($CheckOrder->sample_order_id)) {
            return redirect()->route('frontend.sample.thank.you', $CheckOrder->sample_order_id);
        }
        $sub_Categories  = SubCategory::whereHas('product', function ($query) {
            $query->where('is_live', 1)
                ->where('draft', 0)
                ->where('display_media_id', '!=', NULL)
                ->whereHas('price')
                ->whereHas('options');
        })->get();

        return view('frontend.sample', compact('sub_Categories', 'sampleCartProducts', 'colorGroups', 'id', 'allSampleCarts'));
    }
    public function show(Request $request)
    {

        $subCategory = SubCategory::with('product')->where('id', $request->id)->first();
        $products = [];
        if (!empty($subCategory->product)) {
            $products = $this->getProduct($subCategory->id);
        }

        $colorDetails = [];
        foreach ($products as $product) {
            $getCookieCartId = $this->getCookies();
            $allSamples = $this->getSamples($getCookieCartId, $request, $product->id);
            $colorDetails[$product->id] = [
                'productName' => $product->name ?? "",
                'productId' => $product->id ?? "",
                'productSlug' => $product->slug ?? "",
            ];
            foreach ($product->colors as $color) {
                $colorDetails[$product->id]['color'][] = [
                    'id' => $color->color->id ?? "",
                    'colorName' => $color->color->name ?? "",
                    'colorImage' => $this->helpers->getThumbnail($color->color->color_image_id) ?? "",
                    'colorFeatureImage' => $this->helpers->getImage($color->color->feature_image_id) ?? "",
                    'selected' => in_array($color->color->id, $allSamples) ? "checked" : "",
                    'samples' => $allSamples,
                    'out_of_stock' => $color->color->out_of_stock == 1 ? 'disabled' : '' ,
                    'active_of_stock' => $color->color->out_of_stock,
                ];
            }
        }

        return response()->json($colorDetails);
    }

    public function getProduct($subcategory_id)
    {
        $products = Product::where('is_live', 1)
            ->where('draft', 0)
            ->where('display_media_id', '!=', null)
            ->whereHas('price')
            ->whereHas('colors')
            ->whereHas('options');
        if (!empty($subcategory_id)) {
            $products->where('sub_category_id', $subcategory_id);
        }
        return $products->get();
    }

    private function getCookies()
    {
        return $_COOKIE['__sb_sample_cart'] ?? '';
    }

    private function getSamples($getCookieCartId, $request, $productId)
    {
        $allSamples = [];
        if (!empty($getCookieCartId) && $request->input('cart_id') != "null" && $request->input('cart_id') != "" && $request->input('cart_id') != "0" && $request->input('cart_id') != null && $request->input('cart_id') != "undefined") {
            $allSamples = SampleCart::where('product_id', $productId)->where('external_id', $getCookieCartId)->pluck('color_id')->toArray();
        }

        return $allSamples ?? null;
    }
}
