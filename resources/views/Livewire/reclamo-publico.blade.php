<div>
    {{-- Mensaje de Éxito --}}
    @if ($mensajeExito)
        <div class="alert alert-success shadow-sm rounded-3 mb-4 text-center">
            <h4 class="alert-heading fw-bold"><i class="bi bi-check-circle-fill"></i> ¡Reclamo Enviado!</h4>
            <p>Su código de seguimiento es:</p>
            <span class="badge bg-success fs-3">{{ $codigoGenerado }}</span>
            <p class="mb-0 mt-2 small">Guarde este código para futuras consultas.</p>
            <button wire:click="$set('mensajeExito', false)" class="btn btn-sm btn-outline-success mt-3">Registrar otro</button>
        </div>
    @endif

    {{-- Formulario --}}
    @if (!$mensajeExito)
    <form wire:submit.prevent="guardar">
        
        <div class="mb-4 mb-md-5">
            <h5 class="section-title">
                <i class="bi bi-person-lines-fill"></i> <span>1. Identificación</span>
            </h5>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-muted small fw-bold">Nombre Completo</label>
                    <input type="text" wire:model="nombre_completo" class="form-control @error('nombre_completo') is-invalid @enderror">
                    @error('nombre_completo') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-12 col-md-5">
                    <label class="form-label text-muted small fw-bold">Tipo Doc.</label>
                    <select wire:model="tipo_documento" class="form-select">
                        <option>DNI</option>
                        <option>Carnet Extranjería</option>
                        <option>Pasaporte</option>
                    </select>
                </div>

                <div class="col-12 col-md-7">
                    <label class="form-label text-muted small fw-bold">N° Documento</label>
                    <input type="tel" wire:model="numero_documento" class="form-control @error('numero_documento') is-invalid @enderror" maxlength="12">
                    @error('numero_documento') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label text-muted small fw-bold">Domicilio</label>
                    <input type="text" wire:model="domicilio" class="form-control @error('domicilio') is-invalid @enderror">
                    @error('domicilio') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-muted small fw-bold">Teléfono</label>
                    <input type="tel" wire:model="telefono" class="form-control @error('telefono') is-invalid @enderror" maxlength="9">
                    @error('telefono') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label text-muted small fw-bold">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h5 class="section-title">
                <i class="bi bi-file-earmark-text-fill"></i> <span>2. Detalle</span>
            </h5>
            <div class="row g-3">
                <div class="col-12 col-md-8">
                    <label class="form-label text-muted small fw-bold">Bien Contratado</label>
                    <select wire:model="tipo_bien" class="form-select">
                        <option value="servicio">Servicio</option>
                        <option value="producto">Producto</option>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label text-muted small fw-bold">Monto (S/)</label>
                    <input type="number" wire:model="monto_reclamado" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label text-muted small fw-bold">Descripción</label>
                    <input type="text" wire:model="descripcion_bien" class="form-control @error('descripcion_bien') is-invalid @enderror">
                    @error('descripcion_bien') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 mt-3">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="tipo-reclamo-card text-center p-2 {{ $tipo_reclamo == 'reclamo' ? 'border-success bg-light' : '' }}">
                                <input class="form-check-input" type="radio" wire:model="tipo_reclamo" value="reclamo" id="r1">
                                <label class="fw-bold d-block" for="r1">Reclamo</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="tipo-reclamo-card text-center p-2 {{ $tipo_reclamo == 'queja' ? 'border-success bg-light' : '' }}">
                                <input class="form-check-input" type="radio" wire:model="tipo_reclamo" value="queja" id="r2">
                                <label class="fw-bold d-block" for="r2">Queja</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label text-muted small fw-bold">Detalle de hechos</label>
                    <textarea wire:model="detalle" class="form-control @error('detalle') is-invalid @enderror" rows="3"></textarea>
                    @error('detalle') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label text-muted small fw-bold">Pedido</label>
                    <textarea wire:model="pedido" class="form-control @error('pedido') is-invalid @enderror" rows="2"></textarea>
                    @error('pedido') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label text-muted small fw-bold">Adjuntar Evidencia (PDF)</label>
                    <input type="file" wire:model="evidencia" class="form-control" accept="application/pdf">
                    <div wire:loading wire:target="evidencia" class="text-success small mt-1">
                        <span class="spinner-border spinner-border-sm"></span> Subiendo archivo...
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-pnp btn-lg shadow" wire:loading.attr="disabled">
                <span wire:loading.remove><i class="bi bi-send-fill me-2"></i> Enviar Reclamo</span>
                <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span> Enviando...</span>
            </button>
        </div>
    </form>
    @endif
</div>