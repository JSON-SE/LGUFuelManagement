<?php

namespace Database\Seeders\Admin\Customer;;

use App\Models\Admin\Customer\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
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
             Customer::create([
                 'customer_type' => $faker->name,
                 'customer_first_name' => $faker->firstNameMale,
                 'customer_last_name' => $faker->lastName,
                 'customer_middle_name' => $faker->lastName,
                 'customer_registration_date' => $faker->dateTime($max = 'now', $timezone = null),
                 'customer_last_login' => $faker->dateTime($max = 'now', $timezone = null),
                 'customer_email' => $faker->email,
                 'customer_email_verified' => $faker->randomElement($array = array('1', '0')),
                 'customer_password' => $faker->password,
                 'is_delete' =>  $faker->randomElement($array = array('1', '0')),
                 'is_active' =>  $faker->randomElement($array = array('1', '0')),
                 'created_by' => $faker->name,
                 'updated_by' => $faker->name,
             ]);
         }
    }
}
