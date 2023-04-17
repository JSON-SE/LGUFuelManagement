<?php

namespace Database\Seeders\Admin\SampleOrder;

use Illuminate\Database\Seeder;
use App\Models\Admin\Order\SampleOrderEntries;


class SampleOrderEntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // \App\Models\Admin\Product\Product::factory(50)->create();
          $faker = \Faker\Factory::create();
          for ($i = 0; $i < 250; $i++) {
            SampleOrderEntries::create([
                  'sample_order_id' =>  \App\Models\Admin\Order\SampleOrder::all()->random()->id,
                  'name' => $faker->name,
                  'product_id' => $faker->numberBetween($min = 1, $max = 100),
                  'estimated_shipping_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
                  'room' =>  $faker->name,
                  'mount_type' =>  $faker->name,
                  'width' =>  $faker->numberBetween($min = 10, $max = 90),
                  'height' => $faker->numberBetween($min = 10, $max = 90),
                  'color_id' =>  $faker->numberBetween($min = 1, $max = 100),
                  'color_name' =>  $faker->name,
                  'lift' => $faker->numberBetween($min = 1000, $max = 9000),
                  'headrail' =>  $faker->name,
                  'valance' => $faker->randomElement($array = array('1', '0')),
                  'bottom_trim' => $faker->name,
                  'warranty' => $faker->name,
                  'quantity' => $faker->numberBetween($min = 1, $max = 5),
                  'note' => $faker->text,
                  'is_active' => $faker->randomElement($array = array('1', '0')),
                  'is_delete' => $faker->randomElement($array = array('1', '0')),
                  'created_by' => $faker->name,
                  'updated_by' => $faker->name,
              ]);
          }
    }
}
