<?php

namespace Database\Seeders;

use App\Models\presenceFormation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        presenceFormation::factory()->count(20)->create();
    }
}
