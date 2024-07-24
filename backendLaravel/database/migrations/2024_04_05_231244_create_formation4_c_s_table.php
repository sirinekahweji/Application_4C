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
        Schema::create('formation4_c_s', function (Blueprint $table) {
            $table->id();
            $table->binary('code_qr');
            $table->integer('nbSession');
            $table->string('formateur');
            $table->string('affiche');
            $table->integer('capacite');
            $table->date('dateLimiteInscription');
            $table->string("titre");
            $table->string("categorie");
            $table->boolean('forManagers')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation4_c_s');
    }
};
