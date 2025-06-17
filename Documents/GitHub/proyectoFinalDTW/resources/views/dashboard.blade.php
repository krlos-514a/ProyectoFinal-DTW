@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Inicio</h1>

    @role('admin')
        <div class="alert alert-primary">
            <h5>Hola Administrador, {{ Auth::user()->name }} 👑</h5>
            <p>Tienes acceso total al sistema, incluyendo la gestión de equipos y usuarios.</p>
            <a href="{{ route('equipos.index') }}" class="btn btn-primary">Ver Equipos</a>
        </div>
    @elserole('user')
        <div class="alert alert-info">
            <h5>Bienvenido Usuario, {{ Auth::user()->name }}</h5>
            <p>Puedes consultar los equipos asignados o registrados en el sistema.</p>
            <a href="{{ route('equipos.index') }}" class="btn btn-info">Ir a Equipos</a>
        </div>
    @else
        <div class="alert alert-secondary">
            <h5>Hola {{ Auth::user()->name }}</h5>
            <p>No tienes roles asignados aún. Contacta al administrador del sistema.</p>
        </div>
    @endrole

    <hr>

    <div class="mt-4">
        <h5>Última conexión</h5>
        <p id="lastSession"></p>
    </div>

    <script>
        // Guardar y mostrar fecha de última visita usando localStorage
        const last = localStorage.getItem('lastLogin');
        document.getElementById('lastSession').innerText = last ? `Tu última sesión fue: ${new Date(last).toLocaleString()}` : 'Es tu primera visita.';
        localStorage.setItem('lastLogin', new Date().toISOString());
    </script>
</div>
@endsection


