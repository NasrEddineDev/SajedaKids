<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([[
            'name' => 'admin',
        ],[
            'name' => 'manager_company',
        ],[
            'name' => 'admin_company',
        ],[
            'name' => 'seller_company',
        ],[
            'name' => 'user',
        ]]);
    }
}
