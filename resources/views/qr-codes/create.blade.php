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

                    <div class="form-floating mb-3">
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            placeholder="Ej: QR para página web" 
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
                        >{{ old('content') }}</textarea>
                        <label for="content">Contenido</label>
                        <div class="form-text">
                            <small class="text-muted">Ingresa el contenido del QR (URL, texto, etc.)</small>
                        </div>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="color" class="form-label">Color del QR</label>
                            <input type="color" class="form-control form-control-color w-100" 
                                   id="color" name="color" value="{{ old('color', '#000000') }}" title="Elige el color del QR">
                        </div>
                        <div class="col-md-4">
                            <label for="background_color" class="form-label">Color de Fondo</label>
                            <input type="color" class="form-control form-control-color w-100" 
                                   id="background_color" name="background_color" value="{{ old('background_color', '#FFFFFF') }}" title="Elige el color de fondo">
                        </div>
                        <div class="col-md-4">
                            <label for="size" class="form-label">Tamaño (px)</label>
                            <input type="number" class="form-control" id="size" name="size" 
                                   value="{{ old('size', 200) }}" min="100" max="500">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="active" name="active" 
                                   value="1" {{ old('active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">QR Activo</label>
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
@endsection