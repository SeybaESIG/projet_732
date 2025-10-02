<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_villes', function (Blueprint $table) {
            $table->bigIncrements('ville_id');
            $table->unsignedBigInteger('pays_id');
            $table->string('name');
            $table->string('code_postal')->unique();
            $table->timestamps();

            $table->foreign('pays_id')->references('pays_id')->on('tb_pays')->onDelete('cascade');
            $table->unique(['pays_id', 'name', 'code_postal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_villes');
    }
};
