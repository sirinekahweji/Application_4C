<?php

namespace Database\Seeders;

use App\Models\GroupeManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupeManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GroupeManager::factory()->count(20)->create();
    }
}
