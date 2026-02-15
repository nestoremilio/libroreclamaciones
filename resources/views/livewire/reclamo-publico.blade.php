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
            transition: color 0.3s;
        }
        
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }
        .upload-area:hover, .upload-area.drag-over {
            border-color: var(--pnp-green);
            background-color: rgba(19, 88, 53, 0.05);
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
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(19, 88, 53, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-premium:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(19, 88, 53, 0.4);
            filter: brightness(1.1);
        }
        .btn-premium:disabled {
            background: #6c757d;
            box-shadow: none;
            cursor: not-allowed;
        }
        
        /* Smooth fade for alerts */
        [x-cloak] { display: none !important; }
    </style>

    {{-- Mensaje de Éxito --}}
    <div x-data="{ show: @entangle('mensajeExito') }" x-show="show" x-transition.duration.500ms x-cloak
         class="alert alert-success shadow-lg rounded-4 mb-5 text-center p-5 border-0 bg-white" style="background: linear-gradient(to bottom right, #ffffff, #f0fff4);">
        <div class="mb-3 text-success">
            <i class="bi bi-check-circle-fill display-1"></i>
        </div>
        <h2 class="alert-heading fw-bold text-success mb-3">¡Reclamo Registrado con Éxito!</h2>
        <p class="text-muted mb-4">Su reclamo ha sido ingresado correctamente al sistema.</p>
        
        <div class="bg-light p-4 rounded-3 d-inline-block shadow-sm border border-success border-opacity-25 mb-4">
            <p class="mb-1 small text-uppercase fw-bold text-muted">Código de Seguimiento</p>
            <div class="display-6 fw-bold text-dark code-font">{{ $codigoGenerado }}</div>
        </div>
        
        <p class="mb-4 small text-muted">Por favor, guarde este código. Lo necesitará para consultar el estado de su trámite.</p>
        
        <button wire:click="$set('mensajeExito', false)" class="btn btn-outline-success rounded-pill px-4 btn-lg">
            <i class="bi bi-plus-lg me-2"></i> Registrar Nuevo Reclamo
        </button>
    </div>

    {{-- Formulario --}}
    @if (!$mensajeExito)
    <form wire:submit.prevent="guardar" x-data="{ submitted: false }" @submit="submitted = true">
        
        {{-- Sección 1: Identificación --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-3 px-4">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="bi bi-person-badge me-2"></i> 1. Datos de Identificación
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    
                    {{-- Nombre Completo con Validación Visual --}}
                    <div class="col-12" x-data="{ focused: false }">
                        <div class="form-floating position-relative">
                            <input type="text" wire:model.live.debounce.500ms="nombre_completo" 
                                   class="form-control rounded-3 pe-5 @error('nombre_completo') is-invalid @enderror" 
                                   id="nombre" placeholder="Nombre Completo"
                                   @focus="focused = true" @blur="focused = false">
                            <label for="nombre">Nombre Completo (Apellido paterno, materno y nombres)</label>
                            
                            {{-- Iconos de Estado --}}
                            @if ($nombre_completo && !$errors->has('nombre_completo'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('nombre_completo'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('nombre_completo')
                            <div class="text-danger small mt-1 ms-1 fade-in-up" x-transition>
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
                                   class="form-control rounded-3 pe-5 @error('numero_documento') is-invalid @enderror" 
                                   id="numDoc" placeholder="Número" maxlength="12">
                            <label for="numDoc">Número de Documento</label>

                            @if ($numero_documento && !$errors->has('numero_documento'))
                                <i class="bi bi-check-circle-fill text-success fs-4 validation-icon scale-in"></i>
                            @elseif ($errors->has('numero_documento'))
                                <i class="bi bi-exclamation-circle-fill text-danger fs-4 validation-icon scale-in"></i>
                            @endif
                        </div>
                        @error('numero_documento')
                            <div class="text-danger small mt-1 ms-1" x-transition>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contacto --}}
                    <div class="col-12">
                        <div class="form-floating position-relative">
                            <input type="text" wire:model.live.debounce.500ms="domicilio" 
                                   class="form-control rounded-3 @error('domicilio') is-invalid @enderror" 
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
                                   class="form-control rounded-3 pe-5 @error('telefono') is-invalid @enderror" 
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
                                   class="form-control rounded-3 pe-5 @error('email') is-invalid @enderror" 
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
            <div class="card-header bg-white border-0 py-3 px-4">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="bi bi-file-text me-2"></i> 2. Detalle del Reclamo
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
                                   class="form-control rounded-3 @error('descripcion_bien') is-invalid @enderror" 
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

                    {{-- Detalle con Contador --}}
                    <div class="col-12" x-data="{ count: 0, max: 1000 }" x-init="$watch('$wire.detalle', value => count = value ? value.length : 0)">
                        <div class="form-floating">
                            <textarea wire:model.live.debounce.500ms="detalle" 
                                      class="form-control rounded-3 @error('detalle') is-invalid @enderror" 
                                      id="detalle" style="height: 120px" maxlength="1000"
                                      @input="count = $el.value.length"></textarea>
                            <label for="detalle">Detalle de los hechos (Explique brevemente lo sucedido)</label>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div>@error('detalle') <span class="text-danger small ms-1">{{ $message }}</span> @enderror</div>
                            <div class="char-counter badge bg-light text-dark border"
                                 :class="{ 'text-danger border-danger': count >= max * 0.9, 'text-muted': count < max * 0.9 }">
                                <span x-text="count"></span> / <span x-text="max"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Pedido con Contador --}}
                    <div class="col-12" x-data="{ count: 0, max: 500 }" x-init="$watch('$wire.pedido', value => count = value ? value.length : 0)">
                        <div class="form-floating">
                            <textarea wire:model.live.debounce.500ms="pedido" 
                                      class="form-control rounded-3 @error('pedido') is-invalid @enderror" 
                                      id="pedido" style="height: 100px" maxlength="500"
                                      @input="count = $el.value.length"></textarea>
                            <label for="pedido">Pedido Concreto (¿Qué solución espera?)</label>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div>@error('pedido') <span class="text-danger small ms-1">{{ $message }}</span> @enderror</div>
                            <div class="char-counter badge bg-light text-dark border"
                                 :class="{ 'text-danger border-danger': count >= max * 0.9, 'text-muted': count < max * 0.9 }">
                                <span x-text="count"></span> / <span x-text="max"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Carga de Archivos Personalizada --}}
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Adjuntar Evidencia (Opcional)</label>
                        
                        <div x-data="{ isUploading: false, progress: 0 }" 
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress">
                             
                            @if (!$evidencia)
                                <label class="upload-area d-block w-100" :class="{ 'opacity-50': isUploading }">
                                    <input type="file" wire:model="evidencia" accept="application/pdf">
                                    <div class="text-muted">
                                        <i class="bi bi-cloud-arrow-up display-4 text-success mb-2"></i>
                                        <p class="mb-1 fw-bold text-dark">Haga clic o arrastre su archivo aquí</p>
                                        <p class="small mb-0">Solo formato PDF (Máx. 5MB)</p>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div x-show="isUploading" class="progress mt-3" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                             :style="'width: ' + progress + '%'"></div>
                                    </div>
                                </label>
                            @else
                                <div class="alert alert-light border d-flex align-items-center justify-content-between shadow-sm rounded-3 fade show">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-3"></i>
                                        <div class="text-truncate" style="max-width: 250px;">
                                            <span class="fw-bold text-dark d-block text-truncate">{{ $evidencia->getClientOriginalName() }}</span>
                                            <span class="small text-muted">{{ round($evidencia->getSize() / 1024, 2) }} KB</span>
                                        </div>
                                    </div>
                                    <button type="button" wire:click="removeFile" class="btn btn-outline-danger btn-sm rounded-circle" title="Eliminar archivo">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            @endif
                            
                            @error('evidencia') <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div> @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Botón de Envío Premium --}}
        <div class="text-center mt-5 mb-4">
            <button type="submit" class="btn-premium btn-lg" wire:loading.attr="disabled" :disabled="submitted">
                <span wire:loading.remove>
                    <i class="bi bi-send-fill me-2"></i> Enviar Reclamo
                </span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Procesando...
                </span>
            </button>
            <p class="text-muted small mt-3">
                <i class="bi bi-shield-lock-fill"></i> Sus datos serán tratados conforme a la Ley de Protección de Datos Personales.
            </p>
        </div>

    </form>
    @endif
</div> 