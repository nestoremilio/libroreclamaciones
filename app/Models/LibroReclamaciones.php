<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamaciones extends Model
{
    use HasFactory;

    // Nombre exacto de la tabla en la base de datos
    protected $table = 'libro_reclamaciones';

    // Campos que permitimos guardar
    protected $fillable = [
        'nombre_completo',
        'tipo_documento',
        'numero_documento',
        'domicilio',
        'telefono',
        'email',
        'tipo_bien',
        'monto_reclamado',
        'descripcion_bien',
        'tipo_reclamo',
        'detalle',
        'pedido',
        'codigo_seguimiento',
        'estado',
        'evidencia', // <--- ¡CAMPO NUEVO AGREGADO!
    ];
}