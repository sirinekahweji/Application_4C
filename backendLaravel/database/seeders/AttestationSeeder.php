<?php

namespace Database\Seeders;

use App\Models\Attestation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attestation::factory()->count(20)->create();
    }
}
