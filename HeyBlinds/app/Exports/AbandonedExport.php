<?php

namespace App\Exports;


use App\Models\AbandonedCustomer;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AbandonedExport  implements FromQuery,WithHeadings,WithMapping,WithStyles,WithColumnWidths
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */  
    // use Exportable;
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
            'Email',
            'First Name',
            'Last Name',
            'tel. #',
            '$customer_action',
            'Action Date',
            'Cart Link',
            'Cart #',
            'Cart Subtotal',
            'Province',
            'Postal Code'
        ];
    }
    public function query()
    {
        return $users = AbandonedCustomer::with(['cart' => function($query) {
                    $query->groupBy('cart_id')->doesntHave('order');
            },'sampleCart'])->whereBetween('created_at',[$this->fromDate. ' 00:00:00', $this->toDate.' 23:59:59'])
        ->groupBy('cart_id');
        
        /*you can use condition in query to get required result
         return Bulk::query()->whereRaw('id > 5');*/
    }
    public function map($user): array
    {
        return [
            $user->shipping_email ?? '',
            $user->shipping_first_name ?? " ",
            $user->shipping_last_name ?? " ",
            $user->shipping_phone_number ?? " ",
            $this->userCartType($user),
            $user->created_at->format('d/M/Y H:m') ?? " ",
            $this->makeroute($user),
            $user->cart->cart_id ?? '',
            number_format($user->cart->cart_amount ?? '0.00', 2),
           $user->shipping_province ?? ' ',
           $user->shipping_postal_code,
        ];
    }
    public function userCartType($user){
        if($user){
            if($user->cart_type == 0){
                return 'Saved Cart';
            }
            elseif ($user->cart_type == 1) {
                return 'Saved Cart';
            }
            return 'Sample Ordered'; 
        }
    }
  
    private function makeroute($data){
        if($data){
            if($data->cart){
                return route("frontend.checkout", $data->cart->external_id ?? '');
            }
        }
        return NULL;
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
            'H' => 125,
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
