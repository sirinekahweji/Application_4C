<?php

namespace Database\Seeders;

use App\Models\participantCertificat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantCertificatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        participantCertificat::factory()->count(20)->create();
    }
}
