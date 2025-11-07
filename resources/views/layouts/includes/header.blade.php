<header class="bg-body mb-3 p-3 d-flex justify-content-between align-items-center shadow-lg text-small">
    <a 
        href={{ route('qr-codes.index') }} 
        class="btn btn-outline-dark fs-2 d-flex gap-2 align-items-center justify-content-center text-center"
    >
        <i class="bi bi-qr-code"></i>
        <h5 class="m-0">QR-SYS</h5>
    </a>
    
    @include('layouts.includes.navbar')
</header>