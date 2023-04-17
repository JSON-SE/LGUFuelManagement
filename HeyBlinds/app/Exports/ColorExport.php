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

class ColorExport  implements FromView , WithColumnWidths ,WithStyles//, FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    
    


    public function __construct()
    {
        
    }

    public function view(): View
    {
        $colors = Color::orderByDesc('created_at')->get();
        return view('exports.color', compact('colors'));
    }

    public function columnWidths(): array
    {
        return [
            'A' => 35,
            'B' => 15,
            'C' => 25,
            'D' => 15,
            'E' => 20,
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
