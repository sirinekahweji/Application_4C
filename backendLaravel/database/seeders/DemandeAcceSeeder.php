<?php

namespace Database\Seeders;

use App\Models\demandeAcce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemandeAcceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        demandeAcce::factory()->count(20)->create();
    }
}
