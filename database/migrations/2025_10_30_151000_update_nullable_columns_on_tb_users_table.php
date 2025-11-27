<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE tb_users MODIFY username VARCHAR(30) NULL');
        DB::statement('ALTER TABLE tb_users MODIFY adresse VARCHAR(255) NULL');
        DB::statement('ALTER TABLE tb_users MODIFY ville_id BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tb_users MODIFY username VARCHAR(30) NOT NULL');
        DB::statement('ALTER TABLE tb_users MODIFY adresse VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE tb_users MODIFY ville_id BIGINT UNSIGNED NOT NULL');
    }
};
