<?php

namespace Database\Seeders\Admin\SampleOrder;

use Illuminate\Database\Seeder;
use App\Models\Admin\Order\SampleOrderNote;


class SampleOrderNoteTableSeeder extends Seeder
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
         for ($i = 0; $i < 150; $i++) {
            SampleOrderNote::create([
                 'sample_order_id' =>  \App\Models\Admin\Order\SampleOrder::all()->random()->id,
                 'receiver' => $faker->randomElement($array = array('customer', 'vendor')),
                 'note' => $faker->text,
                 'is_active' => $faker->randomElement($array = array('1', '0')),
                 'is_delete' => $faker->randomElement($array = array('1', '0')),
                 'created_by' => $faker->name,
                 'updated_by' => $faker->name,
             ]);
         }
    }
}
