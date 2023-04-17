<?php

namespace Database\Seeders\Admin\Promo;

use App\Models\Admin\Promo\Promo;
use Illuminate\Database\Seeder;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        for ($i = 0; $i < 50; $i++) {
            Promo::create([
                'external_id' => $faker->name,
                'name' => $faker->name,
                'amount' => $faker->numberBetween($min = 1000, $max = 9000),
                'discount_type' => $faker->randomElement($array = array ('percentage','flat')),
                // 'discount_category' => $faker->randomElement($array = array ('site-wide','per-category','per-product')),
                'start_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'end_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
                'is_active' => $faker->randomElement($array = array('1', '0')),
                'is_delete' => $faker->randomElement($array = array('1', '0')),
                // 'promo_banner' => $faker->imageUrl($width = 640, $height = 480),
                'is_predefined' => $faker->randomElement($array = array('1', '0')),
                'created_by' => $faker->numberBetween($min = 1000, $max = 9000),
                'updated_by' => $faker->numberBetween($min = 1000, $max = 9000),
            ]);
        } //
    }
}