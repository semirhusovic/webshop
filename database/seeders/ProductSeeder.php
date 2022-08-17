<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->create([
            'product_price' => 150,
            'product_months_of_warranty' => 12,
            'product_manufacturing_date' => '2022-07-21',
            'unit_of_measure' => 'piece',
            'country_id' => 1,
            'manufacturer_id' => 1,
        ]);

        ProductTranslation::query()->create([
            'product_id'=>'1',
            'product_name'=>'Xiaomi Mi 11 Lite 5g',
            'product_description'=>'Lightweight, 5G SpeedWith the true flagship-level device，it can add to the excitement of your 5G life and show your style in any aspect. LightConvenient and portable, carry it around with ease. SlimThin and light, ultra-comfortable feel.',
            'locale'=>'en']);
        ProductTranslation::query()->create([
            'product_id'=>'1',
            'product_name'=>'Xiaomi Mi 11 Lite 5g',
            'product_description'=>'Opis za Xiaomi mi 11 lite 5g',
            'locale'=>'me']);
    }
}
