<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ProductFactory;
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


        $this->call(CategorySeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(InvoiceStatusSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PromotionSeeder::class);

    }
}
