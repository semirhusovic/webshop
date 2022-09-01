<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<51;$i++) {
            Stock::query()->create([
                'product_id' => $i,
                'color_id'=> rand(1, 5),
                'size_id'=> rand(1, 5),
                'quantity'=> 29,
            ]);
        }
    }
}
