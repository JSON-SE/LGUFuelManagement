<?php

namespace Database\Seeders\Admin\SampleOrder;

use Illuminate\Database\Seeder;
use App\Models\Admin\Order\SampleOrder;


class SampleOrderTableSeeder extends Seeder
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
          for ($i = 0; $i < 50; $i++) {
            SampleOrder::create([
                  'sample_order_id' => "HB".sprintf("%08d", $faker->numberBetween(1, 10000)),
                  'first_name' => $faker->firstNameMale,
                  'last_name' => $faker->lastName,
                  'email' => $faker->email,
                  'phone_number' => $faker->phoneNumber,
                  'area_code' =>   $faker->areaCode,
                  'order_status' =>\App\Models\Admin\Order\OrderStatus::all()->random()->id,
                  'street' =>  $faker->streetName,
                  'city' =>  $faker->city,
                  'province' => $faker->areaCode,
                  'delivery' => $faker->randomElement($array = array('courier', 'regular mail')),
                  'postal_code' => $faker->postcode,
                  'order_date' =>  $faker->dateTime($max = 'now', $timezone = null),
                  'order_shipped' =>$faker->randomElement($array = array('1', '0')),
                  'order_tracking_number' => $faker->name,
                  'is_delete' => $faker->randomElement($array = array('1', '0')),
                  'is_active' => $faker->randomElement($array = array('1', '0')),
                  'created_by' => $faker->name,
                  'updated_by' => $faker->name,
              ]);
          }
    }
}
