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
        Schema::create('service_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained()->onDelete('cascade'); // Chave estrangeira para service_orders
            $table->integer('item_number'); // 1, 2, 3... [cite: 14, 16, 19]
            $table->text('description'); // EFETUAR SUBSTITUIÇÃO DO TRANSMISSOR DE PRESSÃO DE OLEO LADO DIREITO [cite: 14]
            $table->string('team')->nullable(); // Equipe: André Segato inspector | Thiago Paulucci Dos Santos - inspector [cite: 14]
            $table->string('interval')->nullable(); // Intervalo: 6M [cite: 22]
            $table->string('hours')->nullable(); // Horas: N/A [cite: 22]
            $table->string('cycles')->nullable(); // Ciclos N/A [cite: 22]

            $table->timestamps();

            // Adicionar índice para ordenar os itens
            $table->index(['service_order_id', 'item_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_order_items');
    }
};
