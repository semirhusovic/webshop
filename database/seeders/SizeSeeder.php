<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::query()->create([
           'size_name' => 'S'
        ]);
        Size::query()->create([
            'size_name' => 'M'
        ]);
        Size::query()->create([
            'size_name' => 'L'
        ]);
        Size::query()->create([
            'size_name' => 'XL'
        ]);
        Size::query()->create([
            'size_name' => 'XXL'
        ]);
        Size::query()->create([
            'size_name' => 'XXXL'
        ]);
    }
}
