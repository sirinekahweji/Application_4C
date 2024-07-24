<?php

namespace Database\Seeders;

use App\Models\participantFormation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        participantFormation::factory()->count(20)->create();
    }
}
