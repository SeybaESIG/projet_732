<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_enchere', function (Blueprint $table) {
            $table->bigIncrements('enchere_id');
            $table->unsignedBigInteger('annonce_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('prix', 12, 2);
            $table->dateTime('date_proposition');
            $table->timestamps();

            $table->foreign('annonce_id')->references('id')->on('tb_annonces');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_enchere');
    }
};
