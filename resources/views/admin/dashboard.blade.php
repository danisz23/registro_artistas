@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Panel de Control</h1>

    <div class="row mb-4">
        <div class="col-sm-4 col-md-2">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1">Total Artistas</h6>
                    <p class="card-text fs-5">{{ $totalArtistas }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-2">
            <div class="card text-dark bg-warning mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1">Pendientes</h6>
                    <p class="card-text fs-5">{{ $pendientes }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-2">
            <div class="card text-white bg-success mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1">Individuales</h6>
                    <p class="card-text fs-5">{{ $aprobadosIndividuales }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-2">
            <div class="card text-white bg-success mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1"> Colectivos</h6>
                    <p class="card-text fs-5">{{ $aprobadosColectivos }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-md-2">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body p-2">
                    <h6 class="card-title mb-1">Rechazados</h6>
                    <p class="card-text fs-5">{{ $rechazados }}</p>
                </div>
            </div>
        </div>
    </div>


    {{-- Accesos rápidos --}}
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h4>Accesos Rápidos</h4>
        <a href="{{ route('admin.estadisticas') }}" class="btn btn-outline-info">
            Ver estadísticas mensuales
        </a>
    </div>
    <div class="mb-4">
        <a href="{{ route('admin.artistas_individuales.index') }}" class="btn btn-primary me-2 mb-2">Ver Registros</a>
        <a href="{{ route('admin.artistas_individuales.solicitudes.index') }}" class="btn btn-warning me-2 mb-2">Pendientes</a>
        <a href="{{ route('admin.artistas_individuales.create') }}" class="btn btn-success me-2 mb-2">Registrar Nuevo</a>
    </div>

    {{-- Últimos registros --}}
    <div class="card">
        <div class="card-header">
            Últimos Registros
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ultimosRegistros as $registro)
                    <tr>
                        <td>
                            @if ($registro->tipo === 'individual')
                                {{ $registro->nombres }} {{ $registro->apellidos ?? '' }}
                            @else
                                {{ $registro->nombre_denominacion }}
                            @endif
                        </td>
                        <td>{{ ucfirst($registro->tipo) }}</td>
                        <td>
                            @if ($registro->estado === 'entregado')
                                <span class="badge bg-success">Entregado</span>
                            @elseif ($registro->estado === 'pendiente_entrega')
                                <span class="badge bg-danger">No entregado</span>
                            @endif
                        </td>
                        <td>{{ $registro->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay registros recientes.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
