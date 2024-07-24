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
        Schema::create('formation_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('etablissement');
            $table->string('diplome');
            $table->string('domaineEtude');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->text('description')->nullable();
            $table->foreignId('cv_id');
            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_academiques');
    }
};
