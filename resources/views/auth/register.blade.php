@extends('layouts.app')

@section('title', 'Registro')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="card w-50 bg-body-secondary rounded-3 border p-0 border-2 shadow">
        <div class="card-header d-flex justify-content-center align-items-center gap-2">
            <i class="bi bi-person-plus-fill fs-4"></i>
            <h3 class="text-center m-0">Registro</h3>
        </div>
        <div class="card-body p-4">
            <form method="POST" class="needs-validation" novalidate action="{{ route('register') }}">
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
                                placeholder="Nombre"
                            >
                            <label for="name">Nombre</label>
                            <div class="invalid-feedback">
                                @error('name')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input 
                                id="email" 
                                type="email" 
                                class="form-control 
                                @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                placeholder="Correo electrónico"
                            >
                            <label for="email">Correo electrónico</label>
                            <div class="invalid-feedback">
                                @error('email')
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
                                autocomplete="new-password"
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

                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                class="form-control 
                                @error('password_confirmation') is-invalid @enderror" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="Confirmar contraseña"
                            >
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <div class="invalid-feedback">
                                @error('password_confirmation')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-0">
                    <div class="col d-flex justify-content-center align-items-center gap-2">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>

                        <a class="btn btn-secondary" href="{{ route('login') }}">
                            ¿Ya tienes una cuenta?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection