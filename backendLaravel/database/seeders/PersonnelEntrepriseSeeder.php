<?php

namespace Database\Seeders;

use App\Models\PersonnelEntreprise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonnelEntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonnelEntreprise::factory()->count(20)->create();
    }
}
