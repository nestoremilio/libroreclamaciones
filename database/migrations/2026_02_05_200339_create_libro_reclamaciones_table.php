<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->id();

            // 1. Datos del Usuario
            $table->string('nombre_completo');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('domicilio');
            $table->string('telefono');
            $table->string('email');

            // 2. Detalle del Reclamo
            $table->string('tipo_bien'); // Producto o Servicio
            $table->decimal('monto_reclamado', 10, 2)->nullable(); // Opcional
            $table->string('descripcion_bien');
            $table->string('tipo_reclamo'); // Queja o Reclamo
            $table->text('detalle');
            $table->text('pedido');

            // 3. Gestión Interna
            $table->string('codigo_seguimiento')->unique(); // Para que el usuario consulte
            $table->string('estado')->default('pendiente'); // pendiente, atendido, etc.

            $table->timestamps(); // Fecha de creación
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
};