<?php

namespace Database\Seeders;

use App\Models\Formation4C;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Formation4CSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formation4C::factory()->count(20)->create();
    }
}
