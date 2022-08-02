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


        CategoryTranslation::query()->create(['category_id'=>1, 'categoryName'=>'Food', 'locale'=>'en']);
        CategoryTranslation::query()->create(['category_id'=>1, 'categoryName'=>'Hrana', 'locale'=>'me']);

        CategoryTranslation::query()->create(['category_id'=>2, 'categoryName'=>'Tech', 'locale'=>'en']);
        CategoryTranslation::query()->create(['category_id'=>2, 'categoryName'=>'Tehnologija', 'locale'=>'me']);
    }
}
