<!-- resources/views/admin/artistas_colectivos/seguimiento.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Lista de Artistas Colectivos Pendientes de Aprobación</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Denominación</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artistasColectivosPendientes as $artista)
            <tr>
                <td>{{ $artista->nombre_denominacion }}</td>
                <td>{{ $artista->departamento }}</td>
                <td>{{ $artista->provincia }}</td>
                <td>
                    <!-- Botón para Ver el registro -->
                    <a href="{{ route('admin.artistas_colectivos.show', $artista->id) }}" class="btn btn-info">Ver</a>
                    
                    <!-- Botón para Aprobar -->
                    <form action="{{ route('admin.artistas_colectivos.aprobar', $artista->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Aprobar</button>
                    </form>
                    
                    <!-- Botón para Rechazar -->
                    <form action="{{ route('admin.artistas_colectivos.rechazar', $artista->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
