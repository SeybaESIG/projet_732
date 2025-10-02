<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_users', function (Blueprint $table) {
            $table->bigIncrements('users_id');
            $table->string('username', 30)->unique();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('adresse');
            $table->unsignedBigInteger('ville_id');

            $table->string('email')->unique()->nullable();
            $table->string('num_tel', 20)->unique()->nullable();
            $table->string('mot_de_passe');
            $table->dateTime('date_inscription');
            $table->timestamps();

            // Clé étrangère vers tb_villes
            $table->foreign('ville_id')->references('ville_id')->on('tb_villes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
