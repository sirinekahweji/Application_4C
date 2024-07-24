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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->binary('code_qr')->nullable();
            $table->string('affiche')->nullable();
            $table->integer('capacite');
            $table->date('dateLimiteInscription');
            $table->boolean('forManagers')->default(false);
            $table->string('categorie');
            $table->string('lieu');
            $table->text('description');
            $table->string('titre');
            $table->date('date');
            $table->string('organisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
