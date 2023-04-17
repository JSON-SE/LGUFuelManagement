<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductFilter;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    /**
     * asiisgin the product on filter section
     * @param  Request $request
     * @return $mixed
     */
    public function assign(Request $request)
    {
        $data = $request->product_filter_value;
        ProductFilter::where('product_id', $request->product_id)->delete();
        try {
            foreach ($data as $data_id) {
                ProductFilter::updateOrCreate([
                    'product_id' => $request->product_id,
                    'filter_id'  => $data_id,
                    'status'     => 1,
                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => 'Updated successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }
}
