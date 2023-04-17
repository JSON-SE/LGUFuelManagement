<?php

namespace Database\Seeders\Front;

use Illuminate\Database\Seeder;
// use App\Models\Admin\Cart\Cart;
use App\Models\Front\Cart\Cart;



class CartTableSeeder extends Seeder
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
             Cart::create([
                 'external_id' => $faker->numberBetween($min = 10, $max = 50),
                //  'cart_status' => \App\Models\Admin\Order\OrderStatus::all()->random()->id,
                //  'cart_status' => $faker->randomElement($array = array('pending', 'declined', 'success', 'failed')),
                 'cart_amount' => $faker->numberBetween($min = 500, $max = 9000),
                 'cart_item_discount' => $faker->numberBetween($min = 10, $max = 90),
                //  'cart_tax' => $faker->numberBetween($min = 10, $max = 90),
                //  'cart_shipping' =>  $faker->numberBetween($min = 10, $max = 90),
                 'cart_total_price' =>  $faker->numberBetween($min = 10, $max = 90),
                 'coupon' => $faker->numberBetween($min = 10, $max = 90),
                 'discount' =>  $faker->numberBetween($min = 10, $max = 90),
                //  'grand_total_price' => $faker->numberBetween($min = 1000, $max = 9000),
                //  'cart_date' =>  $faker->dateTime($max = 'now', $timezone = null),
                //  'cart_shipped' =>$faker->randomElement($array = array('1', '0')),
                //  'cart_tracking_number' => $faker->name,
                 'is_delete' => $faker->randomElement($array = array('1', '0')),
                 'created_by' => $faker->name,
                 'updated_by' => $faker->name,
                //  'content' => $faker->text,
                 'customer_id' => $faker->numberBetween(1, \App\Models\Admin\Customer\Customer::count()),
             ]);
         }
    }
}
