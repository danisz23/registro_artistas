@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bienvenido, {{ auth()->user()->name }}</h2>

    <p><strong>Estado de tu solicitud:</strong> {{ $solicitud->estado ?? 'No enviada' }}</p>

    @if ($solicitud && $solicitud->estado === 'aprobada')
        <div class="card mt-4">
            <div class="card-header">Tu Registro como Artista</div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $artista->nombres }} {{ $artista->apellidos }}</p>
                <p><strong>Categoría:</strong> {{ $artista->categoria->nombre ?? 'N/A' }}</p>
                <p><strong>Especialidad:</strong> {{ $artista->especialidad1 }}</p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
                <p><strong>Fotografía:</strong><br>
                    <img src="{{ $artista->fotografia_url }}" width="200" />
                </p>
                <a href="{{ $artista->ci_pdf_url }}" target="_blank">Ver Cédula</a> |
                <a href="{{ $artista->cv_url }}" target="_blank">Ver CV</a>
            </div>
        </div>
    @endif
</div>
@endsection
