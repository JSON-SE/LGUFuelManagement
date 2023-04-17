<?php

namespace App\Exports;


use App\Models\Subcriber;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class SubcriberExport implements  FromQuery,WithHeadings,WithMapping,WithStyles,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function headings(): array
    {
        return [
            'Email',
            'Created_at',
        ];
    }
    public function query()
    {
       return Subcriber::query()->orderBy('updated_at', 'desc');
        /*you can use condition in query to get required result
         return Bulk::query()->whereRaw('id > 5');*/
    }
    public function map($subcriber): array
    {
        return [
            $subcriber->email ?? ' ',
            $subcriber->created_at->format('d/M/Y'),
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 35,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
