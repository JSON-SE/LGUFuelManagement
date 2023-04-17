<?php

namespace App\Exports;

use App\Models\Admin\Color;
use App\Models\Admin\Order\SampleOrder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Admin\Product\Product;
use App\Models\SampleCart;


use Maatwebsite\Excel\Concerns\FromCollection;

class SampleInventoryExport  implements FromView , WithColumnWidths ,WithStyles//, FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    
    public $status_search;
    public $day_range;
    public $fromDate;
    public $toDate;


    public function __construct($status_search,$day_range, $fromDate,$toDate)
    {
        $this->status_search = $status_search;
        $this->day_range = $day_range;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function view(): View
    {
        $colors = Color::all();
        return view('exports.sample-orders-inventory', compact('colors'));
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 15,
            'C' => 25,
            'D' => 30,
            'E' => 30,
            'F' => 15,
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
            1    => ['font' => ['bold' => true]],
        ];
    }


    public function collection()
    {
        //
    }
}
