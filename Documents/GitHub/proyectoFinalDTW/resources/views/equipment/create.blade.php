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

    <hr>

    <button type="button" class="btn btn-outline-info mt-3" id="viewHistory">Ver historial</button>
    <button type="button" class="btn btn-outline-danger mt-3" id="clearHistory">Limpiar historial</button>
    <div id="historyContainer" class="mt-3"></div>
</div>

<script>
    // Validación Bootstrap
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

    // Validación adicional y guardar historial en localStorage
    document.getElementById('formEquipo').addEventListener('submit', function(e) {
        let name = document.querySelector('[name="name"]');
        if (!name.value.trim()) {
            e.preventDefault();
            name.classList.add('is-invalid');
            return;
        }

        // Guardar en historial local
        let list = JSON.parse(localStorage.getItem('history')) || [];
        list.push({
            name: name.value.trim(),
            date: new Date().toISOString()
        });
        localStorage.setItem('history', JSON.stringify(list));
    });

    // Mostrar historial
    document.getElementById('viewHistory')?.addEventListener('click', () => {
        const history = JSON.parse(localStorage.getItem('history')) || [];
        const container = document.getElementById('historyContainer');

        if (history.length === 0) {
            container.innerHTML = '<div class="alert alert-warning">No hay historial disponible.</div>';
            return;
        }

        let html = '<ul class="list-group">';
        history.forEach(entry => {
            html += `<li class="list-group-item">${entry.name} – ${new Date(entry.date).toLocaleString()}</li>`;
        });
        html += '</ul>';
        container.innerHTML = html;
    });

    // Limpiar historial
    document.getElementById('clearHistory')?.addEventListener('click', () => {
        localStorage.removeItem('history');
        const container = document.getElementById('historyContainer');
        container.innerHTML = '<div class="alert alert-info">Historial borrado.</div>';
    });
</script>
@endsection
