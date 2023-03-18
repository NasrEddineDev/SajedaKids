<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\Company;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('stores')->insert([[
            'name_ar'  => 'ساجدة',
            'name_lt' => 'sajeda',
            'code' => '01',
            'domain' => 'kids',
            'description' => '',
            'active' => true,
            'address_ar' => 'la gare',
            'address_lt' => 'la gare',
            'city_id' => City::where('name_ar', 'تيارت')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name_ar'  => 'ساجدة كيدس',
            'name_lt' => 'sajeda kids',
            'code' => '01',
            'domain' => 'kids',
            'description' => '',
            'active' => true,
            'address_ar' => 'la gare',
            'address_lt' => 'la gare',
            'city_id' => City::where('name_ar', 'تيارت')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name_ar'  => 'أحذية',
            'name_lt' => 'Ahyjia',
            'code' => '01',
            'domain' => 'kids',
            'description' => '',
            'active' => true,
            'address_ar' => 'la foire',
            'address_lt' => 'la foire',
            'city_id' => City::where('name_ar', 'تيارت')->first()->id,
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ]]);
    }
}
