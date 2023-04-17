<?php

namespace Database\Seeders\Front;

use Illuminate\Database\Seeder;
use App\Models\Front\Cart\CartItem;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 250; $i++) {
            CartItem::create([
                'external_id' =>  $faker->numberBetween($min = 10, $max = 50),//\App\Models\Front\Cart::all()->random()->id,
                'product_id' =>  $faker->numberBetween($min = 10, $max = 90),//\App\Models\Front\Cart::all()->random()->id,
                'name' => $faker->name,
                'estimated_shipping_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
                'room' =>  $faker->name,
                'mount_type' =>  $faker->name,
                'width' =>  $faker->numberBetween($min = 10, $max = 90),
                'height' => $faker->numberBetween($min = 10, $max = 90),
                'color' =>  $faker->numberBetween($min = 10, $max = 90),
                'lift' => $faker->numberBetween($min = 1000, $max = 9000),
                'headrail' =>  $faker->name,
                'valance' => $faker->randomElement($array = array('1', '0')),
                'bottom_trim' => $faker->name,
                'sub_total' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
                'save' => $faker->numberBetween($min = 10, $max = 20),
                'extra' => $faker->numberBetween($min = 10, $max = 20),
                'warranty' => $faker->name,
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
                'unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 1000),
                'quantity' => $faker->numberBetween($min = 10, $max = 90),
                'note' => $faker->text,
                'is_active' => $faker->randomElement($array = array('1', '0')),
                'is_delete' => $faker->randomElement($array = array('1', '0')),
                'created_by' => $faker->name,
                'updated_by' => $faker->name,
            ]);
        }
    }
}
