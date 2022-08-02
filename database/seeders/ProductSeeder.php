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
            'productPrice' => 150,
            'productMonthsOfWarranty' => 12,
            'productManufacturingDate' => '2022-07-21',
            'country_id' => 1,
            'manufacturer_id' => 1,
        ]);

        ProductTranslation::query()->create([
            'product_id'=>'1',
            'productName'=>'Xiaomi Mi 11 Lite 5g',
            'productDescription'=>'Lightweight, 5G SpeedWith the true flagship-level device，it can add to the excitement of your 5G life and show your style in any aspect. LightConvenient and portable, carry it around with ease. SlimThin and light, ultra-comfortable feel.',
            'locale'=>'en']);
        ProductTranslation::query()->create([
            'product_id'=>'1',
            'productName'=>'Xiaomi Mi 11 Lite 5g',
            'productDescription'=>'Opis za Xiaomi mi 11 lite 5g',
            'locale'=>'me']);
    }
}
