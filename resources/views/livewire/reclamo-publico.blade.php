<div>
    <style>
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label,
        .form-floating > .form-select ~ label {
            color: var(--pnp-green);
            opacity: 0.8;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
        }
        .form-floating > label {
            padding: 1rem 0.75rem;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(19, 88, 53, 0.15);
            border-color: var(--pnp-green);
        }
        /* Custom Valid/Invalid styling for smoother experience */
        .form-control.is-valid, .was-validated .form-control:valid {
            border-color: #198754;
            padding-right: calc(1.5em + 0.75rem);
            background-image: none; /* Hide default bootstrap icon to use our custom one */
        }
        .form-control.is-invalid, .was-validated .form-control:invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: none;
        }
        
        .validation-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .scale-in { animation: scaleIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        @keyframes scaleIn { from { transform: translateY(-50%) scale(0); } to { transform: translateY(-50%) scale(1); } }
        
        .char-counter {
            font-size: 0.75rem;
            transition: all 0.3s;
            font-weight: 600;
        }
        .text-orange { color: #fd7e14 !important; }
        .bg-orange { background-color: #fd7e14 !important; }
        .border-orange { border-color: #fd7e14 !important; }

        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 0.75rem;
            padding: 2.5rem;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            background-color: #f8f9fa;
        }
        .upload-area:hover, .upload-area.drag-over {
            border-color: var(--pnp-green);
            background-color: rgba(19, 88, 53, 0.08);
            transform: translateY(-2px);
        }
        .upload-area input[type=file] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--pnp-green) 0%, var(--pnp-green-dark) 100%);
            border: none;
            color: white;
            padding: 14px 45px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(19, 88, 53, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }
        .btn-premium:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(19, 88, 53, 0.5);
            filter: brightness(1.1);
        }
        .btn-premium:disabled {
            background: #6c757d;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }
        
        [x-cloak] { display: none !important; }
    </style>

    {{-- Mensaje de Éxito --}}
    <div x-data="{ show: @entangle('mensajeExito') }" x-show="show" x-transition.duration.500ms x-cloak
         class="alert alert-success shadow-lg rounded-4 mb-5 text-center p-5 border-0 bg-white" 
         style="background: linear-gradient(to bottom right, #ffffff, #f0fff4);">
        <div class="mb-3 text-success">
            <i class="bi bi-check-circle-fill display-1 animate__animated animate__bounceIn"></i>
        </div>
        <h2 class="alert-heading fw-bold text-success mb-3">¡Reclamo Registrado con Éxito!</h2>
        <p class="text-muted mb-4 lead">Su reclamo ha sido ingresado correctamente al sistema.</p>
        
        <div class="bg-light p-4 rounded-4 d-inline-block shadow-sm border border-success border-opacity-25 mb-4 position-relative overflow-hidden">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-success opacity-10" style="pointer-events: none;"></div>
            <p class="mb-1 small text-uppercase fw-bold text-muted position-relative">Código de Seguimiento</p>
            <div class="display-5 fw-bold text-pnp position-relative" style="color: var(--pnp-green-dark); letter-spacing: 2px;">{{ $codigoGenerado }}</div>
        </div>
        
        <p class="mb-4 small text-muted">Por favor, guarde este código. Lo necesitará para consultar el estado de su trámite.</p>
        
        <button wire:click="$set('mensajeExito', false)" class="btn btn-outline-success rounded-pill px-4 btn-lg border-2 fw-bold">
            <i class="bi bi-plus-lg me-2"></i> Registrar Nuevo Reclamo
        </button>
    </div>

    {{-- Formulario --}}
    @if (!$mensajeExito)
    <form wire:submit.prevent="guardar" x-data="{ submitted: false }" @submit="submitted = true">
        
        {{-- Sección 1: Identificación --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-3 px-4 border-bottom border-light">
                <h5 class="mb-0 fw-bold text-success d-flex align-items-center">
                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3"><i class="bi bi-person-badge"></i></span>
                    1. Datos de Identificación
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    
                    {{-- Nombre Completo --}}
                    <div class="col-12">
                        <div class="form-floating position-relative">
                            <input type="text" wire:model.live.debounce.500ms="nombre_completo" 
                                   class="form-control rounded-3 pe-5 {{ $nombre_completo && !$errors->has('nombre_completo') ? 'is-valid' : '' }} @error('nombre_completo') is-invalid @enderror" 
                                   id="nombre" placeholder="Nombre Completo">
                            <label for="nombre">Nombre Completo (Apellido paterno, materno y nombres)</label>
                            
                            @if ($nombre_completo && !$errors->has('nombre_completo'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('nombre_completo'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('nombre_completo')
                            <div class="text-danger small mt-1 ms-1" x-transition.opacity.duration.300ms>
                                <i class="bi bi-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Tipo y Numero Documento --}}
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select wire:model.live="tipo_documento" class="form-select rounded-3" id="tipoDoc">
                                <option value="DNI">DNI</option>
                                <option value="CE">Carnet Extranjería</option>
                                <option value="PAS">Pasaporte</option>
                            </select>
                            <label for="tipoDoc">Tipo Documento</label>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-floating position-relative">
                            <input type="tel" wire:model.live.debounce.500ms="numero_documento" 
                                   class="form-control rounded-3 pe-5 {{ $numero_documento && !$errors->has('numero_documento') ? 'is-valid' : '' }} @error('numero_documento') is-invalid @enderror" 
                                   id="numDoc" placeholder="Número" maxlength="12">
                            <label for="numDoc">Número de Documento</label>

                            @if ($numero_documento && !$errors->has('numero_documento'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('numero_documento'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('numero_documento')
                            <div class="text-danger small mt-1 ms-1" x-transition.opacity>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Domicilio --}}
                    <div class="col-12">
                        <div class="form-floating position-relative">
                            <input type="text" wire:model.live.debounce.500ms="domicilio" 
                                   class="form-control rounded-3 pe-5 {{ $domicilio && !$errors->has('domicilio') ? 'is-valid' : '' }} @error('domicilio') is-invalid @enderror" 
                                   id="domicilio" placeholder="Dirección">
                            <label for="domicilio">Domicilio Actual</label>
                            @if ($domicilio && !$errors->has('domicilio'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('domicilio') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating position-relative">
                            <input type="tel" wire:model.live.debounce.500ms="telefono" 
                                   class="form-control rounded-3 pe-5 {{ $telefono && !$errors->has('telefono') ? 'is-valid' : '' }} @error('telefono') is-invalid @enderror" 
                                   id="telefono" placeholder="Teléfono" maxlength="9">
                            <label for="telefono">Teléfono / Celular</label>
                            @if ($telefono && !$errors->has('telefono'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('telefono'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('telefono') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating position-relative">
                            <input type="email" wire:model.live.debounce.500ms="email" 
                                   class="form-control rounded-3 pe-5 {{ $email && !$errors->has('email') ? 'is-valid' : '' }} @error('email') is-invalid @enderror" 
                                   id="email" placeholder="Email">
                            <label for="email">Correo Electrónico</label>
                            @if ($email && !$errors->has('email'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('email'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('email') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección 2: Detalle --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-header bg-white border-0 py-3 px-4 border-bottom border-light">
                <h5 class="mb-0 fw-bold text-success d-flex align-items-center">
                    <span class="bg-success bg-opacity-10 p-2 rounded-circle me-3"><i class="bi bi-file-text"></i></span>
                    2. Detalle del Reclamo
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    
                    <div class="col-md-8">
                        <div class="form-floating">
                            <select wire:model.live="tipo_bien" class="form-select rounded-3" id="bien">
                                <option value="servicio">Servicio (Trámite, atención, etc.)</option>
                                <option value="producto">Producto (Bien físico, infraestructura, etc.)</option>
                            </select>
                            <label for="bien">Bien Contratado</label>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="number" wire:model.live="monto_reclamado" class="form-control rounded-3" id="monto" placeholder="0.00">
                            <label for="monto">Monto Reclamado (S/)</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" wire:model.live.debounce.500ms="descripcion_bien" 
                                   class="form-control rounded-3 {{ $descripcion_bien && !$errors->has('descripcion_bien') ? 'is-valid' : '' }} @error('descripcion_bien') is-invalid @enderror" 
                                   id="descBien" placeholder="Descripción">
                            <label for="descBien">Descripción del Bien (Ej: Trámite de Antecedentes)</label>
                        </div>
                        @error('descripcion_bien') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <div class="d-flex gap-3 justify-content-center bg-light p-3 rounded-3 border">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model.live="tipo_reclamo" id="r1" value="reclamo">
                                <label class="form-check-label fw-bold" for="r1">Reclamo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" wire:model.live="tipo_reclamo" id="r2" value="queja">
                                <label class="form-check-label fw-bold" for="r2">Queja</label>
                            </div>
                        </div>
                    </div>

                    {{-- Detalle con Contador Inteligente (Gris -> Naranja -> Rojo) --}}
                    <div class="col-12" x-data="{ count: 0, max: 1000 }" x-init="$watch('$wire.detalle', value => count = value ? value.length : 0)">
                        <div class="form-floating">
                            <textarea wire:model.live.debounce.500ms="detalle" 
                                      class="form-control rounded-3 @error('detalle') is-invalid @enderror" 
                                      id="detalle" style="height: 120px" maxlength="1000"
                                      @input="count = $el.value.length"></textarea>
                            <label for="detalle">Detalle de los hechos (Explique brevemente lo sucedido)</label>
                        </div>
                        <div class="d-flex justify-content-between mt-1 align-items-center">
                            <div>@error('detalle') <span class="text-danger small ms-1">{{ $message }}</span> @enderror</div>
                            <div class="char-counter badge border rounded-pill px-3 py-1"
                                 :class="{ 
                                    'text-bg-light text-muted border-light': count < max * 0.7,
                                    'text-bg-warning text-white border-warning': count >= max * 0.7 && count < max * 0.9,
                                    'text-bg-danger text-white border-danger': count >= max * 0.9 
                                 }">
                                <span x-text="count"></span> / <span x-text="max"></span> caracteres
                            </div>
                        </div>
                    </div>

                    {{-- Pedido con Contador Inteligente --}}
                    <div class="col-12" x-data="{ count: 0, max: 500 }" x-init="$watch('$wire.pedido', value => count = value ? value.length : 0)">
                        <div class="form-floating">
                            <textarea wire:model.live.debounce.500ms="pedido" 
                                      class="form-control rounded-3 @error('pedido') is-invalid @enderror" 
                                      id="pedido" style="height: 100px" maxlength="500"
                                      @input="count = $el.value.length"></textarea>
                            <label for="pedido">Pedido Concreto (¿Qué solución espera?)</label>
                        </div>
                        <div class="d-flex justify-content-between mt-1 align-items-center">
                            <div>@error('pedido') <span class="text-danger small ms-1">{{ $message }}</span> @enderror</div>
                            <div class="char-counter badge border rounded-pill px-3 py-1"
                                 :class="{ 
                                    'text-bg-light text-muted border-light': count < max * 0.7,
                                    'text-bg-warning text-white border-warning': count >= max * 0.7 && count < max * 0.9,
                                    'text-bg-danger text-white border-danger': count >= max * 0.9 
                                 }">
                                <span x-text="count"></span> / <span x-text="max"></span> caracteres
                            </div>
                        </div>
                    </div>

                    {{-- Carga de Archivos Premium --}}
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold mb-2">Adjuntar Evidencia (Opcional)</label>
                        
                        <div x-data="{ isUploading: false, progress: 0 }" 
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                             
                            @if (!$evidencia)
                                <label class="upload-area d-block w-100 shadow-sm" :class="{ 'opacity-50': isUploading }">
                                    <input type="file" wire:model="evidencia" accept="application/pdf">
                                    <div class="text-muted">
                                        <div class="mb-3">
                                            <i class="bi bi-cloud-arrow-up display-3 text-success opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">Arrastre su archivo PDF aquí o haga clic</h6>
                                        <p class="small text-secondary mb-0">Máximo 5MB</p>
                                    </div>
                                    
                                    <!-- Progress Bar Overlay -->
                                    <div x-show="isUploading" class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-90 d-flex flex-column justify-content-center align-items-center rounded-3" style="z-index: 10;">
                                        <div class="spinner-border text-success mb-2" role="status"></div>
                                        <span class="fw-bold text-success mb-2">Subiendo... <span x-text="progress + '%'"></span></span>
                                        <div class="progress w-50" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" :style="'width: ' + progress + '%'"></div>
                                        </div>
                                    </div>
                                </label>
                            @else
                                <div class="alert alert-light border border-success border-opacity-25 d-flex align-items-center justify-content-between shadow-sm rounded-3 fade show p-3" style="background-color: #f0fff4;">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white p-2 rounded shadow-sm me-3 text-danger">
                                            <i class="bi bi-file-earmark-pdf-fill fs-2"></i>
                                        </div>
                                        <div class="text-truncate" style="max-width: 250px;">
                                            <h6 class="fw-bold text-dark mb-0 text-truncate">{{ $evidencia->getClientOriginalName() }}</h6>
                                            <span class="small text-muted">{{ round($evidencia->getSize() / 1024, 2) }} KB</span>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="removeFile" class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px;" title="Eliminar archivo">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            @endif
                            
                            @error('evidencia') <div class="text-danger small mt-2 fw-bold"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Botón de Envío Premium --}}
        <div class="text-center mt-5 mb-5">
            <button type="submit" class="btn-premium btn-lg shadow-lg" wire:loading.attr="disabled" :disabled="submitted">
                <span wire:loading.remove>
                    <i class="bi bi-send-check-fill me-2"></i> Enviar Reclamo Seguro
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Procesando envío...
                </span>
            </button>
            <div class="mt-3">
                <small class="text-muted d-flex justify-content-center align-items-center">
                    <i class="bi bi-shield-check me-2 text-success"></i>
                    Sus datos son enviados de forma segura y encriptada.
                </small>
            </div>
        </div>

    </form>
    @endif
</div> 