<?php

namespace Database\Seeders;

use App\Models\PresenceEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PresenceEvent::factory()->count(20)->create();
    }
}
