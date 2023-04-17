<?php

namespace App\Exports;

use App\Models\AbandonedCustomer;
use App\Models\Admin\Order\Order;
use App\Models\Admin\Order\SampleOrder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;

class ActionExport implements FromView , WithColumnWidths ,WithStyles//, FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */  
    // use Exportable;
    public $fromDate;
    public $toDate;

    public function __construct($fromDate,$toDate){
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }
   
    public function view(): View
    {
        // $abandonedCustomers = AbandonedCustomer::whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59'])->get();
        $abandonedCustomers = AbandonedCustomer::orderByDesc('created_at');
        $orders = Order::orderByDesc('created_at');
        $sample_orders = SampleOrder::orderByDesc('created_at');

        if(!empty($this->fromDate) && !empty($this->toDate)){
            $abandonedCustomers = $abandonedCustomers->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59']);
            $orders = $orders->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59']);
            $sample_orders =  $sample_orders->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59']);
        }
        $abandonedCustomers = $abandonedCustomers->get();
        $orders = $orders->get();
        
        $sample_orders =  $sample_orders->get();
        return view('exports.actions', compact('abandonedCustomers','orders','sample_orders'));
    }
     public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 35,
            'C' => 35,
            'D' => 15,
            'E' => 25,
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
            1    => ['font' => ['bold' => true]],
        ];
    }
}
