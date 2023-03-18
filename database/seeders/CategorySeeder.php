<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([[
            'number' => '1',
            'name_ar' => 'Accessories',
            'name_en' => 'Accessories',
            'name_fr' => 'Accessories',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '2',
            'name_ar' => 'Shoes',
            'name_en' => 'Shoes',
            'name_fr' => 'Shoes',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '3',
            'name_ar' => 'Pants',
            'name_en' => 'Pants',
            'name_fr' => 'Pants',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ],[
            'number' => '4',
            'name_ar' => 'Jacket',
            'name_en' => 'Jacket',
            'name_fr' => 'Jacket',
            'description_ar' => '',
            'description_en' => '',
            'description_fr' => '',
            'active' => true,
        ]]);
    }
}
