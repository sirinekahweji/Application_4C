<?php

namespace Database\Seeders;

use App\Models\UserAttestation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAttestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAttestation::factory()->count(20)->create();
    }
}
