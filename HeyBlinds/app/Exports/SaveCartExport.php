<?php

namespace App\Exports;


use App\Models\Front\Cart\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class SaveCartExport  implements FromQuery,WithHeadings,WithMapping,WithStyles,WithColumnWidths
{
    use Exportable;
    public $fromDate;
    public $toDate;
    /**
    * @return \Illuminate\Support\Collection
    */  
    // use Exportable;
    public function __construct($fromDate,$toDate){
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }
    
    public function headings(): array
    {
        return [
            'Cart ID',
            'Customer Name',
            'Email',
            'Phone Number',
            'Purchase Amount',
            'Reason',
            'Created_at',
        ];
    }
    public function query()
    {
        return Cart::query()->doesntHave('order')->with('user')->where('cart_id','!=','')->where('cart_draft', true)
         ->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59'])
        ->orderBy('updated_at', 'desc');
        /*you can use condition in query to get required result
         return Bulk::query()->whereRaw('id > 5');*/
    }
    public function map($cart): array
    {
        return [
            $cart->cart_id ?? ' ', 
            $cart->user->full_name ?? ' ',
            $cart->user->email ?? ' ',
            $cart->user->profile->phone_number ?? ' ',
            number_format($cart->cart_amount,2),
            $cart->draft_reason ??  ' ' ,
            $cart->created_at->format('d/M/Y'),
        ];
    }
     public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 35,
            'C' => 35,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 25,
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
