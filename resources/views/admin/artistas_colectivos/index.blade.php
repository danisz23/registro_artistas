@extends('layouts.app')

@section('title', 'Índice de Artistas Colectivos')

@section('content')
<h2 class="text-center my-4 text-primary">Índice de Artistas Colectivos</h2>

<form method="GET" action="{{ route('admin.artistas_colectivos.index') }}" class="row gy-2 gx-3 align-items-center mb-4">
    <div class="col-md-2">
        <label for="ci" class="form-label">C.I.</label>
        <input type="text" name="ci" id="ci" class="form-control" placeholder="C.I." value="{{ request('ci') }}">
    </div>

    <div class="col-md-3">
        <label for="nombre_colectivo" class="form-label">Nombre Colectivo</label>
        <input type="text" name="nombre_colectivo" id="nombre_colectivo" class="form-control" placeholder="Nombre Colectivo" value="{{ request('nombre_colectivo') }}">
    </div>

    <div class="col-md-3">
        <label for="responsable" class="form-label">Responsable</label>
        <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Responsable" value="{{ request('responsable') }}">
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

    <div class="col-md-2">
        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria_id" class="form-control" onchange="updateSubcategorias()">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <label for="subcategoria">Sub Categoría:</label>
        <select id="subcategoria" name="sub_categoria_id" class="form-control">
            <!-- Se cargarán dinámicamente -->
        </select>
    </div>

    <div class="col-md-2">
        <label class="form-label d-block">&nbsp;</label>
        <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>

    <div class="col-md-2">
        <label class="form-label d-block">&nbsp;</label>
        <a href="{{ route('admin.artistas_colectivos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
    </div>
</form>

<div class="mb-3 text-end">
    <a href="{{ route('admin.artistas_colectivos.create') }}" class="btn btn-success">Agregar Artista Colectivo</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle text-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>Datos Geográficos</th>
                <th>Datos del Colectivo</th>
                <th>Antecedentes Artísticos</th>
                <th>Archivos Digitales</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artistasColectivos as $artista)
                <tr>
                    <td>
                        <strong>Cod.:</strong> {{ $artista->codigo }}<br>
                        <strong>Fecha Emisión:</strong> {{ \Carbon\Carbon::parse($artista->fecha_emision)->format('d/m/Y') }}<br>
                        <strong>Depto:</strong> {{ $artista->departamento }}-{{ $artista->provincia }}<br>
                    </td>
                    <td>
                        <strong>Nombre/Denominaciòn:</strong> {{ $artista->nombre_denominacion }}<br>
                        <strong>Representante:</strong>{{ $artista->representante->nombres ?? 'Sin representante' }} {{ $artista->representante->apellidos ?? '' }}<br>
                        <strong>C.I.:</strong> {{ $artista->rep_ci }}<br>
                        <strong>Celular:</strong> {{ $artista->celular }}<br>
                        <strong>Email:</strong> {{ $artista->correo }}
                    </td>
                    <td>
                        <strong>Categoría:</strong> {{ $artista->categoria->nombre }}<br>
                        <strong>Sub-categoría:</strong> {{ $artista->subcategoria->nombre }}<br>
                        <strong>Especialidad:</strong> {{ $artista->especialidad1 }}<br>
                        <strong>Biografía:</strong> <p class="text-justify">{{ $artista->biografia }}</p>
                    </td>
                    <td class="text-center">
                        <img src="{{ asset('storage/' . $artista->logo) }}" alt="Foto" class="img-thumbnail mb-2" width="150"><br>
                        @if ($artista->cv)
                            <a href="{{ asset('storage/' . $artista->cv) }}" target="_blank">Ver Curriculum</a>
                        @else
                            <em>No disponible</em>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.artistas_colectivos.show', $artista->id) }}" class="btn btn-info btn-sm mb-1">Ver</a><br>
                        <a href="{{ route('admin.artistas_colectivos.edit', $artista->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a><br>
                        <a href="{{ route('admin.artistas_colectivos.formulario', $artista->id) }}">Formulario</a><br>
                        <a href="{{ route('admin.artistas_colectivos.credencial', $artista->id) }}">Credencial</a>
                        <!-- Agrega más opciones si tienes -->
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
          <div class="d-flex justify-content-center mt-4">
            {{ $artistasColectivos->links() }}
        </div>
</div>


<script>
function updateSubcategorias() {
    const categoriaId = document.getElementById('categoria').value;

    if (!categoriaId) {
        console.log("Por favor, selecciona una categoría.");
        return;
    }

    fetch(`/subcategorias/${categoriaId}`)
        .then(response => response.json())
        .then(data => {
            if (data.subcategorias && Array.isArray(data.subcategorias)) {
                const subcategoriaSelect = document.getElementById('subcategoria');
                subcategoriaSelect.innerHTML = '';

                data.subcategorias.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.nombre;
                    subcategoriaSelect.appendChild(option);
                });

                // Mantener selección si viene de request
                @if(request('sub_categoria_id'))
                    subcategoriaSelect.value = "{{ request('sub_categoria_id') }}";
                @endif

            } else {
                console.error('Respuesta no contiene subcategorías válidas');
                alert('Error al cargar las subcategorías.');
            }
        })
        .catch(error => {
            console.error('Error al cargar subcategorías:', error);
            alert('Ocurrió un error al cargar las subcategorías. Intenta nuevamente.');
        });
}

// Cargar subcategorías al cargar la página si hay categoría seleccionada
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('categoria').value) {
        updateSubcategorias();
    }
});
</script>
@endsection
