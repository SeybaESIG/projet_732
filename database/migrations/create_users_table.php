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
            $table->string('email')->unique()->nullable();
            $table->string('num_tel', 20)->unique()->nullable();
            $table->string('mot_de_passe');
            $table->dateTime('date_inscription');
            $table->string('adresse');
            $table->timestamps();

            // Contraintes CHECK pour le format
            $table->check("username REGEXP '^[A-Za-z0-9._]+$'");
            $table->check("nom REGEXP '^[A-Za-z]+$'");
            $table->check("prenom REGEXP '^[A-Za-z]+$'");
            $table->check("email IS NULL OR email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$'");
            $table->check("num_tel IS NULL OR num_tel REGEXP '^\\+?[0-9]{7,15}$'");

            // Au moins un des deux: email ou num_tel
            $table->check("(email IS NOT NULL OR num_tel IS NOT NULL)");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
