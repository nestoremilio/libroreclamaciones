<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convertir registros 'en_proceso' y 'resuelto' a 'atendido'
        DB::statement("UPDATE libro_reclamaciones SET estado = 'atendido' WHERE estado IN ('en_proceso', 'resuelto')");

        // Cambiar el ENUM para solo aceptar 'pendiente' y 'atendido'
        DB::statement("ALTER TABLE libro_reclamaciones MODIFY estado ENUM('pendiente', 'atendido') NOT NULL DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE libro_reclamaciones MODIFY estado ENUM('pendiente', 'en_proceso', 'resuelto') NOT NULL DEFAULT 'pendiente'");
    }
};
