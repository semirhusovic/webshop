<?php

namespace Database\Seeders;

use App\Models\InvoiceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceStatus::query()->create(['status_name' => 'UNPAID']);
        InvoiceStatus::query()->create(['status_name' => 'PAID']);
        InvoiceStatus::query()->create(['status_name' => 'ERROR']);
    }
}
