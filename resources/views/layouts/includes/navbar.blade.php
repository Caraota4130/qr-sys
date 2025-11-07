<ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
    <li>
        <a 
            href="{{ route('qr-codes.index') }}" 
            class="nav-link @if( request()->routeIs('qr-codes.index') ) text-primary @else text-dark @endif"
        >
            <i class="bi d-block mx-auto text-center fs-4 bi-list-ul"></i>
            <span class="fw-bold fs-6 m-0">Listado de QRs</span>
        </a>
    </li>

    {{-- <div class="vr ms-3"></div>

    <li>
        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="bi d-block mx-auto mb-1 bi-circle-half text-center fs-4"></i>
            Tema
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <button class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
                <i class="bi me-2 mb-1 bi-circle-half"></i>
                Auto
            </button>
            <button class="dropdown-item" data-bs-theme-value="light" aria-pressed="false">
                <i class="bi me-2 mb-1 bi-sun-fill"></i>
                Claro
            </button>
            <button class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                <i class="bi me-2 mb-1 bi-moon-stars-fill"></i>
                Oscuro
            </button>
        </div>
    </li> --}}
</ul>