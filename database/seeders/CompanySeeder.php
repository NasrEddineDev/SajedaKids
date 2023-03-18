<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\City;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //        
        DB::table('companies')->insert([[
            'name_ar'  => 'admin',
            'name_lt' => 'admin',
            'legal_form' => 'SPA',
            'type' => 'admin',
            'balance' => 100,
            'logo' => 'admin',
            'address_ar' => 'admin',
            'address_lt' => 'admin',
            'email' => 'n_guelfout@esi.dz',
            'mobile' => '0676856785',
            'tel' => '0676856785',
            'fax' => '0676856785',
            'website' => 'www.nasreddine.dz',
            'city_id' => City::where('name_en', 'reghaia')->first()->id,
        ],[
            'name_ar'  => 'شركة أحمد',
            'name_lt' => 'ahmed company',
            'legal_form' => 'SPA',
            'type' => 'test',
            'balance' => 100,
            'logo' => 'test.png',
            'address_ar' => 'test @',
            'address_lt' => 'test @',
            'email' => 'ahmed.guelfout@gmail.com',
            'mobile' => '0676856785',
            'tel' => '0676856785',
            'fax' => '0676856785',
            'website' => 'www.nasreddine.dz',
            'city_id' => City::where('name_ar', 'تيارت')->first()->id,
        ]]);
    }
}
