<?php

namespace App\Exports;

use App\Models\Admin\Order\SampleOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Admin\Customer\ShippingAddress;


class SampleOrderExport implements FromView , WithColumnWidths ,WithStyles//, FromQuery
{
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
        $orders = SampleOrder::orderByDesc('created_at');
        if(!empty($this->status_search)){
            $orders->where('order_status',$this->status_search);
        }
        if(!empty($this->day_range)){
            $orders->where('created_at','>=',$this->day_range);
        }
        if(!empty($this->fromDate) && !empty($this->toDate)){
            $orders->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59']);
        }
    
        $orders = $orders->get();
         return view('exports.sample-all-orders', compact('orders'));
    }
   
    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 35,
            'C' => 35,
            'D' => 15,
            'E' => 35,
            'F' => 25,
            'G' => 70,
            'H' => 25,
            'I' => 15,
            'J' => 25,
            'K' => 15,
            'L' => 25,
            'M' => 15,
            'N' => 15,
            'O' => 45,
            'P' => 45,
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
