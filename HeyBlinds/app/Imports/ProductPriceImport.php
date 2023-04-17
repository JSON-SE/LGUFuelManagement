<?php

namespace App\Imports;

use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductPrice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductPriceImport implements ToCollection
{
    private $product = null;

    public function  __construct(Product $product)
    {
        $this->product = $product;
    }

    public function collection(Collection $rows)
    {
        $id = $this->product->id;

        $new = [];
        $allRows = $rows->toArray();
        foreach ($allRows as $key => $row)
        {
            $arrayColumns[] = $allRows[0];
            $arrayRow[] = $row[0];

            $new[$row[0]] = [
                'width' => $allRows[0],
                'price' => $allRows[$key]
            ];
        }
        try {
           $prices =  ProductPrice::where('product_id', $id)->get();
//           $allPriceId = [];
            foreach ($prices as $price){
//                $allPriceId[] = $price->id;
                ProductPrice::find($price->id)->delete();
            }
        }catch (\Exception $e){
            return $e;
        }

        foreach ($new as $key => $n){
            if (!empty((int)$key)){
                array_shift($n['width']);
                array_shift($n['price']);
                foreach ($n['width'] as $keyWidth => $width){
                    $data[] = ProductPrice::create([
                            'product_id' => $id,
                            'width' => $width,
                            'height' => $key,
                            'price' => (float) trim($n['price'][$keyWidth]),
                        ]);
                }
            }
        }
    }
}
