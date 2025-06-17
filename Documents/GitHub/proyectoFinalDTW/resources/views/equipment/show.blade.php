@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Equipo: {{ $equipment->name }}</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre del Equipo:</strong> {{ $equipment->name }}</p>
            <p><strong>Responsable:</strong> {{ $equipment->responsible }}</p>
            <p><strong>Fecha de Entrega:</strong> {{ $equipment->delivered_at ? $equipment->delivered_at->format('Y-m-d') : '-' }}</p>
            <p><strong>Fecha de Devolución:</strong> {{ $equipment->returned_at ? $equipment->returned_at->format('Y-m-d') : '-' }}</p>
        </div>
    </div>

    <a href="{{ route('equipment.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
</div>
@endsection
