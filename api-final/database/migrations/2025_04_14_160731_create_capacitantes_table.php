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
        Schema::create('capacitantes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique()->index();
            $table->string('nombre_completo');
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('genero')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('qr_code')->unique()->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->string('estado')->default('Activo');
            $table->text('otros_datos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitantes');
    }
};
