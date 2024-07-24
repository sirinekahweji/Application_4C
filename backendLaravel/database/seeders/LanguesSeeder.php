<?php

namespace Database\Seeders;

use App\Models\Langues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langues::factory()->count(20)->create();
    }
}
