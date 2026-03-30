<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroReclamaciones extends Model
{
    use HasFactory;

    protected $table = 'libro_reclamaciones';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres_apellidos',
        'domicilio',
        'telefono',
        'correo',
        'tipo_registro',
        'dependencia',
        'detalle_hechos',
        'pedido_usuario',
        'evidencia_pdf_path',
        'autoriza_notificacion_correo',
        'acepta_politicas_privacidad',
        'declaracion_jurada_veracidad',
        'estado',
        'numero_hoja_reclamacion',
    ];
}
