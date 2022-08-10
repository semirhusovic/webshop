<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::query()->create([
            'imageable_id' => 1,
            'imageable_type' => 'App\Models\Product',
            'file_name' => 'xiaomi5g.webp'
        ]);

        Image::query()->create([
            'imageable_id' => 1,
            'imageable_type' => 'App\Models\Slider',
            'file_name' => 'vegetables.jpg'
        ]);
    }
}
