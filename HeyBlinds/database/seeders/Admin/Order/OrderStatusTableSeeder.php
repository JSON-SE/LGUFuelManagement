<?php

namespace Database\Seeders\Admin\Order;

use Illuminate\Database\Seeder;
use App\Models\Admin\Order\OrderStatus;


class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create([
            'name' => 'On Hold',
        ]);

        OrderStatus::create([
            'name' => 'Review',
        ]);

        OrderStatus::create([
            'name' => 'Export',
        ]);

        OrderStatus::create([
            'name' => 'Approved',
        ]);

        OrderStatus::create([
            'name' => 'In Progress',
        ]);

        OrderStatus::create([
            'name' => 'Packed',
        ]);

        OrderStatus::create([
            'name' => 'Shipped',
        ]);

        OrderStatus::create([
            'name' => 'Delivered',
        ]);

        OrderStatus::create([
            'name' => 'Cancelled',
        ]);

    }
}
