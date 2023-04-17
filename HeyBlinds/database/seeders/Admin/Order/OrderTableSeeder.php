<?php

namespace Database\Seeders\Admin\Order;

use App\Models\Admin\Order\Order;
use App\Models\Admin\Order\OrderStatus;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
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
          for ($i = 0; $i < 100; $i++) {
              Order::create([
                  'order_id' => "HB".sprintf("%08d", $faker->numberBetween(1, 10000)),
                  'cart_id' => \App\Models\Front\Cart\Cart::all()->random()->id,
                  'order_status' =>\App\Models\Admin\Order\OrderStatus::all()->random()->id,
                  'order_amount' => $faker->numberBetween($min = 500, $max = 9000),
                  'order_item_discount' => $faker->numberBetween($min = 10, $max = 90),
                  'order_tax' => $faker->numberBetween($min = 10, $max = 90),
                  'order_shipping' =>  $faker->numberBetween($min = 10, $max = 90),
                  'order_total_price' =>  $faker->numberBetween($min = 10, $max = 90),
                  'promo' => $faker->numberBetween($min = 10, $max = 90),
                  'discount' =>  $faker->numberBetween($min = 10, $max = 90),
                  'grand_total_price' => $faker->numberBetween($min = 1000, $max = 9000),
                  'order_date' =>  $faker->dateTime($max = 'now', $timezone = null),
                  'order_shipped' =>$faker->randomElement($array = array('1', '0')),
                  'order_tracking_number' => $faker->name,
                  'is_delete' => $faker->randomElement($array = array('1', '0')),
                  'created_by' => $faker->name,
                  'updated_by' => $faker->name,
                  'content' => $faker->text,
                  'customer_id' => $faker->numberBetween(1, \App\Models\Admin\Customer\Customer::count()),
              ]);
          }
    }
}
