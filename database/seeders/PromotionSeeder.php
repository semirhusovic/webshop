<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::query()->create([
            'promotion_name:en' => 'Xiaomi promotion',
            'promotion_name:me' => 'Šaomi promocija'
        ]);
        Promotion::query()->create([
            'promotion_name:en' => 'Samsung promotion',
            'promotion_name:me' => 'Samsung promocija'
        ]);
        Promotion::query()->create([
            'promotion_name:en' => 'Apple promotion',
            'promotion_name:me' => 'Apple promocija'
        ]);

        DB::table('product_promotion')->insert([
            'promotion_id' => rand(1, 3),
            'product_id' => fake()->unique()->randomNumber(1, 9)
        ]);
        DB::table('product_promotion')->insert([
            'promotion_id' => rand(1, 3),
            'product_id' => fake()->unique()->randomNumber(1, 9)
        ]);
        DB::table('product_promotion')->insert([
            'promotion_id' => rand(1, 3),
            'product_id' => fake()->unique()->randomNumber(1, 9)
        ]);
    }
}
