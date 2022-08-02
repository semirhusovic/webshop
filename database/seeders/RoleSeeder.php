<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->create(['roleName' => 'Admin']);
        Role::query()->create(['roleName' => 'Seller']);
        Role::query()->create(['roleName' => 'Buyer']);
    }
}
