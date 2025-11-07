@extends('layouts.app')

@section('title', 'Gestión de QR Codes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Códigos QR</h1>
    <a href="{{ route('qr-codes.create') }}" class="btn btn-primary">Crear Nuevo QR</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Escaneos</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($qrCodes as $qrCode)
            <tr>
                <td>{{ $qrCode->name }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ strtoupper($qrCode->type) }}</span>
                </td>
                <td>{{ $qrCode->scan_count }}</td>
                <td>
                    <span class="badge {{ $qrCode->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $qrCode->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('qr-codes.show', $qrCode->id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Consultar
                        </a>
                        <a href="{{ route('qr-codes.edit', $qrCode->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('qr-codes.destroy', $qrCode->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este QR?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- {{ $qrCodes->links() }} --}}
@endsection