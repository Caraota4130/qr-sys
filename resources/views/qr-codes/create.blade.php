@extends('layouts.app')

@section('title', 'Crear Nuevo QR')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Crear Nuevo Código QR</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('qr-codes.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del QR *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Ej: QR para página web" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo de QR *</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="url" {{ old('type') == 'url' ? 'selected' : '' }}>URL</option>
                            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Texto</option>
                            <option value="email" {{ old('type') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="wifi" {{ old('type') == 'wifi' ? 'selected' : '' }}>WiFi</option>
                            <option value="vcard" {{ old('type') == 'vcard' ? 'selected' : '' }}>Tarjeta de Contacto</option>
                            <option value="sms" {{ old('type') == 'sms' ? 'selected' : '' }}>SMS</option>
                            <option value="phone" {{ old('type') == 'phone' ? 'selected' : '' }}>Teléfono</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido *</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="3" 
                                  placeholder="Ingresa el contenido según el tipo seleccionado" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small id="contentHelp" class="text-muted"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="color" class="form-label">Color del QR</label>
                                <input type="color" class="form-control form-control-color" 
                                       id="color" name="color" value="{{ old('color', '#000000') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="background_color" class="form-label">Color de fondo</label>
                                <input type="color" class="form-control form-control-color" 
                                       id="background_color" name="background_color" 
                                       value="{{ old('background_color', '#FFFFFF') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="size" class="form-label">Tamaño (px)</label>
                                <input type="number" class="form-control" id="size" name="size" 
                                       value="{{ old('size', 200) }}" min="100" max="500">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">QR Activo</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('qr-codes.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Crear QR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const contentTextarea = document.getElementById('content');
    const contentHelp = document.getElementById('contentHelp');
    
    const contentExamples = {
        'url': {
            'content': 'https://ejemplo.com',
            'help': 'Ingresa una URL completa incluyendo https://'
        },
        'text': {
            'content': 'Este es un texto de ejemplo para el código QR',
            'help': 'Ingresa el texto que quieres que muestre el QR'
        },
        'email': {
            'content': 'correo@ejemplo.com',
            'help': 'Ingresa una dirección de correo electrónico'
        },
        'wifi': {
            'content': '{"ssid": "MiRedWifi", "password": "miPassword123", "encryption": "WPA"}',
            'help': 'Ingresa configuración WiFi en formato JSON: ssid, password y encryption'
        },
        'vcard': {
            'content': '{"name": "Juan Pérez", "phone": "+123456789", "email": "juan@ejemplo.com"}',
            'help': 'Ingresa datos de contacto en formato JSON: name, phone, email, company, etc.'
        },
        'sms': {
            'content': '{"number": "+123456789", "message": "Hola, me contacto desde el QR"}',
            'help': 'Ingresa número y mensaje en formato JSON'
        },
        'phone': {
            'content': '+123456789',
            'help': 'Ingresa un número de teléfono con código de país'
        }
    };

    function updateContentExample() {
        const selectedType = typeSelect.value;
        if (contentExamples[selectedType]) {
            if (!contentTextarea.value) {
                contentTextarea.value = contentExamples[selectedType].content;
            }
            contentHelp.textContent = contentExamples[selectedType].help;
        } else {
            contentHelp.textContent = 'Ingresa el contenido para el QR';
        }
    }

    typeSelect.addEventListener('change', updateContentExample);
    
    // Ejecutar al cargar la página si ya hay un tipo seleccionado
    updateContentExample();
});
</script>
@endsection