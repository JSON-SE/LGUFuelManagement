<?php

namespace App\Exports;

use App\Models\Admin\Color;
use App\Models\Admin\Order\SampleOrder;
use App\Models\Admin\Order\SampleOrderEntries;
use App\Models\Admin\Product\Product;
use App\Models\SampleCart;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SampleDrawersExport  implements FromView , WithColumnWidths ,WithStyles//, FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;


    public function __construct($orderId,$status, $startDate, $endDate,$textSearch)
    {
        $this->orderId = $orderId;
        $this->status = $status;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->textSearch = $textSearch;
    }

    public function view(): View
    {

        $orders = SampleOrderEntries::all();
        // $orders = [];
        if($orders){
            foreach($orders as $order){
                $product = Product::where("id",$order->product_id)->first();
                $color = Color::where('id',$order->color_id)->first();
                $order->color = $color;
                $order->product_name = $product->name ?? '';
            }
        }

        return view('exports.sample-orders-drawers', compact('orders'));

    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 35,
            'C' => 25,
            'D' => 15,
            'E' => 20,
            'F' => 25,
            'G' => 25,
            'H' => 15,
            'I' => 45,
            'J' => 45,
            'K' => 45,
            'L' => 45,
            'M' => 45,
            'N' => 45,
            'O' => 45,
            'P' => 45,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }



    public function collection()
    {
        //
    }
}
