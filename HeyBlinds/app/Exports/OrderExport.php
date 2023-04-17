<?php

namespace App\Exports;
use App\Helpers\Helpers;
use App\Models\Admin\Order\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class OrderExport implements  FromQuery,WithHeadings,WithMapping,WithStyles,WithColumnWidths
{
    use Exportable;
    
    public $status_search;
    public $day_range;
    public $fromDate;
    public $toDate;
    public Helpers $helpers;

    public function __construct($status_search,$day_range, $fromDate,$toDate)
    {
        $this->status_search = $status_search;
        $this->day_range = $day_range;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->helpers = new Helpers();
    }
    public function headings(): array
    {
        return [
            'Email',
            'First Name',
            'Last Name',
            'tel. #',
            '$customer_action',
            'Action Date',
            'Cart Link',
            'Order ID #',
            'Cart Subtotal',
            'Province',
            'Postal Code'
        ];
    }
    public function query()
    {
        $orders = Order::query();
        if(!empty($this->status_search)){
            $orders->where('order_status',$this->status_search);
        }
        if(!empty($this->day_range)){
            $orders->where('created_at','>=',$this->day_range);
        }
        if(!empty($this->fromDate) && !empty($this->toDate)){
            $orders->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59']);
        }
        return $orders->orderByDesc('created_at');
    }

    public function map($order): array
    {
        return [
            $order->shippingAddress->email ?? '' ,
            $order->shippingAddress->first_name ?? '',
            $order->shippingAddress->last_name ?? '',
            $order->shippingAddress->phone_number ?? '',
            'Ordered',
            $order->created_at->format('d/M/Y H:m') ?? " ",
            $this->makeroute($order),
            $order->order_id,
            $this->helpers->grand_total_amount($order->cart->id ?? ''),
            $order->shippingAddress->province ?? '',
            $order->shippingAddress->postal_code ?? '',
        ];
    }
    private function makeroute($order){
        return route("frontend.thank.you", $order->cart->external_id ?? '');
    }


    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 35,
            'C' => 35,
            'D' => 15,
            'E' => 15,
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
