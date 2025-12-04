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

                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $qrCode->name) }}" 
                            placeholder="Nombre del QR" 
                            required
                        >
                        <label for="name">Nombre del QR</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea 
                            class="form-control @error('content') is-invalid @enderror" 
                            id="content" 
                            name="content" 
                            style="height: 100px" 
                            placeholder="Contenido del QR" 
                            required
                        >{{ old('content', $qrCode->content) }}</textarea>
                        <label for="content">Contenido</label>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="color" class="form-label">Color del QR</label>
                            <input type="color" class="form-control form-control-color w-100" 
                                   id="color" name="color" value="{{ old('color', $qrCode->color ?? '#000000') }}" title="Elige el color del QR">
                        </div>
                        <div class="col-md-4">
                            <label for="background_color" class="form-label">Color de Fondo</label>
                            <input type="color" class="form-control form-control-color w-100" 
                                   id="background_color" name="background_color" value="{{ old('background_color', $qrCode->background_color ?? '#FFFFFF') }}" title="Elige el color de fondo">
                        </div>
                        <div class="col-md-4">
                            <label for="size" class="form-label">Tamaño (px)</label>
                            <input type="number" class="form-control" id="size" name="size" 
                                   value="{{ old('size', $qrCode->size ?? 200) }}" min="100" max="500">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="active" name="active" 
                                   value="1" {{ old('active', $qrCode->active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">QR Activo</label>
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
                        <p><strong>Escaneos totales:</strong> {{ $qrCode->scans }}</p>
                        <p><strong>Creado:</strong> {{ $qrCode->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Última actualización:</strong> {{ $qrCode->updated_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Estado:</strong>
                            <span class="badge {{ $qrCode->active ? 'bg-success' : 'bg-danger' }}">
                                {{ $qrCode->active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection