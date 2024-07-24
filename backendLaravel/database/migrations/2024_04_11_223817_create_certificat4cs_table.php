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
        Schema::create('certificat4cs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('lieu');
            $table->string('affiche')->nullable();
            $table->integer('capacite');
            $table->date('dateLimiteInscription');
            $table->date('date');
            $table->string('certificat')->nullable();
            $table->binary('code_qr');
            $table->double('prix');
            $table->double('offre');
            $table->string('organisation');
            $table->string('categorie');
            $table->boolean('forManagers')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificat4cs');
    }
};
