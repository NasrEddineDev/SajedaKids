<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Role;
use App\Models\Store;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([[
            'name'  => 'نصرالدين',
            'email' => 'n.guelfout@caci.dz',
            'password' => Hash::make('password'),
            'email_verified_at'  => date('Y-m-d H:i:s'),
            'role_id' => Role::where('name', 'admin')->first()->id,
            'store_id' => Store::where('name_lt', 'sajeda')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name'  => 'أحمد',
            'email' => 'ahmed.guelfout@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at'  => date('Y-m-d H:i:s'),
            'role_id' => Role::where('name', 'manager_company')->first()->id,
            'store_id' => Store::where('name_lt', 'sajeda')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name'  => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at'  => date('Y-m-d H:i:s'),
            'role_id' => Role::where('name', 'seller_company')->first()->id,
            'store_id' => Store::where('name_lt', 'sajeda')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ]]);
    }
}
