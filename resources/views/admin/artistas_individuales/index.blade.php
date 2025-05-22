@extends('layouts.app')

@section('title', 'Índice de Artistas Individuales')

@section('content')
<h2 class="text-center my-4 text-primary">Índice de Artistas Individuales</h2>
<!-- Buscador -->
    <form method="GET" action="{{ route('admin.artistas_individuales.index') }}" class="row gy-2 gx-3 align-items-center mb-4">

        <div class="col-md-2">
            <label for="ci" class="form-label">C.I.</label>
            <input type="text" name="ci" id="ci" class="form-control" placeholder="C.I." value="{{ request('ci') }}">
        </div>

        <div class="col-md-2">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" value="{{ request('nombres') }}">
        </div>

        <div class="col-md-2">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="{{ request('apellidos') }}">
        </div>

        <div class="col-md-2">
            <label for="genero" class="form-label">Género</label>
            <select name="genero" id="genero" class="form-select">
                <option value="">Género</option>
                <option value="Masculino" {{ request('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ request('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" name="departamento" id="departamento" class="form-control" placeholder="Departamento" value="{{ request('departamento') }}">
        </div>

        <div class="col-md-2">
            <label for="fecha_emision" class="form-label">Fecha de Registro</label>
            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="{{ request('fecha_emision') }}">
        </div>

        <!-- Categoría -->
        <div class="col-md-2">
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria_id" class="form-control" onchange="updateSubcategorias()">
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Sub-categoría -->
        <div class="col-md-2">
            <label for="subcategoria">Sub Categoría:</label>
            <select id="subcategoria" name="sub_categoria_id" class="form-control">
                            <!-- Las subcategorías se cargarán aquí dinámicamente -->
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label d-block">&nbsp;</label>
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>

        <div class="col-md-2">
            <label class="form-label d-block">&nbsp;</label>
            <a href="{{ route('admin.artistas_individuales.index') }}" class="btn btn-secondary w-100">Limpiar</a>
        </div>

    </form>

<div class="mb-3 text-end">
    <a href="{{ route('admin.artistas_individuales.create') }}" class="btn btn-success">Agregar Artista Individual</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>Datos Geográficos</th>
                <th>Datos del Artista</th>
                <th>Antecedentes Artísticos</th>
                <th>Archivos Digitales</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artistas as $artista)
                <tr>
                    <!-- Datos Geográficos -->
                    <td>
                        <strong>Cod.:</strong> {{ $artista->codigo }}<br>
                        <strong>Fecha Emisión:</strong> {{ \Carbon\Carbon::parse($artista->fecha_emision)->format('d/m/Y') }}<br>
                        <strong>Depto:</strong> {{ $artista->departamento }}-{{ $artista->provincia }}<br>
                        <strong>Estado:</strong> <span class="badge bg-success">{{ $artista->estado }}</span>
                    </td>

                    <!-- Datos del Artista -->
                    <td>
                        <strong>Nombre:</strong> {{ $artista->nombres }} {{ $artista->apellidos }}<br>
                        <strong>C.I.:</strong> {{ $artista->ci }}<br>
                        <strong>Domicilio:</strong> {{ $artista->domicilio }}<br>
                        <strong>Celular:</strong> {{ $artista->celular }}<br>
                        <strong>Email:</strong> {{ $artista->correo }}
                    </td>

                    <!-- Antecedentes Artísticos -->
                    <td>
                        <strong>Categoría:</strong> {{ $artista->categoria->nombre }}<br>
                        <strong>Sub-categoría:</strong> {{ $artista->subcategoria->nombre }}<br>
                        <strong>Especialidad:</strong> {{ $artista->especialidad }}<br>
                        <strong>Biografía:</strong> <p class="text-justify">{{ $artista->biografia }}</p>
                    </td>

                    <!-- Archivos Digitales -->
                    <td class="text-center">
                        <img src="{{ asset('storage/' . $artista->fotografia) }}" alt="Foto" class="img-thumbnail mb-2" width="150"><br>
                        @if ($artista->cv)
                            <a href="{{ asset('storage/' . $artista->cv) }}" target="_blank">Ver Curriculum</a>
                        @else
                            <em>No disponible</em>
                        @endif
                    </td>

                    <!-- Opciones -->
                    <td class="text-center">
                        <a href="{{ route('admin.artistas_individuales.show', $artista->id) }}" class="btn btn-info btn-sm mb-1">Ver</a><br>
                        <a href="{{ route('admin.artistas_individuales.edit', $artista->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a><br>
                        <a href="{{ route('admin.artistas_individuales.formulario', $artista->id) }}">Formulario</a><br>
                        <a href="{{ route('admin.artistas_individuales.credencial', $artista->id) }}">Credencial</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="d-flex justify-content-center mt-4">
    {{ $artistas->links() }}
</div>
<script>
    function updateSubcategorias() {
            const categoriaId = document.getElementById('categoria').value;

            // Verificar si categoriaId no está vacío
            if (!categoriaId) {
                console.log("Por favor, selecciona una categoría.");
                return; // Salir si no hay categoría seleccionada
            }

            fetch(`/subcategorias/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
            if (data.subcategorias && Array.isArray(data.subcategorias)) {
            const subcategoriaSelect = document.getElementById('subcategoria');
            subcategoriaSelect.innerHTML = ''; // Limpiar opciones previas

                // Agregar nuevas opciones
            data.subcategorias.forEach(sub => {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.nombre;
            subcategoriaSelect.appendChild(option);
            });
            } else {
            console.error('La respuesta no contiene subcategorías válidas');
                alert('Error al cargar las subcategorías.');
            }
            })
            .catch(error => {
                console.error('Error al cargar subcategorías:', error);
                alert('Ocurrió un error al cargar las subcategorías. Intenta nuevamente.');
            });
                    }
</script>
@endsection
