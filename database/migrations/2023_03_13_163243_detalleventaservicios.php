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
        Schema::create('detalleventaservicios', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('venta_id')
            ->constrained('ventas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('servicio_id')
            ->constrained('servicios')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('cantidad');
            $table->float('valor',8,2);
            $table->float('total',8,2);
            //$table->primary(['venta_id','servicio_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventaservicios');
    }
};
