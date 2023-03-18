<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Company;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('settings')->insert([[
            'name' => 'Offers List',
            'value' => '5,10,15,20,50,100,200',
            'description' => '',
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name' => 'Unit Price',
            'value' => '500',
            'description' => '',
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name' => 'Activate Digital Signature',
            'value' => 'No',
            'description' => '',
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ],[
            'name' => 'Default Certificate Template',
            'value' => '2',
            'description' => '',
            'company_id' => Company::where('name_lt', 'ahmed company')->first()->id,
        ]]);
    }
}
