<?php

namespace Database\Seeders;

use App\Models\FormationAcademique;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationAcademiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormationAcademique::factory()->count(20)->create();
    }
}
