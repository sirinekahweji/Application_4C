<?php

namespace Database\Seeders;

use App\Models\interet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InteretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        interet::factory()->count(20)->create();
    }
}
