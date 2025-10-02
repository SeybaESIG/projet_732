<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_villes', function (Blueprint $table) {
            $table->bigIncrements('ville_id');
            $table->foreignId('pays_id')->constrained('pays')->onDelete('cascade');
            $table->string('name');
            $table->string('code_postal')->unique();
            $table->timestamps();

            $table->unique(['pays_id', 'name', 'code_postal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villes');
    }
};
