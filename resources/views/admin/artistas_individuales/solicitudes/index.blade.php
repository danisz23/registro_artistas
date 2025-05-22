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

                        {{-- Botón Aprobar --}}
                        <form action="{{ route('admin.artistas_individuales.solicitudes.aprobar', $solicitud->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success mb-1">Aprobar</button>
                        </form>

                        {{-- Botón Rechazar --}}
                        <button class="btn btn-danger mb-1" data-toggle="modal" data-target="#rechazarModal{{ $solicitud->id }}">Rechazar</button>

                        {{-- Modal de Rechazo --}}
                        <div class="modal fade" id="rechazarModal{{ $solicitud->id }}" tabindex="-1" role="dialog" aria-labelledby="rechazarModalLabel{{ $solicitud->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rechazarModalLabel{{ $solicitud->id }}">Rechazar Solicitud</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.artistas_individuales.solicitudes.rechazar', $solicitud->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="observaciones">Observaciones</label>
                                                <textarea name="observaciones" id="observaciones" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
