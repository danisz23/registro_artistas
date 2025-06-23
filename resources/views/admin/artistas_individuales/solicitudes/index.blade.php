@extends('layouts.app')

@section('content')
    <h1>Solicitudes Pendientes de Artistas Individuales</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->nombres }} {{ $solicitud->apellidos }}</td>
                    <td>{{ $solicitud->correo }}</td>
                    <td>
                        {{-- Botón Ver --}}
                        <a href="{{ route('admin.artistas_individuales.solicitudes.show', $solicitud->id) }}" class="btn btn-primary mb-1">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
