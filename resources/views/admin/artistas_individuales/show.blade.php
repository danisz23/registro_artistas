@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background-color: rgba(26, 30, 54, 0.91);  text-center">
            <h4>Detalle del Artista Individual</h4>
        </div>
        <div class="card-body">

            <!-- Sección de Datos Personales -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Datos Personales</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nombre Completo</th>
                            <td>{{ $artista->nombres }} {{ $artista->apellidos }}</td>
                        </tr>
                        <tr>
                            <th>Cédula de Identidad</th>
                            <td>{{ $artista->ci }} {{ $artista->expedido }}</td>
                        </tr>
                        <tr>
                            <th>Lugar de Nacimiento</th>
                            <td>{{ $artista->lugar_nacimiento }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Nacimiento</th>
                            <td>{{ \Carbon\Carbon::parse($artista->fecha_nacimiento)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Sexo</th>
                            <td>{{ $artista->sexo }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td>{{ $artista->telefono ?? 'No disponible' }}</td>
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
                        <tr>
                            <th>Domicilio</th>
                            <td>{{ $artista->domicilio }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Antecedentes -->
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
                            <th>Antecedentes</th>
                            <td>{{ $artista->antecedentes }}</td>
                        </tr>
                        <tr>
                            <th>Biografía</th>
                            <td>{{ $artista->biografia }}</td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <!-- Sección de Documentos Adjuntos -->
            <fieldset class="mb-4">
                <legend class="text-white" style="background-color: rgba(26, 30, 54, 0.91); padding: 5px; border-radius: 5px;">Documentos Adjuntos</legend>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Fotografía</th>
                            <td>
                                @if ($artista->fotografia)
                                    <img src="{{ asset('storage/' . $artista->fotografia) }}" alt="Fotografía del Artista" class="img-fluid" style="max-width: 200px;">
                                @else
                                    <p>No disponible.</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CI del Artista</th>
                            <td>
                                @if ($artista->ci_pdf)
                                    <a href="{{ asset('storage/' . $artista->ci_pdf) }}" target="_blank">Ver Documento</a>
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
                    </tbody>
                </table>
            </fieldset>

        </div>
    </div>
</div>
@endsection
