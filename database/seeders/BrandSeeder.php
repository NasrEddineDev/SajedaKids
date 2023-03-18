<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('brands')->insert([[
            'number' => '1',
            'name_ar' => 'Gini & Jony',
            'name_en' => 'Gini & Jony',
            'name_fr' => 'Gini & Jony',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '2',
            'name_ar' => 'Babyhug',
            'name_en' => 'Babyhug',
            'name_fr' => 'Babyhug',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '3',
            'name_ar' => 'Natalys',
            'name_en' => 'Natalys',
            'name_fr' => 'Natalys',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '4',
            'name_ar' => 'Bonpoint',
            'name_en' => 'Bonpoint',
            'name_fr' => 'Bonpoint',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ]]);
    }
}
