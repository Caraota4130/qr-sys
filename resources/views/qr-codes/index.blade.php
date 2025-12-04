@extends('layouts.app')

@section('title', 'Gestión de QR Codes')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card w-75 bg-body-secondary rounded-3 border p-0 border-2 shadow">
        <div class="card-header p-3 d-flex justify-content-between align-items-center">
            <h3 class="card-title">Gestión de QR Codes</h3>
            <a href="{{ route('qr-codes.create') }}" class="btn btn-primary">Crear QR Code</a>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="qr-codes-table" class="table display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este código QR? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite([
        'resources/js/qr-codes/table.js',
    ])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const qrCodeId = button.getAttribute('data-id');
                deleteForm.action = `/qr-codes/${qrCodeId}`;
            });
        });
    </script>
@endpush