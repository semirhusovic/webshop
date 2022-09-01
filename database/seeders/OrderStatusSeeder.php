<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::query()->create(['status_name' => 'PENDING']);
        OrderStatus::query()->create(['status_name' => 'ACCEPTED']);
        OrderStatus::query()->create(['status_name' => 'SHIPPED']);
        OrderStatus::query()->create(['status_name' => 'DELIVERED']);
        OrderStatus::query()->create(['status_name' => 'ERROR']);
    }
}
