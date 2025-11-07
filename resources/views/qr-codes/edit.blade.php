@extends('layouts.app')

@section('title', 'Editar QR - ' . $qrCode->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Editar QR: {{ $qrCode->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('qr-codes.update', $qrCode->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del QR *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $qrCode->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de QR *</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="url" {{ old('type', $qrCode->type) == 'url' ? 'selected' : '' }}>URL</option>
                            <option value="text" {{ old('type', $qrCode->type) == 'text' ? 'selected' : '' }}>Texto</option>
                            <option value="email" {{ old('type', $qrCode->type) == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="wifi" {{ old('type', $qrCode->type) == 'wifi' ? 'selected' : '' }}>WiFi</option>
                            <option value="vcard" {{ old('type', $qrCode->type) == 'vcard' ? 'selected' : '' }}>Tarjeta de Contacto</option>
                            <option value="sms" {{ old('type', $qrCode->type) == 'sms' ? 'selected' : '' }}>SMS</option>
                            <option value="phone" {{ old('type', $qrCode->type) == 'phone' ? 'selected' : '' }}>Teléfono</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido *</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="3" 
                                  placeholder="Ingresa el contenido según el tipo seleccionado" required>{{ old('content', is_array($qrCode->content) ? ($qrCode->content['data'] ?? json_encode($qrCode->content, JSON_PRETTY_PRINT)) : $qrCode->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>
                                <strong>Ejemplos:</strong><br>
                                URL: https://ejemplo.com<br>
                                Email: correo@ejemplo.com<br>
                                WiFi: {"ssid": "MiRed", "password": "123456", "encryption": "WPA"}<br>
                                VCard: {"name": "Juan Pérez", "phone": "+123456789", "email": "juan@ejemplo.com"}
                            </small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="color" class="form-label">Color del QR</label>
                                <input type="color" class="form-control form-control-color" 
                                       id="color" name="color" value="{{ old('color', $qrCode->color ?? '#000000') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="background_color" class="form-label">Color de fondo</label>
                                <input type="color" class="form-control form-control-color" 
                                       id="background_color" name="background_color" 
                                       value="{{ old('background_color', $qrCode->background_color ?? '#FFFFFF') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="size" class="form-label">Tamaño (px)</label>
                                <input type="number" class="form-control" id="size" name="size" 
                                       value="{{ old('size', $qrCode->size ?? 200) }}" min="100" max="500">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', $qrCode->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">QR Activo</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('qr-codes.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar QR</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información adicional -->
        <div class="card mt-4">
            <div class="card-header">
                <h6>Información del QR</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Escaneos totales:</strong> {{ $qrCode->scan_count }}</p>
                        <p><strong>Creado:</strong> {{ $qrCode->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Última actualización:</strong> {{ $qrCode->updated_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Estado:</strong>
                            <span class="badge {{ $qrCode->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $qrCode->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const contentTextarea = document.getElementById('content');
    
    // Ejemplos de contenido según el tipo
    const contentExamples = {
        'url': 'https://ejemplo.com',
        'text': 'Este es un texto de ejemplo para el código QR',
        'email': 'correo@ejemplo.com',
        'wifi': '{"ssid": "MiRedWifi", "password": "miPassword123", "encryption": "WPA"}',
        'vcard': '{"name": "Juan Pérez", "phone": "+123456789", "email": "juan@ejemplo.com", "company": "Mi Empresa"}',
        'sms': '{"number": "+123456789", "message": "Hola, me contacto desde el QR"}',
        'phone': '+123456789'
    };

    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;
        if (contentExamples[selectedType] && !contentTextarea.value) {
            contentTextarea.value = contentExamples[selectedType];
        }
    });
});
</script>
@endsection