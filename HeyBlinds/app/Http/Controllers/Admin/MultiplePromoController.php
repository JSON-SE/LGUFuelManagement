<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Category\SubCategory;

class MultiplePromoController extends Controller
{
    public function findProduct(Request $request)
    {
        $products = Product::whereIn('sub_category_id', $request->subcategory_id)
          ->where('is_live', 1)
          ->where('draft', 0)
          ->where('display_media_id', '!=', null)
          ->whereHas('price')
          ->whereHas('options')
          ->get();
        return response()->json([
            'products' => $products
        ]);
    }
}
