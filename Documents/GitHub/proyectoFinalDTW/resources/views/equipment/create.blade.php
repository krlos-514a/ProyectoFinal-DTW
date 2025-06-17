@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Equipo</h1>

    <form action="{{ route('equipment.store') }}" method="POST" id="formEquipo" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Equipo</label>
            <input type="text" name="name" id="name" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="responsible" class="form-label">Responsable</label>
            <input type="text" name="responsible" id="responsible" 
                   class="form-control @error('responsible') is-invalid @enderror" 
                   value="{{ old('responsible') }}" required>
            @error('responsible')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivered_at" class="form-label">Fecha de Entrega</label>
            <input type="date" name="delivered_at" id="delivered_at" 
                   class="form-control @error('delivered_at') is-invalid @enderror" 
                   value="{{ old('delivered_at') }}" required>
            @error('delivered_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="returned_at" class="form-label">Fecha de Devolución</label>
            <input type="date" name="returned_at" id="returned_at" 
                   class="form-control @error('returned_at') is-invalid @enderror" 
                   value="{{ old('returned_at') }}">
            @error('returned_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    <script>
        // Validación simple para que el campo 'name' no esté vacío
        document.getElementById('formEquipo').addEventListener('submit', function(e) {
            let name = document.querySelector('[name="name"]');
            if (!name.value.trim()) {
                e.preventDefault();
                name.classList.add('is-invalid');
            }
        });
    </script>
</div>

<script>
    // Validación de Bootstrap para el formulario
    (() => {
        'use strict'
        const form = document.querySelector('#formEquipo');
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    })();
</script>
@endsection
