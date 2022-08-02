<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\SliderTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::query()->create([
            'link' => 'https://google.com',
            'isActive' => 1,
            'order' => 1,
            'duration' => 3
        ]);

        SliderTranslation::query()->create(['slider_id' => 1, 'locale' => 'en', 'title' => 'Vegetables']);
        SliderTranslation::query()->create(['slider_id' => 1, 'locale' => 'me', 'title' => 'Domace povrce']);
    }
}
