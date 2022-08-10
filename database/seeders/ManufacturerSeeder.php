<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manufacturer::query()->create(['manufacturer_name' => 'Apple']);
        Manufacturer::query()->create(['manufacturer_name' => 'Samsung']);
        Manufacturer::query()->create(['manufacturer_name' => 'Xiaomi']);
    }
}
