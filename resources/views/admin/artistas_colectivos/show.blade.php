@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: rgba(26, 30, 54, 0.91);  text-center">
            <h4>Detalle del Artista Colectivo</h4>
        </div>
        <div class="card-body">

            <!-- Sección de Datos de Residencia -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos de Residencia</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Departamento</th>
                            <td>{{ $artista->departamento }}</td>
                        </tr>
                        <tr>
                            <th>Provincia</th>
                            <td>{{ $artista->provincia }}</td>
                        </tr>
                        <tr>
                            <th>Municipio</th>
                            <td>{{ $artista->municipio }}</td>
                        </tr>
                        <tr>
                            <th>Comunidad/Nación</th>
                            <td>{{ $artista->comunidad }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Datos del Grupo -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos del Grupo</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nombre/Denominación</th>
                            <td>{{ $artista->nombre_denominacion }}</td>
                        </tr>
                        <tr>
                            <th>Integrantes</th>
                            <td>
                                @php
                                    $integrantes = json_decode($artista->integrantes, true);
                                @endphp
                                @if (is_array($integrantes) && count($integrantes) > 0)
                                    <ul>
                                        @foreach($integrantes as $integrante)
                                            <li>{{ $integrante }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No hay integrantes registrados o el formato es incorrecto.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Periodo de Actividad</th>
                            <td>{{ $artista->periodo_act }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Datos de Contacto -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos de Contacto</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Teléfono</th>
                            <td>{{ $artista->telefono }}</td>
                        </tr>
                        <tr>
                            <th>Celular</th>
                            <td>{{ $artista->celular }}</td>
                        </tr>
                        <tr>
                            <th>Correo Electrónico</th>
                            <td>{{ $artista->correo }}</td>
                        </tr>
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
                            <td>{{ $artista->categoria->nombre ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Subcategoría</th>
                            <td>{{ $artista->subcategoria->nombre ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Especialidad</th>
                            <td>{{ $artista->especialidad1 }}</td>
                        </tr>
                        <tr>
                            <th>Antecedentes del Grupo</th>
                            <td>{{ $artista->antecedentes_grupo }}</td>
                        </tr>
                        <tr>
                            <th>Trayectoria del Grupo</th>
                            <td>{{ $artista->trayectoria }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Datos del Representante -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos del Representante</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nombre Completo</th>
                            <td>{{ $artista->representante->nombres }} {{ $artista->representante->apellidos }}</td>
                        </tr>
                        <tr>
                            <th>Cédula de Identidad</th>
                            <td>{{ $artista->representante->ci }} {{ $artista->representante->expedido }}</td>
                        </tr>
                        <tr>
                            <th>Lugar de Nacimiento</th>
                            <td>{{ $artista->representante->lugar_nacimiento }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Nacimiento</th>
                            <td>{{ $artista->representante->fecha_nacimiento }}</td>
                        </tr>
                        <tr>
                            <th>Domicilio Actual</th>
                            <td>{{ $artista->representante->domicilio }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Documentos Adjuntos -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color:rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Documentos Adjuntos</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Logo del Grupo</th>
                            <td>
                                @if ($artista->logo)
                                    <img src="{{ asset('storage/' . $artista->logo) }}" alt="Logo del Grupo" class="img-fluid" style="max-width: 200px;">
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CI del Representante</th>
                            <td>
                                @if ($artista->ci_representante)
                                    <a href="{{ asset('storage/' . $artista->ci_representante) }}" target="_blank">Ver Documento</a>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CV</th>
                            <td>
                                @if ($artista->cv)
                                    <a href="{{ asset('storage/' . $artista->cv) }}" target="_blank">Ver Documento</a>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Carta de Solicitud</th>
                            <td>
                                @if ($artista->carta)
                                    <a href="{{ asset('storage/' . $artista->carta) }}" target="_blank">Ver Documento</a>
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

        </div>
    </div>
</div>
@endsection
