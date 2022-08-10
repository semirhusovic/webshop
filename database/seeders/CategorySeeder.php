<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->create(['id' => 1]);
        Category::query()->create(['id' => 2]);


        CategoryTranslation::query()->create(['category_id'=>1, 'category_name'=>'Food', 'locale'=>'en']);
        CategoryTranslation::query()->create(['category_id'=>1, 'category_name'=>'Hrana', 'locale'=>'me']);

        CategoryTranslation::query()->create(['category_id'=>2, 'category_name'=>'Tech', 'locale'=>'en']);
        CategoryTranslation::query()->create(['category_id'=>2, 'category_name'=>'Tehnologija', 'locale'=>'me']);
    }
}
