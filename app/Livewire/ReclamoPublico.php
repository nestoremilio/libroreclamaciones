<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LibroReclamaciones;

class ReclamoPublico extends Component
{
    use WithFileUploads;

    // Variables del formulario
    public $nombre_completo;
    public $tipo_documento = 'DNI';
    public $numero_documento;
    public $domicilio;
    public $telefono;
    public $email;
    public $tipo_bien = 'servicio';
    public $monto_reclamado;
    public $descripcion_bien;
    public $tipo_reclamo = 'reclamo';
    public $detalle;
    public $pedido;
    public $evidencia;

    // Variables de estado
    public $mensajeExito = false;
    public $codigoGenerado = '';

    // Reglas de validación
    protected $rules = [
        'nombre_completo' => 'required|min:3',
        'tipo_documento' => 'required',
        'numero_documento' => 'required|numeric|digits_between:8,12',
        'domicilio' => 'required',
        'telefono' => 'required|numeric|digits:9',
        'email' => 'required|email',
        'tipo_bien' => 'required',
        'descripcion_bien' => 'required',
        'tipo_reclamo' => 'required',
        'detalle' => 'required|min:10',
        'pedido' => 'required',
        'evidencia' => 'nullable|mimes:pdf|max:5120',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function removeFile()
    {
        $this->evidencia = null;
    }

    public function guardar()
    {
        $this->validate();

        $codigo = 'REC-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        
        $rutaEvidencia = null;
        if ($this->evidencia) {
            $rutaEvidencia = $this->evidencia->store('evidencias', 'public');
        }

        LibroReclamaciones::create([
            'codigo_seguimiento' => $codigo,
            'nombre_completo' => $this->nombre_completo,
            'tipo_documento' => $this->tipo_documento,
            'numero_documento' => $this->numero_documento,
            'domicilio' => $this->domicilio,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'tipo_bien' => $this->tipo_bien,
            'monto_reclamado' => $this->monto_reclamado,
            'descripcion_bien' => $this->descripcion_bien,
            'tipo_reclamo' => $this->tipo_reclamo,
            'detalle' => $this->detalle,
            'pedido' => $this->pedido,
            'evidencia' => $rutaEvidencia,
            'estado' => 'pendiente'
        ]);

        $this->mensajeExito = true;
        $this->codigoGenerado = $codigo;
        
        // Limpiar campos
        $this->reset(['nombre_completo', 'numero_documento', 'domicilio', 'telefono', 'email', 'monto_reclamado', 'descripcion_bien', 'detalle', 'pedido', 'evidencia']);
    }

    public function render()
    {
        return view('livewire.reclamo-publico');
    }
}