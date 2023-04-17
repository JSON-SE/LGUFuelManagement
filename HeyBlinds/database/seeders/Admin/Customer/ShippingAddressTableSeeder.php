<?php

namespace Database\Seeders\Admin\Customer;

use Illuminate\Database\Seeder;
use App\Models\Admin\Customer\ShippingAddress;


class ShippingAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            ShippingAddress::create([
                'cart_id' =>  \App\Models\Front\Cart\Cart::all()->random()->id,
                'first_name' => $faker->firstNameMale,
                'last_name' => $faker->lastName,
                'email' =>  $faker->email,
                'area_code' =>  $faker->areaCode,
                'phone_number' => $faker->phoneNumber,
                'street' =>  $faker->streetName,
                'city' => $faker->city,
                'province' =>  $faker->areaCode,
                'postal_code' =>$faker->postcode,
                'is_active' => $faker->randomElement($array = array('1', '0')),
                'is_delete' => $faker->randomElement($array = array('1', '0')),
                'created_by' => $faker->name,
                'updated_by' => $faker->name,
                'user_id' => \App\Models\User::all()->random()->id,
            ]);
        }
    }
}
