<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LibroReclamaciones;

class ReclamoPublico extends Component
{
    use WithFileUploads;

    // Variables del formulario
    public $nombres_apellidos;
    public $tipo_documento = 'DNI';
    public $numero_documento;
    public $domicilio;
    public $telefono;
    public $correo;
    public $tipo_registro = 'reclamo';
    public $dependencia;
    public $detalle_hechos;
    public $pedido_usuario;
    public $evidencia_pdf_path;
    public $autoriza_notificacion_correo = false;
    public $acepta_politicas_privacidad = false;
    public $declaracion_jurada_veracidad = false;

    // Variables de estado
    public $mensajeExito = false;
    public $codigoGenerado = '';

    protected $rules = [
        'nombres_apellidos'           => 'required|min:3',
        'tipo_documento'              => 'required',
        'numero_documento'            => 'required|digits_between:8,12',
        'domicilio'                   => 'required',
        'telefono'                    => 'nullable|numeric|digits:9',
        'correo'                      => 'required|email',
        'tipo_registro'               => 'required|in:reclamo,queja',
        'dependencia'                 => 'required',
        'detalle_hechos'              => 'required|min:10',
        'pedido_usuario'              => 'required',
        'evidencia_pdf_path'          => 'nullable|mimes:pdf|max:5120',
        'acepta_politicas_privacidad' => 'accepted',
        'declaracion_jurada_veracidad'=> 'accepted',
    ];

    protected $messages = [
        'acepta_politicas_privacidad.accepted'  => 'Debe aceptar las políticas de privacidad.',
        'declaracion_jurada_veracidad.accepted' => 'Debe confirmar la veracidad de la información.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function guardar()
    {
        $this->validate();

        // Generar número de hoja: YYYY-XXXXXX
        $anio  = now()->format('Y');
        $count = LibroReclamaciones::whereYear('created_at', $anio)->count() + 1;
        $numero = $anio . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);

        $rutaEvidencia = null;
        if ($this->evidencia_pdf_path) {
            $rutaEvidencia = $this->evidencia_pdf_path->store('evidencias', 'public');
        }

        LibroReclamaciones::create([
            'numero_hoja_reclamacion'      => $numero,
            'nombres_apellidos'            => $this->nombres_apellidos,
            'tipo_documento'               => $this->tipo_documento,
            'numero_documento'             => $this->numero_documento,
            'domicilio'                    => $this->domicilio,
            'telefono'                     => $this->telefono,
            'correo'                       => $this->correo,
            'tipo_registro'                => $this->tipo_registro,
            'dependencia'                  => $this->dependencia,
            'detalle_hechos'               => $this->detalle_hechos,
            'pedido_usuario'               => $this->pedido_usuario,
            'evidencia_pdf_path'           => $rutaEvidencia,
            'autoriza_notificacion_correo' => $this->autoriza_notificacion_correo ? 1 : 0,
            'acepta_politicas_privacidad'  => 1,
            'declaracion_jurada_veracidad' => 1,
            'estado'                       => 'pendiente',
        ]);

        $this->mensajeExito  = true;
        $this->codigoGenerado = $numero;

        $this->reset(['nombres_apellidos', 'numero_documento', 'domicilio', 'telefono',
                      'correo', 'dependencia', 'detalle_hechos', 'pedido_usuario',
                      'evidencia_pdf_path', 'autoriza_notificacion_correo',
                      'acepta_politicas_privacidad', 'declaracion_jurada_veracidad']);
    }

    public function render()
    {
        return view('livewire.reclamo-publico');
    }
}
