@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: rgba(26, 30, 54, 0.91); text-align: center;">
            <h4>Detalle de la Solicitud</h4>
        </div>
        <div class="card-body">

            <!-- Sección de Datos de Residencia -->
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

            <!-- Sección de Datos del Grupo -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos del Grupo</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nombre/Denominación</th><td>{{ $solicitud->nombre_denominacion }}</td></tr>
                        <tr>
                            <th>Integrantes</th>
                            <td>
                                @if (is_array($solicitud->integrantes) && count($solicitud->integrantes) > 0)
                                    <ul>
                                        @foreach($solicitud->integrantes as $integrante)
                                            <li>{{ $integrante }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No hay integrantes registrados.</p>
                                @endif
                            </td>
                        </tr>
                        <tr><th>Periodo de Actividad</th><td>{{ $solicitud->periodo_act }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Datos de Contacto -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos de Contacto</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Teléfono</th><td>{{ $solicitud->telefono }}</td></tr>
                        <tr><th>Celular</th><td>{{ $solicitud->celular }}</td></tr>
                        <tr><th>Correo Electrónico</th><td>{{ $solicitud->correo }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Antecedentes Artísticos -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Antecedentes Artísticos</legend>
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
                        <tr><th>Antecedentes del Grupo</th><td>{{ $solicitud->antecedentes_grupo }}</td></tr>
                        <tr><th>Trayectoria del Grupo</th><td>{{ $solicitud->trayectoria }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Datos del Representante -->
            @php
                $r = (object) $solicitud->representante;
            @endphp
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos del Representante</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr><th>Nombre Completo</th><td>{{ $r->nombres ?? 'N/A' }} {{ $r->apellidos ?? '' }}</td></tr>
                        <tr><th>Cédula de Identidad</th><td>{{ $r->ci ?? 'N/A' }} {{ $r->expedido ?? '' }}</td></tr>
                        <tr><th>Lugar de Nacimiento</th><td>{{ $r->lugar_nacimiento ?? 'N/A' }}</td></tr>
                        <tr><th>Fecha de Nacimiento</th><td>{{ $r->fecha_nacimiento ?? 'N/A' }}</td></tr>
                        <tr><th>Domicilio Actual</th><td>{{ $r->domicilio ?? 'N/A' }}</td></tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Documentos Adjuntos -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Documentos Adjuntos</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Logo del Grupo</th>
                            <td>
                                @if ($solicitud->logo)
                                    <img src="{{ asset('storage/' . $solicitud->logo) }}" alt="Logo del Grupo" class="img-fluid" style="max-width: 200px;">
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CI del Representante</th>
                            <td>
                                @if ($solicitud->ci_representante)
                                    <iframe src="{{ asset('storage/' . $solicitud->ci_representante) }}" width="100%" height="400px"></iframe>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CV</th>               
                            <td>
                                @if ($solicitud->cv)
                                    <iframe src="{{ asset('storage/' . $solicitud->cv) }}" width="100%" height="400px"></iframe>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Carta de Solicitud</th>
                            <td>
                                @if ($solicitud->carta)
                                    <iframe src="{{ asset('storage/' . $solicitud->carta) }}" width="100%" height="400px"></iframe>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                            {{-- Botones Aprobar y Rechazar --}}
            <div class="d-flex justify-content-center gap-3 mt-4">
                <form action="{{ route('admin.artistas_colectivos.solicitudes.aprobar', $solicitud->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Aprobar</button>
                </form>

                <!-- Botón para abrir modal de Rechazo -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rechazarModal">
                    Rechazar
                </button>
            </div>

            <!-- Modal Rechazar -->
            <div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="rechazarModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form action="{{ route('admin.artistas_colectivos.solicitudes.rechazar', $solicitud->id) }}" method="POST">
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
            </fieldset>

        </div>
    </div>
</div>
@endsection
