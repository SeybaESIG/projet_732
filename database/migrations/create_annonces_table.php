<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_annonces', function (Blueprint $table) {
            $table->bigIncrements('annonce_id');
            $table->unsignedBigInteger('user_id');
            $table->string('description', 500);
            $table->decimal('prix', 10, 2)->unsigned();
            $table->dateTime('date_publication');
            $table->enum('statut', ['active', 'vendue']);
            $table->string('titre')->nullable();

            // Contraintes CHECK
            $table->check("prix >= 0");
            $table->check("titre IS NULL OR titre REGEXP '^[A-Za-z0-9]+$'");

            // Clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_annonces');
    }
};
