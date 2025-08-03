<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona uma nova coluna 'is_admin' do tipo booleano, com valor padrão 'false'.
            // 'after('email_verified_at')' é opcional, apenas para posicionamento.
            $table->boolean('is_admin')->default(false)->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ao reverter, remove a coluna.
            $table->dropColumn('is_admin');
        });
    }
};