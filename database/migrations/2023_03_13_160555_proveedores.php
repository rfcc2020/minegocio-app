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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 13)->unique()->nullable();
            $table->string('nombre', 50);
            $table->string('direccion', 50)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('foto', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
