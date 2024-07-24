<?php

namespace Database\Seeders;

use App\Models\Certificat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificat::factory()->count(20)->create();
    }
}
