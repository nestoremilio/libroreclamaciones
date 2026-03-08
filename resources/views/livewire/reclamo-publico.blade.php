<div>
    {{-- =====================
         MENSAJE DE ÉXITO
    ===================== --}}
    @if ($mensajeExito)
        <div class="text-center py-5">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-lg"
                    style="width:88px;height:88px;background:linear-gradient(135deg,#135835,#0e4429);">
                    <i class="bi bi-check-lg text-white fs-1"></i>
                </div>
            </div>
            <h2 class="fw-bold mb-2" style="color:#0e4429;">¡Reclamo Registrado!</h2>
            <p class="text-muted mb-4">Su hoja de reclamación ha sido enviada correctamente.</p>

            <div class="d-inline-block rounded-4 px-5 py-4 mb-4 shadow-sm"
                style="background:#f0faf4;border:2px solid #badbcc;">
                <div class="text-uppercase fw-bold text-muted mb-2"
                    style="font-size:0.7rem;letter-spacing:1px;">Código de Seguimiento</div>
                <div class="font-monospace fw-bold" style="font-size:1.6rem;color:#0e4429;">{{ $codigoGenerado }}</div>
                <div class="text-muted mt-1" style="font-size:0.75rem;">
                    <i class="bi bi-info-circle me-1"></i>Guarde este código para consultar el estado de su reclamo
                </div>
            </div>

            <div>
                <button wire:click="$set('mensajeExito', false)"
                    class="btn btn-outline-success px-4 rounded-pill fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i>Registrar Nuevo Reclamo
                </button>
            </div>
        </div>
    @endif

    {{-- =====================
         FORMULARIO
    ===================== --}}
    @if (!$mensajeExito)
    <form wire:submit.prevent="guardar">

        {{-- SECCIÓN 1: CIUDADANO --}}
        <div class="mb-5">
            <h5 class="section-title">
                <span class="step-badge">1</span>
                Identificación del Ciudadano
            </h5>

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nombre Completo</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text"
                            wire:model.live="nombre_completo"
                            class="form-control @error('nombre_completo') is-invalid @enderror"
                            placeholder="Nombres y apellidos completos">
                        @error('nombre_completo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label">Tipo de Documento</label>
                    <select wire:model.live="tipo_documento" class="form-select">
                        <option>DNI</option>
                        <option>Carnet Extranjería</option>
                        <option>Pasaporte</option>
                    </select>
                </div>

                <div class="col-12 col-md-7">
                    <label class="form-label">Número de Documento</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                        <input type="tel"
                            wire:model.live="numero_documento"
                            class="form-control @error('numero_documento') is-invalid @enderror"
                            placeholder="Ej: 12345678"
                            maxlength="12">
                        @error('numero_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Domicilio Actual</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                        <input type="text"
                            wire:model.live="domicilio"
                            class="form-control @error('domicilio') is-invalid @enderror"
                            placeholder="Dirección completa">
                        @error('domicilio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Teléfono / Celular</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="tel"
                            wire:model.live="telefono"
                            class="form-control @error('telefono') is-invalid @enderror"
                            maxlength="9"
                            placeholder="999 888 777">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">Correo Electrónico</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email"
                            wire:model.live="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="correo@ejemplo.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN 2: DETALLE DEL RECLAMO --}}
        <div class="mb-4">
            <h5 class="section-title">
                <span class="step-badge">2</span>
                Detalle del Reclamo
            </h5>

            <div class="row g-3">

                {{-- Tipo de registro: cards seleccionables --}}
                <div class="col-12">
                    <label class="form-label d-block mb-2">Tipo de Registro</label>
                    <div class="row g-3">
                        <div class="col-6">
                            <label style="cursor:pointer;display:block;">
                                <input type="radio" wire:model.live="tipo_reclamo" value="reclamo" class="d-none">
                                <div class="rounded-3 border-2 p-3 text-center h-100 position-relative transition"
                                    style="
                                        border: 2px solid {{ $tipo_reclamo == 'reclamo' ? '#135835' : '#e2e8f0' }};
                                        background: {{ $tipo_reclamo == 'reclamo' ? '#f0faf4' : '#fafafa' }};
                                        transition: all 0.2s;
                                    ">
                                    @if($tipo_reclamo == 'reclamo')
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                    @endif
                                    <i class="bi bi-exclamation-circle-fill fs-2 mb-2 d-block
                                        {{ $tipo_reclamo == 'reclamo' ? 'text-success' : 'text-muted opacity-40' }}"></i>
                                    <div class="fw-bold {{ $tipo_reclamo == 'reclamo' ? 'text-success' : 'text-secondary' }}"
                                        style="font-size:0.9rem;">Reclamo</div>
                                    <small class="text-muted d-block mt-1" style="font-size:0.73rem;line-height:1.3;">
                                        Disconformidad con producto o servicio
                                    </small>
                                </div>
                            </label>
                        </div>
                        <div class="col-6">
                            <label style="cursor:pointer;display:block;">
                                <input type="radio" wire:model.live="tipo_reclamo" value="queja" class="d-none">
                                <div class="rounded-3 border-2 p-3 text-center h-100 position-relative"
                                    style="
                                        border: 2px solid {{ $tipo_reclamo == 'queja' ? '#135835' : '#e2e8f0' }};
                                        background: {{ $tipo_reclamo == 'queja' ? '#f0faf4' : '#fafafa' }};
                                        transition: all 0.2s;
                                    ">
                                    @if($tipo_reclamo == 'queja')
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </div>
                                    @endif
                                    <i class="bi bi-person-x-fill fs-2 mb-2 d-block
                                        {{ $tipo_reclamo == 'queja' ? 'text-success' : 'text-muted opacity-40' }}"></i>
                                    <div class="fw-bold {{ $tipo_reclamo == 'queja' ? 'text-success' : 'text-secondary' }}"
                                        style="font-size:0.9rem;">Queja</div>
                                    <small class="text-muted d-block mt-1" style="font-size:0.73rem;line-height:1.3;">
                                        Malestar en la atención al público
                                    </small>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8">
                    <label class="form-label">Bien Contratado</label>
                    <select wire:model.live="tipo_bien" class="form-select">
                        <option value="servicio">Servicio (Trámite, Atención, etc.)</option>
                        <option value="producto">Producto (Bien físico)</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label">Monto Reclamado (S/)</label>
                    <div class="input-group">
                        <span class="input-group-text fw-bold">S/</span>
                        <input type="number" step="0.01" wire:model.live="monto_reclamado"
                            class="form-control" placeholder="0.00">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Descripción del Bien / Servicio</label>
                    <input type="text"
                        wire:model.live="descripcion_bien"
                        class="form-control @error('descripcion_bien') is-invalid @enderror"
                        placeholder="Ej: Trámite de Antecedentes Policiales">
                    @error('descripcion_bien')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Detalle de los Hechos</label>
                    <textarea wire:model.live="detalle"
                        class="form-control @error('detalle') is-invalid @enderror"
                        rows="5"
                        placeholder="Describa detalladamente lo sucedido, indicando fechas, personas involucradas y otros datos relevantes..."></textarea>
                    @error('detalle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Pedido del Ciudadano</label>
                    <textarea wire:model.live="pedido"
                        class="form-control @error('pedido') is-invalid @enderror"
                        rows="3"
                        placeholder="¿Qué solución o respuesta espera?"></textarea>
                    @error('pedido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload de evidencia --}}
                <div class="col-12">
                    <label class="form-label">Adjuntar Evidencia <span class="text-muted fw-normal">(PDF, máx. 5MB — opcional)</span></label>

                    <div class="rounded-3 position-relative text-center"
                        style="border: 2px dashed {{ $evidencia ? '#135835' : '#ced4da' }};
                               background: {{ $evidencia ? '#f0faf4' : '#fafafa' }};
                               padding: 1.5rem;
                               transition: all 0.2s;">

                        @if ($evidencia)
                            <div class="d-flex align-items-center justify-content-center gap-3">
                                <div class="d-flex align-items-center gap-2 text-success fw-semibold">
                                    <i class="bi bi-file-earmark-pdf-fill fs-4"></i>
                                    <span>Archivo PDF seleccionado</span>
                                </div>
                                <button type="button"
                                    wire:click="$set('evidencia', null)"
                                    class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:28px;height:28px;padding:0;"
                                    title="Quitar archivo">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        @else
                            <i class="bi bi-cloud-arrow-up fs-2 text-muted d-block mb-1"></i>
                            <div class="text-muted small">
                                Haga clic o arrastre su archivo PDF aquí
                            </div>
                        @endif

                        <input type="file"
                            wire:model="evidencia"
                            class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                            style="cursor:pointer;"
                            accept="application/pdf">
                    </div>

                    <div wire:loading wire:target="evidencia" class="text-success small mt-2 text-center">
                        <span class="spinner-border spinner-border-sm me-1"></span> Subiendo archivo...
                    </div>
                </div>

            </div>
        </div>

        {{-- BOTÓN DE ENVÍO --}}
        <div class="d-grid mt-4">
            <button type="submit"
                class="btn-pnp"
                wire:loading.attr="disabled">
                <span wire:loading.remove>
                    <i class="bi bi-send-fill me-2"></i>ENVIAR RECLAMO
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm me-2"></span>PROCESANDO...
                </span>
            </button>

            <p class="text-center text-muted mt-3 mb-0" style="font-size:0.78rem;">
                <i class="bi bi-shield-lock-fill me-1" style="color:#135835;"></i>
                Sus datos están protegidos según la Ley N° 29733 de Protección de Datos Personales
            </p>
        </div>

    </form>
    @endif
</div>
