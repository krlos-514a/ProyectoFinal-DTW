@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Equipo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Atención!</strong> Hay errores en el formulario:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('equipment.update', $equipment) }}" method="POST" id="formEquipo" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Equipo</label>
            <input type="text" name="name" id="name" value="{{ old('name', $equipment->name) }}"
                   class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="responsible" class="form-label">Responsable</label>
            <input type="text" name="responsible" id="responsible" value="{{ old('responsible', $equipment->responsible) }}"
                   class="form-control @error('responsible') is-invalid @enderror" required>
            @error('responsible')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="delivered_at" class="form-label">Fecha de Entrega</label>
            <input type="date" name="delivered_at" id="delivered_at" value="{{ old('delivered_at', $equipment->delivered_at->format('Y-m-d')) }}"
                   class="form-control @error('delivered_at') is-invalid @enderror" required>
            @error('delivered_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="returned_at" class="form-label">Fecha de Devolución</label>
            <input type="date" name="returned_at" id="returned_at"
                   value="{{ old('returned_at', optional($equipment->returned_at)->format('Y-m-d')) }}"
                   class="form-control @error('returned_at') is-invalid @enderror">
            @error('returned_at')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

