@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: rgba(26, 30, 54, 0.91); text-align: center;">
            <h4>Detalle de la Solicitud del Artista Individual</h4>
        </div>
        <div class="card-body">

            <!-- Datos Personales -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos Personales</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nombre Completo</th><td>{{ $solicitud->nombres }} {{ $solicitud->apellidos }}</td></tr>
                        <tr><th>CI</th><td>{{ $solicitud->ci }} {{ $solicitud->expedido }}</td></tr>
                        <tr><th>Fecha de Nacimiento</th><td>{{ $solicitud->fecha_nacimiento }}</td></tr>
                        <tr><th>Lugar de Nacimiento</th><td>{{ $solicitud->lugar_nacimiento }}</td></tr>
                        <tr><th>Género</th><td>{{ $solicitud->sexo }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Residencia -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos de Residencia</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Departamento</th><td>{{ $solicitud->departamento }}</td></tr>
                        <tr><th>Provincia</th><td>{{ $solicitud->provincia }}</td></tr>
                        <tr><th>Municipio</th><td>{{ $solicitud->municipio }}</td></tr>
                        <tr><th>Comunidad/Nación</th><td>{{ $solicitud->comunidad }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Contacto -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos de Contacto</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Teléfono</th><td>{{ $solicitud->telefono }}</td></tr>
                        <tr><th>Celular</th><td>{{ $solicitud->celular }}</td></tr>
                        <tr><th>Correo Electrónico</th><td>{{ $solicitud->correo }}</td></tr>
                        <tr><th>Domicilio</th><td>{{ $solicitud->domicilio }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Trayectoria -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Trayectoria Artística</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Categoría</th>
                            <td>{{ $solicitud->categoria->nombre ?? 'No definida' }}</td>
                        </tr>
                        <tr>
                            <th>Subcategoría</th>
                            <td>{{ $solicitud->subcategoria->nombre ?? 'No definida' }}</td>
                        </tr>
                        <tr><th>Especialidad</th><td>{{ $solicitud->especialidad1 }}</td></tr>
                        <tr><th>Antecedentes</th><td>{{ $solicitud->antecedentes }}</td></tr>
                        <tr><th>Biografia</th><td>{{ $solicitud->biografia ?? 'Ninguno registrado' }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Documentos Adjuntos -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Documentos Adjuntos</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Fotografía</th>
                            <td>
                                @if ($solicitud->fotografia)
                                    <img src="{{ asset('storage/' . $solicitud->fotografia) }}" alt="Fotografía del Artista" class="img-fluid" style="max-width: 200px;">
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Cédula de Identidad (PDF)</th>
                            <td>
                                @if ($solicitud->ci_pdf)
                                    <iframe src="{{ asset('storage/' . $solicitud->ci_pdf) }}" width="100%" height="400px"></iframe>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Currículum Vitae</th>
                            <td>
                                @if ($solicitud->cv)
                                    <iframe src="{{ asset('storage/' . $solicitud->cv) }}" width="100%" height="400px"></iframe>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </fieldset>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <form action="{{ route('admin.artistas_individuales.solicitudes.aprobar', $solicitud->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Aprobar</button>
                </form>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rechazarModal">
                    Rechazar
                </button>
            </div>

            <!-- Modal Rechazo -->
            <div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="rechazarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.artistas_individuales.solicitudes.rechazar', $solicitud->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rechazarModalLabel">Rechazar Solicitud</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="observaciones" class="form-label">Observaciones *</label>
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Enviar Rechazo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
