<?php

namespace Database\Seeders;

use App\Models\certificat4c;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Certificat4cSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        certificat4c::factory()->count(20)->create();
    }
}
