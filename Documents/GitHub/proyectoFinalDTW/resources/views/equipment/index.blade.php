@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Equipos Tecnológicos</h1>

    @can('equipment.create')
    <a href="{{ route('equipos.create') }}" class="btn btn-primary mb-3">Agregar Equipo</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre del Equipo</th>
                <th>Responsable</th>
                <th>Fecha de Entrega</th>
                <th>Fecha de Devolución</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipos as $equipment)
            <tr>
                <td>{{ $equipment->name }}</td>
                <td>{{ $equipment->responsible }}</td>
                <td>{{ $equipment->delivered_at->format('Y-m-d') }}</td>
                <td>{{ $equipment->returned_at ? $equipment->returned_at->format('Y-m-d') : '-' }}</td>
                <td>
                    @can('equipment.view')
                    <a href="{{ route('equipment.show', $equipment) }}" class="btn btn-info btn-sm">Ver</a>
                    @endcan

                    @can('equipment.edit')
                    <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning btn-sm">Editar</a>
                    @endcan

                    @can('equipment.delete')
                    <form action="{{ route('equipment.destroy', $equipment) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres eliminar este equipo?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No hay equipos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $equipos->links() }}

    <hr>

    {{-- Botones y contenedores para historial y clima --}}
    <div class="mb-4">
        <button id="clearHistory" class="btn btn-secondary">Limpiar Historial</button>
    </div>

    <h4>Historial breve de equipos:</h4>
    <ul id="historyList" class="list-group mb-4"></ul>

    <h4>Consulta el clima actual en San Salvador:</h4>
    <button id="getWeather" class="btn btn-info mb-3">Mostrar Clima</button>
    <div id="climaContainer" class="mt-3"></div>    
</div>

<script>
    // Función para mostrar alertas temporales
    function showMessage(msg, type = 'success') {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} mt-2`;
        alert.innerText = msg;
        document.body.prepend(alert);
        setTimeout(() => alert.remove(), 3000);
    }

    // Cargar historial desde localStorage y mostrarlo en la lista
    function loadHistory() {
        const history = JSON.parse(localStorage.getItem('history')) || [];
        const list = document.getElementById('historyList');
        list.innerHTML = '';

        if(history.length === 0) {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerText = 'No hay historial registrado.';
            list.appendChild(li);
            return;
        }

        history.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = `${item.name} - ${new Date(item.date).toLocaleString()}`;
            list.appendChild(li);
        });
    }

    // Limpiar historial al hacer clic
    document.getElementById('clearHistory').addEventListener('click', () => {
        localStorage.removeItem('history');
        loadHistory();
        showMessage('Historial borrado correctamente', 'warning');
    });

    // Guardar equipos actuales en historial localStorage al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
        loadHistory();

        // Ejemplo: Guarda los equipos visibles en el historial
        const equipos = @json($equipos->pluck('name'));
        let history = JSON.parse(localStorage.getItem('history')) || [];

        equipos.forEach(name => {
            // Evitar duplicados guardando solo si no existe el mismo nombre reciente
            if (!history.some(item => item.name === name)) {
                history.push({ name: name, date: new Date().toISOString() });
            }
        });

        localStorage.setItem('history', JSON.stringify(history));
        loadHistory();
    });

    // Mostrar clima con fetch y OpenWeatherMap API
    document.getElementById('getWeather').addEventListener('click', async () => {
        const contenedor = document.getElementById('climaContainer');
        contenedor.innerHTML = 'Cargando clima...';

        try {
            const apiKey = "101f370df00fec1a8c81a880bd85c7ab"; // Cambia a tu API Key real si quieres
            const ciudad = "San Salvador";
            const url = `https://api.openweathermap.org/data/2.5/weather?q=${ciudad}&units=metric&lang=es&appid=${apiKey}`;

            const response = await fetch(url);
            const data = await response.json();

            if (data.cod === 200) {
                contenedor.innerHTML = `
                    <div class="alert alert-primary">
                        <strong>Clima en ${data.name}:</strong><br>
                        ${data.weather[0].description}<br>
                        Temperatura: ${data.main.temp}°C, Humedad: ${data.main.humidity}%
                    </div>
                `;
            } else {
                contenedor.innerHTML = `<div class="alert alert-warning">No se pudo obtener el clima.</div>`;
            }
        } catch (error) {
            contenedor.innerHTML = `<div class="alert alert-danger">Error al cargar el clima.</div>`;
            console.error(error);
        }
    });
</script>
@endsection

