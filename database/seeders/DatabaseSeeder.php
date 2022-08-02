<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
        $this->call(CategorySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ProductSeeder::class);

    }
}
