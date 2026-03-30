<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->id();

            // Datos del ciudadano
            $table->string('tipo_documento', 10);
            $table->string('numero_documento', 20)->unique();
            $table->string('nombres_apellidos', 200);
            $table->string('domicilio', 300);
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 150);

            // Detalle del reclamo
            $table->enum('tipo_registro', ['reclamo', 'queja']);
            $table->string('dependencia', 200);
            $table->text('detalle_hechos');
            $table->text('pedido_usuario');

            // Evidencia adjunta
            $table->string('evidencia_pdf_path', 255)->nullable();

            // Declaraciones
            $table->tinyInteger('autoriza_notificacion_correo')->default(0);
            $table->tinyInteger('acepta_politicas_privacidad')->default(0);
            $table->tinyInteger('declaracion_jurada_veracidad')->default(0);

            // Gestión interna
            $table->enum('estado', ['pendiente', 'en_proceso', 'resuelto'])->default('pendiente');
            $table->string('numero_hoja_reclamacion', 20)->nullable()->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
};
