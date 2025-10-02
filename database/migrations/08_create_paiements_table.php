<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_paiements', function (Blueprint $table) {
            $table->bigIncrements('paiement_id');
            $table->unsignedBigInteger('transaction_id');
            $table->string('type')->nullable(); // mode de paiement (ex: carte, mobile money)
            $table->enum('statut', ['en_attente', 'validee', 'echoue']);
            $table->dateTime('date_paiement');
            $table->timestamps();

            $table->foreign('transaction_id')->references('transaction_id')->on('tb_transactions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_paiements');
    }
};
