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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->integer('phoneNumber');
            $table->integer('cin');
            $table->binary('code_qr')->nullable();
            $table->string('photoProfile')->nullable();
            $table->string('photoCouverture')->nullable();
            $table->boolean('genre');
            $table->date('dateNaissance');
            $table->string('lienLinkdIn')->nullable();
            $table->string('adresse');
            $table->string('Gouvernorat');
            $table->string('user_type');
            $table->integer('nbEtoiles');
            $table->boolean('corbeille')->default(false);
            $table->foreignId('role_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
