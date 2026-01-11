<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator'],
            ['name' => 'chef', 'description' => 'Koki'],
            ['name' => 'cashier', 'description' => 'Kasir'],
            ['name' => 'customer', 'description' => 'Pelanggan'],
        ];

        DB::table('roles')->insert($roles);
    }
}
