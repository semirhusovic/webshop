<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::query()->create(['id' => 1]);
        Country::query()->create(['id' => 2]);
        Country::query()->create(['id' => 3]);


        CountryTranslation::query()->create(['country_id'=>1, 'country_name'=>'China', 'locale'=>'en']);
        CountryTranslation::query()->create(['country_id'=>1, 'country_name'=>'Kina', 'locale'=>'me']);

        CountryTranslation::query()->create(['country_id'=>2, 'country_name'=>'Hungary', 'locale'=>'en']);
        CountryTranslation::query()->create(['country_id'=>2, 'country_name'=>'Madjarska', 'locale'=>'me']);

        CountryTranslation::query()->create(['country_id'=>3, 'country_name'=>'Montenegro', 'locale'=>'en']);
        CountryTranslation::query()->create(['country_id'=>3, 'country_name'=>'Crna Gora', 'locale'=>'me']);
    }
}
