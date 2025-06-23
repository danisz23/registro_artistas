@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Perfil y Estado de Registro</h1>

    @if($registro)
        {{-- Mostrar tarjeta con datos del registro aprobado --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                Registro Aprobado
            </div>
            <div class="card-body">
                <h3>{{ $registro->nombre_denominacion }}</h3>
                <p><strong>Categoría:</strong> {{ $registro->categoria->nombre ?? 'N/A' }}</p>
                <p><strong>Subcategoría:</strong> {{ $registro->subcategoria->nombre ?? 'N/A' }}</p>
                <p><strong>Integrantes:</strong> 
                    @php
                        $integrantes = json_decode($registro->integrantes, true);
                    @endphp
                    @if(is_array($integrantes))
                        <ul>
                            @foreach($integrantes as $integrante)
                                <li>{{ $integrante }}</li>
                            @endforeach
                        </ul>
                    @else
                        N/A
                    @endif
                </p>
                <a href="{{ route('artistas_colectivos.show', $registro->id) }}" class="btn btn-primary">Ver detalles</a>
            </div>
        </div>
    @endif

    @if($solicitud && !$registro)
        {{-- Mostrar estado de solicitud pendiente --}}
        <div class="card mb-4">
            <div class="card-header bg-warning">
                Solicitud Pendiente
            </div>
            <div class="card-body">
                <h3>{{ $solicitud->nombre_denominacion }}</h3>
                <p><strong>Estado:</strong> Pendiente de revisión</p>
                <p><strong>Fecha de Solicitud:</strong> {{ $solicitud->created_at->format('d/m/Y') }}</p>
                <a href="{{ route('artistas_colectivos.solicitudes.show', $solicitud->id) }}" class="btn btn-secondary">Ver solicitud</a>
            </div>
        </div>
    @endif

    @if(!$registro && !$solicitud)
        {{-- Mostrar botón para crear solicitud si tiene permiso --}}
        @can('create', App\Models\SolicitudArtistaColectivo::class)
            <a href="{{ route('artistas_colectivos.create') }}" class="btn btn-success">
                Crear nueva solicitud
            </a>
        @else
            <p>No tiene solicitudes ni registros aprobados.</p>
        @endcan
    @endif

</div>
@endsection
