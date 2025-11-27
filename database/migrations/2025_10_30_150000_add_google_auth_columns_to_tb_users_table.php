<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tb_users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('num_tel');
            $table->text('google_access_token')->nullable()->after('google_id');
            $table->text('google_refresh_token')->nullable()->after('google_access_token');
            $table->timestamp('google_token_expires_at')->nullable()->after('google_refresh_token');
        });

        DB::statement('ALTER TABLE tb_users MODIFY mot_de_passe VARCHAR(255) NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tb_users MODIFY mot_de_passe VARCHAR(255) NOT NULL');

        Schema::table('tb_users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'google_access_token',
                'google_refresh_token',
                'google_token_expires_at',
            ]);
        });
    }
};
