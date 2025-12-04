    @extends('layouts.app')

    @section('title', 'Ver QR - ' . $qrCode->name)

    @section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $qrCode->name }}</h4>
                    <div>
                        <span class="badge {{ $qrCode->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $qrCode->active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div id="qr-code-wrapper" class="border border-2 rounded p-4 mb-4"></div>
                        </div>

                        <div class="col-md-6">
                            <h5>Información del Contenido</h5>

                            <div class="row my-3">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea 
                                            style="height: 150px;"
                                            name="content" 
                                            id="content" 
                                            class="form-control" 
                                            disabled
                                        >{{ $qrCode->content }}</textarea>
                                        <label for="content">Contenido</label>
                                    </div>
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
                                        <strong>Creado:</strong> {{ $qrCode->created_at }}
                                    </p>
                                    <p class="mb-0">
                                        <strong>Actualizado:</strong> {{ $qrCode->updated_at }}
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const QRCode = window.QRCode;
            const qr = <?php echo json_encode($qrCode); ?>;

            // Crear elemento canvas
            const canvas = document.createElement('canvas');
            canvas.width = qr.size || 200;
            canvas.height = qr.size || 200;
            
            const options = {
                color: {
                    dark: qr.color || '#000000',
                    light: qr.background_color || '#FFFFFF'
                },
                width: qr.size || 200,
                height: qr.size || 200,
                margin: 1
            };

            // Generar QR en el canvas
            QRCode.toCanvas(canvas, qr.content, options, function (error) {
                if (error) {
                    console.error('Error generando QR:', error);
                    // Mostrar mensaje de error
                    document.getElementById('qr-code-wrapper').innerHTML = 
                        '<p class="text-danger">Error generando QR</p>';
                    return;
                }
                
                // Agregar el canvas al wrapper
                document.getElementById('qr-code-wrapper').appendChild(canvas);
            });
        });
    </script>
@endpush