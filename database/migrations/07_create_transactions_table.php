<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('annonce_id');
            $table->decimal('montant', 12, 2);
            $table->enum('statut', ['en_attente', 'validee', 'annulee', 'remboursee']);
            $table->dateTime('date_transaction');
            $table->timestamps();

            $table->foreign('user_id')->references('users_id')->on('tb_users');
            $table->foreign('annonce_id')->references('annonce_id')->on('tb_annonces');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_transactions');
    }
};
