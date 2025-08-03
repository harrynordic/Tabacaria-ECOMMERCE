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
        Schema::table('products', function (Blueprint $table) {
            // Adiciona a coluna 'category_id'
            // unsignedBigInteger: tipo de dado recomendado para chaves estrangeiras que apontam para 'id()'
            // nullable(): permite que produtos não tenham categoria, ou que a categoria possa ser removida sem deletar o produto.
            // after('description'): coloca a nova coluna logo após a coluna 'description' para organização, opcional.
            $table->unsignedBigInteger('category_id')->nullable()->after('description');

            // Define a chave estrangeira
            // foreign('category_id'): indica que 'category_id' é uma chave estrangeira.
            // references('id')->on('categories'): esta chave estrangeira faz referência à coluna 'id' na tabela 'categories'.
            // onDelete('set null'): esta é uma "ação em cascata". Significa que, se uma CATEGORIA for deletada,
            //       qualquer PRODUTO que estava associado a ela terá seu 'category_id' definido como NULL,
            //       mas o produto em si NÃO será deletado.
            //       (Alternativa perigosa: 'onDelete('cascade')' deletaria o produto junto com a categoria!)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Ao reverter a migração (rollback), primeiro removemos a restrição da chave estrangeira...
            $table->dropForeign(['category_id']);
            // ... e só então removemos a coluna. A ordem importa!
            $table->dropColumn('category_id');
        });
    }
};