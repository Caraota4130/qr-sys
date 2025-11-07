@extends('layouts.app')

@section('title', 'Ver QR - ' . $qrCode->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $qrCode->name }}</h4>
                <div>
                    <span class="badge {{ $qrCode->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $qrCode->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                    <span class="badge bg-info text-dark">{{ strtoupper($qrCode->type) }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Simulación del QR -->
                    <div class="col-md-6 text-center">
                        <div class="border rounded p-4 mb-4" style="background-color: {{ $qrCode->background_color ?? '#FFFFFF' }};">
                            <div class="mb-3">
                                <i class="fas fa-qrcode" style="font-size: {{ $qrCode->size ?? 200 }}px; color: {{ $qrCode->color ?? '#000000' }};"></i>
                            </div>
                            <p class="text-muted small">[Código QR generado]</p>
                        </div>
                        <p class="text-muted">
                            <i class="fas fa-eye"></i> 
                            {{ $qrCode->scan_count }} escaneos
                        </p>
                    </div>

                    <!-- Información del QR -->
                    <div class="col-md-6">
                        <h5>Información del Contenido</h5>
                        <div class="mb-3">
                            <strong>Tipo:</strong> 
                            <span class="text-capitalize">{{ $qrCode->type }}</span>
                        </div>

                        <div class="mb-3">
                            <strong>Contenido:</strong>
                            <div class="mt-1 p-2 bg-light rounded">
                                @if($qrCode->type === 'url')
                                    <a href="{{ $qrCode->content }}" target="_blank" class="text-break">
                                        {{ $qrCode->content }}
                                    </a>
                                @elseif($qrCode->type === 'email')
                                    <a href="mailto:{{ $qrCode->content }}">
                                        {{ $qrCode->content }}
                                    </a>
                                @elseif($qrCode->type === 'phone')
                                    <a href="tel:{{ $qrCode->content }}">
                                        {{ $qrCode->content }}
                                    </a>
                                @else
                                    <pre class="mb-0"><code>{{ $qrCode->content }}</code></pre>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Configuración de diseño:</strong>
                            <div class="mt-1">
                                <span class="badge bg-secondary">
                                    Color: {{ $qrCode->color ?? '#000000' }}
                                </span>
                                <span class="badge bg-secondary">
                                    Fondo: {{ $qrCode->background_color ?? '#FFFFFF' }}
                                </span>
                                <span class="badge bg-secondary">
                                    Tamaño: {{ $qrCode->size ?? 200 }}px
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Metadatos</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-1">
                                    <strong>ID:</strong> {{ $qrCode->id }}
                                </p>
                                <p class="mb-1">
                                    <strong>Creado:</strong> {{ $qrCode->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="mb-0">
                                    <strong>Actualizado:</strong> {{ $qrCode->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Acciones</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('qr-codes.edit', $qrCode->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i> Editar QR
                                    </a>
                                    <form action="{{ route('qr-codes.destroy', $qrCode->id) }}" method="POST" class="d-grid">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                onclick="return confirm('¿Estás seguro de eliminar este QR?')">
                                            <i class="fas fa-trash"></i> Eliminar QR
                                        </button>
                                    </form>
                                    <a href="{{ route('qr-codes.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left"></i> Volver a la lista
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pre {
    white-space: pre-wrap;
    word-wrap: break-word;
}
.text-break {
    word-break: break-all;
}
</style>
@endsection