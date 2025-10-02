<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_message', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->unsignedBigInteger('annonce_id');
            $table->unsignedBigInteger('expediteur_id');
            $table->unsignedBigInteger('receveur_id');
            $table->string('contenu', 1000);
            $table->dateTime('date_envoi');

            $table->foreign('annonce_id')->references('annonce_id')->on('tb_annonces')->onDelete('cascade');
            $table->foreign('expediteur_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('receveur_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_message');
    }
};
