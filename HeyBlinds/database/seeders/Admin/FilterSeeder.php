<?php

namespace Database\Seeders\Admin;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('filters')->count() == 0) {
            DB::table('filters')->insert([
                [
                    'name' => 'Media Rooms',
                    'slug' => Str::slug('Media Rooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Bedrooms',
                    'slug' => Str::slug('Bedrooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Kitchen-Dining Rooms',
                    'slug' => Str::slug('Kitchen-Dining Rooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Nursery-Kids Rooms',
                    'slug' => Str::slug('Nursery Kids Rooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Bathrooms',
                    'slug' => Str::slug('Bathrooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Office',
                    'slug' => Str::slug('Office'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => 'Living Rooms',
                    'slug' => Str::slug('Living Rooms'),
                    'type' => 1,
                    'status' => 1,
                ],
                [
                    'name' => '2 Blinds On 1 Headrail',
                    'slug' => Str::slug('2 Blinds On 1 Headrail'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Blackout',
                    'slug' => Str::slug('Blackout'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Budget Blinds',
                    'slug' => Str::slug('Budget Blinds'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Cordless',
                    'slug' => Str::slug('Cordless'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Doors',
                    'slug' => Str::slug('Doors'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'French/Patio Doors',
                    'slug' => Str::slug('French Patio Doors'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Insulating / Energy Efficient',
                    'slug' => Str::slug('Insulating Energy Efficient'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Insulating / Energy Efficient',
                    'slug' => Str::slug('Insulating Energy Efficient'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Insulating / Energy Efficient',
                    'slug' => Str::slug('Insulating Energy Efficient'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Large Windows',
                    'slug' => Str::slug('Large Windows'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Top Down/Bottom Up',
                    'slug' => Str::slug('Top Down/Bottom Up'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Water-Resistant',
                    'slug' => Str::slug('Water-Resistant'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Light Filtering',
                    'slug' => Str::slug('Light Filtering'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Room Darkening',
                    'slug' => Str::slug('Room Darkening'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Blackout',
                    'slug' => Str::slug('Blackout'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Traditional Style',
                    'slug' => Str::slug('Traditional Style'),
                    'type' => 2,
                    'status' => 1,
                ],
                [
                    'name' => 'Contemporary Style',
                    'slug' => Str::slug('Contemporary Style'),
                    'type' => 2,
                    'status' => 1,
                ],
            ]);
        }
    }
}
