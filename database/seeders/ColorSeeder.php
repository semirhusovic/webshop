<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::query()->create([
            'color_name:en' => 'Black',
            'color_name:me' => 'Crna'
        ]);
        Color::query()->create([
            'color_name:en' => 'Yellow',
            'color_name:es' => 'Zuta'
        ]);
        Color::query()->create([
            'color_name:en' => 'Blue',
            'color_name:es' => 'Plava'
        ]);
        Color::query()->create([
            'color_name:en' => 'Purple',
            'color_name:es' => 'Ljubicasta'
        ]);
    }
}
