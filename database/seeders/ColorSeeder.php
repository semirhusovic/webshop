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
            'color_name:me' => 'Crna',
            'hexcode' => '#000000'
        ]);
        Color::query()->create([
            'color_name:en' => 'Yellow',
            'color_name:me' => 'Zuta',
            'hexcode' => '#ffff00'
        ]);
        Color::query()->create([
            'color_name:en' => 'Blue',
            'color_name:me' => 'Plava',
            'hexcode' => '#009dff'
        ]);
        Color::query()->create([
            'color_name:en' => 'Purple',
            'color_name:me' => 'Ljubicasta',
            'hexcode' => '#800080'
        ]);
    }
}
