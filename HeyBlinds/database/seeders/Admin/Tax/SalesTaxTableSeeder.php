<?php

namespace Database\Seeders\Admin\Tax;

use Illuminate\Database\Seeder;
use App\Models\Admin\Tax\SalesTax;


class SalesTaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            SalesTax::create([
                'province' => 'Alberta',
                'province_code' => 'AB',
                'type' => 'gst',
                'pst' => '',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "5",
                'notes' => "",
            ]);


            SalesTax::create([
                'province' => 'British Columbia',
                'province_code' => 'BC',
                'type' => 'gst + pst',
                'pst' => '7',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "12",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Manitoba',
                'province_code' => 'MB',
                'type' => 'gst + pst',
                'pst' => '7',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "12",
                'notes' => "As of July 1, 2019 the pst rate was reduced from 8% to 7%.",
            ]);

            SalesTax::create([
                'province' => 'New Brunswick',
                'province_code' => 'NB',
                'type' => 'hst',
                'pst' => '',
                'gst' => "",
                'hst' => "15",
                'total_tax_rate' => "15",
                'notes' => "As of July 1, 2016 the hst rate increased from 13% to 15%.",
            ]);

            SalesTax::create([
                'province' => 'Newfoundland and Labrador',
                'province_code' => 'NL',
                'type' => 'hst',
                'pst' => '',
                'gst' => "",
                'hst' => "15",
                'total_tax_rate' => "15",
                'notes' => "As of July 1, 2016 the hst rate increased from 13% to 15%.",
            ]);

            SalesTax::create([
                'province' => 'Northwest Territories',
                'province_code' => 'NT',
                'type' => 'gst',
                'pst' => '',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "5",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Nova Scotia',
                'province_code' => 'NS',
                'type' => 'hst',
                'pst' => '',
                'gst' => "",
                'hst' => "15",
                'total_tax_rate' => "15",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Nunavut',
                'province_code' => 'NU',
                'type' => 'gst',
                'pst' => '',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "5",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Ontario',
                'province_code' => 'ON',
                'type' => 'hst',
                'pst' => '',
                'gst' => "",
                'hst' => "13",
                'total_tax_rate' => "13",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Prince Edward Island',
                'province_code' => 'PE',
                'type' => 'hst',
                'pst' => '',
                'gst' => "",
                'hst' => "15",
                'total_tax_rate' => "15",
                'notes' => "",
            ]);


            SalesTax::create([
                'province' => 'Quebec',
                'province_code' => 'QC',
                'type' => 'gst + *QST',
                'pst' => '9.975',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "14.975",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Saskatchewan',
                'province_code' => 'SK',
                'type' => 'gst + pst',
                'pst' => '6',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "11",
                'notes' => "",
            ]);

            SalesTax::create([
                'province' => 'Yukon',
                'province_code' => 'YT',
                'type' => 'gst',
                'pst' => '',
                'gst' => "5",
                'hst' => "",
                'total_tax_rate' => "5",
                'notes' => "",
            ]);

    }

}
