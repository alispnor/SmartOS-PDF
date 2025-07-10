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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('os_number')->unique(); // OS #03372/25 [cite: 7]
            $table->string('aircraft_registration')->nullable(); // PP-JCA [cite: 10]
            $table->date('start_date')->nullable(); // Data de Início: 09/06/2025 [cite: 11]
            $table->date('end_date')->nullable(); // Término Previsto: 20/06/2025 [cite: 12]
            $table->string('document_reference')->nullable(); // F.TEC.015.REV03 [cite: 9]
            $table->date('document_date')->nullable(); // 15/07/2024 [cite: 9]
            $table->text('declaration_text')->nullable(); // Texto da DECLARAÇÃO DE AERONAVEGABILIDADE [cite: 46]
            $table->string('responsible_inspector_signature')->nullable(); // Assinatura do Inspetor Responsável [cite: 47]
            $table->string('sdco')->nullable(); // SDCO [cite: 47]

            // Informações da empresa no cabeçalho
            $table->string('company_name')->default('MTX Aviation Manutenção De Aeronaves Ltda'); // [cite: 6]
            $table->string('company_location')->default('Sorocaba/SP'); // [cite: 6]
            $table->string('company_anac_code')->default('COM 201306-41/ANAC'); // [cite: 6]
            $table->string('company_com_number')->default('COM 201306-41'); // [cite: 5]

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
