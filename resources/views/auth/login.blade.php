@extends('layouts.app')

@section('title', 'Inicio de sesión')

@section('content') 

<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card w-25 bg-body-secondary rounded-3 border p-0 border-2 shadow">
        <div class="card-header d-flex justify-content-center align-items-center gap-2">
            <i class="bi bi-qr-code fs-4"></i>
            <h3 class="text-center m-0">Inicio de sesión</h3>
        </div>
        <div class="card-body p-4">
            <form method="POST" class="needs-validation" novalidate action="{{ route('login') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                id="name" 
                                type="text" 
                                class="form-control 
                                @error('name') is-invalid @enderror" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                placeholder="Nombre de usuario"
                            >
                            <label for="name">Nombre de usuario</label>
                            <div class="invalid-feedback">
                                @error('name')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-control 
                                @error('password') is-invalid @enderror" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="Contraseña"
                            >
                            <label for="password">Contraseña</label>
                            <div class="invalid-feedback">
                                @error('password')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col d-flex justify-content-center align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-start d-none">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Recuperar contraseña
                            </a>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center gap-2">
                        <button type="submit" class="btn btn-primary">
                            Iniciar sesión
                        </button>

                        <a class="btn btn-secondary" href="{{ route('register') }}">
                            ¿No tienes una cuenta?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection