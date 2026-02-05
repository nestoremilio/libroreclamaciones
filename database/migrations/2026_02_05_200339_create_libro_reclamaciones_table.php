<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('domicilio');
            $table->string('telefono');
            $table->string('email');

            $table->enum('tipo_bien', ['producto', 'servicio']);
            $table->decimal('monto_reclamado', 10, 2)->nullable();
            $table->text('descripcion_bien');

            $table->enum('tipo_reclamo', ['reclamo', 'queja']);
            $table->text('detalle');
            $table->text('pedido');

            $table->string('codigo_seguimiento')->unique();
            $table->enum('estado', ['pendiente', 'en_proceso', 'atendido'])->default('pendiente');
            $table->text('respuesta_empresa')->nullable();
            $table->date('fecha_respuesta')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
};