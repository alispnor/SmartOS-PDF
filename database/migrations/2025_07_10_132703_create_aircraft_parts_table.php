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
        Schema::create('aircraft_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_order_id')->constrained()->onDelete('cascade'); // Chave estrangeira para service_orders
            $table->string('type'); // AIRFRAME, LEFT ENGINE, RIGHT ENGINE, LEFT PROPELLER, RIGHT PROPELLER 

            $table->string('model')->nullable(); // Modelo: F90 
            $table->string('manufacturer')->nullable(); // Fabricante: BEECH 
            $table->string('sn')->nullable(); // SN: LA-107 
            $table->string('csn')->nullable(); // CSN: 10353 
            $table->string('tso')->nullable(); // TSO: N/A 
            $table->string('tsn')->nullable(); // TSN: 9442.7 
            $table->string('revision_manual')->nullable(); // Manual:CO 
            $table->string('revision_pn')->nullable(); // Revision: M.M./PN:109-590010-19 
            $table->string('manufacture_year')->nullable(); // Ano de Fabricação: 1981 
            $table->string('cso')->nullable(); // CSO: N/A 

            $table->timestamps();

            // Adicionar um índice para consultas mais rápidas por tipo e OS
            $table->index(['service_order_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aircraft_parts');
    }
};
