<div>
    {{-- MENSAJE DE ÉXITO --}}
    @if ($mensajeExito)
        <div class="text-center py-5">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-lg" style="width: 80px; height: 80px;">
                    <i class="bi bi-check-lg fs-1"></i>
                </div>
            </div>
            <h2 class="fw-bold text-success mb-3">¡Reclamo Registrado!</h2>
            <p class="text-muted mb-4">Su hoja de reclamación ha sido enviada correctamente.</p>

            <div class="card border-success border-2 bg-light d-inline-block px-5 py-3 mb-4 shadow-sm">
                <small class="text-uppercase text-muted fw-bold ls-1">N° de Hoja de Reclamación</small>
                <div class="fs-2 fw-bold text-success font-monospace mt-1">{{ $codigoGenerado }}</div>
            </div>

            <div>
                <button wire:click="$set('mensajeExito', false)" class="btn btn-outline-success px-4 rounded-pill">
                    <i class="bi bi-plus-lg me-2"></i> Registrar Nuevo Reclamo
                </button>
            </div>
        </div>
    @endif

    {{-- FORMULARIO --}}
    @if (!$mensajeExito)
    <form wire:submit.prevent="guardar">

        {{-- SECCIÓN 1: Identificación --}}
        <div class="mb-5">
            <h5 class="d-flex align-items-center fw-bold text-success mb-4 border-bottom pb-2">
                <span class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-size: 0.9rem;">1</span>
                Identificación del Ciudadano
            </h5>

            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Nombres y Apellidos</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" wire:model.live="nombres_apellidos" class="form-control border-start-0 ps-0 @error('nombres_apellidos') is-invalid @enderror" placeholder="Nombres y Apellidos completos">
                        @error('nombres_apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label small fw-bold text-secondary">Tipo Documento</label>
                    <select wire:model.live="tipo_documento" class="form-select bg-light">
                        <option>DNI</option>
                        <option>Carnet Extranjería</option>
                        <option>Pasaporte</option>
                    </select>
                </div>

                <div class="col-12 col-md-7">
                    <label class="form-label small fw-bold text-secondary">Número Documento</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-card-heading text-muted"></i></span>
                        <input type="tel" wire:model.live="numero_documento" class="form-control border-start-0 ps-0 @error('numero_documento') is-invalid @enderror" placeholder="Ej: 12345678" maxlength="12">
                        @error('numero_documento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Domicilio Actual</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-muted"></i></span>
                        <input type="text" wire:model.live="domicilio" class="form-control border-start-0 ps-0 @error('domicilio') is-invalid @enderror" placeholder="Dirección completa">
                        @error('domicilio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-bold text-secondary">Teléfono / Celular</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-phone text-muted"></i></span>
                        <input type="tel" wire:model.live="telefono" class="form-control border-start-0 ps-0 @error('telefono') is-invalid @enderror" maxlength="9" placeholder="999888777">
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-bold text-secondary">Correo Electrónico</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" wire:model.live="correo" class="form-control border-start-0 ps-0 @error('correo') is-invalid @enderror" placeholder="correo@ejemplo.com">
                        @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 2: Detalle --}}
        <div class="mb-4">
            <h5 class="d-flex align-items-center fw-bold text-success mb-4 border-bottom pb-2">
                <span class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-size: 0.9rem;">2</span>
                Detalle del Reclamo
            </h5>

            <div class="row g-4">

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary d-block mb-3">Tipo de Registro (Seleccione uno)</label>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="card h-100 p-3 text-center border-2 shadow-sm position-relative {{ $tipo_registro == 'reclamo' ? 'border-success bg-light' : 'border-light' }}" style="cursor:pointer; transition: all 0.2s;">
                                <input type="radio" wire:model.live="tipo_registro" value="reclamo" class="d-none">
                                <div class="mb-2">
                                    <i class="bi bi-exclamation-circle-fill fs-1 {{ $tipo_registro == 'reclamo' ? 'text-success' : 'text-muted opacity-50' }}"></i>
                                </div>
                                <div class="fw-bold {{ $tipo_registro == 'reclamo' ? 'text-success' : 'text-dark' }}">Reclamo</div>
                                <small class="d-block text-muted mt-1" style="font-size: 0.75rem; line-height: 1.2;">Disconformidad con producto/servicio</small>
                                @if($tipo_registro == 'reclamo')
                                    <div class="position-absolute top-0 end-0 m-2 text-success"><i class="bi bi-check-circle-fill"></i></div>
                                @endif
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="card h-100 p-3 text-center border-2 shadow-sm position-relative {{ $tipo_registro == 'queja' ? 'border-success bg-light' : 'border-light' }}" style="cursor:pointer; transition: all 0.2s;">
                                <input type="radio" wire:model.live="tipo_registro" value="queja" class="d-none">
                                <div class="mb-2">
                                    <i class="bi bi-person-x-fill fs-1 {{ $tipo_registro == 'queja' ? 'text-success' : 'text-muted opacity-50' }}"></i>
                                </div>
                                <div class="fw-bold {{ $tipo_registro == 'queja' ? 'text-success' : 'text-dark' }}">Queja</div>
                                <small class="d-block text-muted mt-1" style="font-size: 0.75rem; line-height: 1.2;">Malestar en la atención al público</small>
                                @if($tipo_registro == 'queja')
                                    <div class="position-absolute top-0 end-0 m-2 text-success"><i class="bi bi-check-circle-fill"></i></div>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Dependencia / Servicio Involucrado</label>
                    <input type="text" wire:model.live="dependencia" class="form-control @error('dependencia') is-invalid @enderror" placeholder="Ej: Oficina de Trámites Documentarios, Atención al Público, etc.">
                    @error('dependencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Detalle de los Hechos</label>
                    <textarea wire:model.live="detalle_hechos" class="form-control @error('detalle_hechos') is-invalid @enderror" rows="4" placeholder="Describa detalladamente lo sucedido..."></textarea>
                    @error('detalle_hechos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Pedido del Ciudadano</label>
                    <textarea wire:model.live="pedido_usuario" class="form-control @error('pedido_usuario') is-invalid @enderror" rows="2" placeholder="¿Qué solución espera?"></textarea>
                    @error('pedido_usuario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label small fw-bold text-secondary">Adjuntar Evidencia (PDF) — Opcional</label>

                    <div class="border rounded p-3 bg-light text-center position-relative">
                        @if ($evidencia_pdf_path)
                            <div class="d-flex align-items-center justify-content-center text-success">
                                <i class="bi bi-file-earmark-pdf-fill fs-3 me-2"></i>
                                <span class="fw-bold">Archivo PDF seleccionado</span>
                                <button type="button" wire:click="$set('evidencia_pdf_path', null)" class="btn btn-sm btn-outline-danger ms-3 rounded-circle" title="Quitar">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        @else
                            <div class="text-muted">
                                <i class="bi bi-cloud-upload fs-2 d-block mb-1"></i>
                                <span class="small">Haga clic o arrastre su PDF aquí</span>
                            </div>
                        @endif

                        <input type="file" wire:model="evidencia_pdf_path" class="position-absolute top-0 start-0 w-100 h-100 opacity-0" style="cursor:pointer;" accept="application/pdf">
                    </div>

                    <div wire:loading wire:target="evidencia_pdf_path" class="text-success small mt-2 w-100 text-center">
                        <span class="spinner-border spinner-border-sm me-1"></span> Subiendo archivo...
                    </div>
                    @error('evidencia_pdf_path') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                {{-- Declaraciones --}}
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" wire:model.live="autoriza_notificacion_correo" id="autoriza">
                        <label class="form-check-label small" for="autoriza">
                            Autorizo recibir notificaciones al correo electrónico proporcionado.
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input @error('acepta_politicas_privacidad') is-invalid @enderror" type="checkbox" wire:model.live="acepta_politicas_privacidad" id="politicas">
                        <label class="form-check-label small" for="politicas">
                            Acepto las políticas de privacidad y el tratamiento de mis datos personales. <span class="text-danger">*</span>
                        </label>
                        @error('acepta_politicas_privacidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('declaracion_jurada_veracidad') is-invalid @enderror" type="checkbox" wire:model.live="declaracion_jurada_veracidad" id="veracidad">
                        <label class="form-check-label small" for="veracidad">
                            Declaro bajo juramento que la información proporcionada es verídica. <span class="text-danger">*</span>
                        </label>
                        @error('declaracion_jurada_veracidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="d-grid gap-2 mt-5">
            <button type="submit" class="btn btn-pnp btn-lg shadow rounded-pill py-3 fw-bold" wire:loading.attr="disabled">
                <span wire:loading.remove>
                    ENVIAR RECLAMO <i class="bi bi-send-fill ms-2"></i>
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm me-2"></span> PROCESANDO...
                </span>
            </button>
            <p class="text-center text-muted small mt-2">
                <i class="bi bi-lock-fill"></i> Sus datos están protegidos por la Ley N° 29733
            </p>
        </div>
    </form>
    @endif
</div>
