<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Admin::create([
        //     'name' => 'Monodeep',
        //     'email' => 'monodeep@klizos.com',
        //     'password' => bcrypt('11111111'),
        //     'is_active' => true
        // ]);

        Admin::create([
            'name' => 'Jayson',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'is_active' => true
        ]);


        // User::create([
        //     'name' => 'Monodeep',
        //     'email' => 'monodeep@klizos.com',
        //     'password' => bcrypt('11111111'),
        //     'isAdmin' => true
        // ]);

        // User::create([
        //     'name' => 'Venkata',
        //     'email' => 'venkata@klizos.com',
        //     'password' => 'klizos@00',
        //     'isAdmin' => true
        // ]);

    }
}
