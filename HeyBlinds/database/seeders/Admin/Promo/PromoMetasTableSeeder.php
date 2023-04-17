<?php

namespace Database\Seeders\Admin\Promo;

use Illuminate\Database\Seeder;
use App\Models\Admin\Promo\PromoMeta;


class PromoMetasTableSeeder extends Seeder
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
            PromoMeta::create([
                'promo_id' => $faker->unique()->numberBetween(1, \App\Models\Admin\Promo\Promo::count()),
                'meta_key' => $faker->name,
                'meta_value' => $faker->name,
            ]);
        } 
    }
}
