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
        Schema::create('ventas', function (Blueprint $table) {

            $table->id();
            $table->foreignId('cliente_id')
            ->constrained('clientes')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('fecha');
            $table->float('subtotal',8,2);
            $table->float('descuento',8,2);
            $table->float('iva',8,2);
            $table->float('total',8,2);
            $table->float('pagado',8,2);
            $table->float('saldo',8,2);
            $table->string('observacion', 100)->nullable();
            $table->foreignId('user_id')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
