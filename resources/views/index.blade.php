@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="card mb-3">
        <div class="card-header">Header</div>
        <div class="card-body">
        <h5 class="card-title">Dark card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
        <div class="form-floating">
            <input type="text" name="" id="" class="form-control">
        </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite([])
@endpush