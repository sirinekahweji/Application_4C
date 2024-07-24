<?php

namespace Database\Seeders;

use App\Models\FichierEvaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FichierEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FichierEvaluation::factory()->count(20)->create();
    }
}
