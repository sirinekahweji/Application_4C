<?php

namespace Database\Seeders;

use App\Models\presenceCertificat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceCertificatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        presenceCertificat::factory()->count(20)->create();
    }
}
