{{-- resources/views/admin/artistas_colectivos/solicitudes.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Solicitudes Pendientes</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Artista Colectivo</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->nombre_denominacion }}</td>
                    <td>{{ $solicitud->correo }}</td>
                    <td>
                        {{-- Botón Ver --}}
                        <a href="{{ route('admin.artistas_colectivos.solicitudes.show', $solicitud->id) }}" class="btn btn-primary mb-1">Ver</a>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
