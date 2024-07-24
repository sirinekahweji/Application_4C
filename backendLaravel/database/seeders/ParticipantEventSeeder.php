<?php

namespace Database\Seeders;

use App\Models\ParticipantEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParticipantEvent::factory()->count(20)->create();
    }
}
