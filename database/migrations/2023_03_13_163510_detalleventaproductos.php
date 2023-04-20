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
        Schema::create('detalleventaproductos', function (Blueprint $table) {
            //$table->id();
            $table->foreignId('venta_id')
            ->constrained('ventas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('producto_id')
            ->constrained('productos')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('cantidad');
            $table->float('valor',8,2);
            $table->float('total',8,2);
            $table->primary(['venta_id','producto_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventaproductos');
    }
};
