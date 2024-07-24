<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participant_formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation4c_id');
            $table->foreignId('user_id');
            $table->foreignId('fichierEvaluation_id');
            $table->foreign('fichierEvaluation_id')->references('id')->on('fichier_evaluations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('formation4c_id')->references('id')->on('formation4_c_s')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_formations');
    }
};
