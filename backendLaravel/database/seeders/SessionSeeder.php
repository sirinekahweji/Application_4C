<?php

namespace Database\Seeders;

use App\Models\session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        session::factory()->count(20)->create();
    }
}
