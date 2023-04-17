<?php

namespace Database\Seeders\Admin\Order;

use Illuminate\Database\Seeder;
use App\Models\Admin\Order\Note;


class NoteTableSeeder extends Seeder
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
             Note::create([
                 'order_id' =>  $faker->numberBetween($min = 1, $max = 20),
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
