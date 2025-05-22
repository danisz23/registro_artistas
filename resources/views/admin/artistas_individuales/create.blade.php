@extends('layouts.app')

@section('content')
<div class="card-body" style="background: linear-gradient(to right, rgb(169, 201, 230), rgb(167, 181, 228));">
    <div class="container">
        <!-- Mensajes de error generales -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hubo algunos problemas con tu entrada.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Registro Artísta Individual</h2>
        <form action="{{ route('admin.artistas_individuales.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- DATOS GEOGRÁFICOS -->
            <fieldset>
                <legend class="text-primary font-weight-bold">DATOS GEOGRÁFICOS - Lugar de Residencia</legend>
                <div class="form-group">
                    <label>Departamento:</label>
                    <input type="text" class="form-control @error('departamento') is-invalid @enderror" name="departamento" value="{{ old('departamento') }}" required>
                    @error('departamento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Provincia:</label>
                    <input type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" value="{{ old('provincia') }}" required>
                    @error('provincia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Municipio:</label>
                    <input type="text" class="form-control @error('municipio') is-invalid @enderror" name="municipio" value="{{ old('municipio') }}" required>
                    @error('municipio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Comunidad/Nación:</label>
                    <input type="text" class="form-control @error('comunidad') is-invalid @enderror" name="comunidad" value="{{ old('comunidad') }}" required>
                    @error('comunidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Domicilio Actual:</label>
                    <input type="text" class="form-control @error('domicilio') is-invalid @enderror" name="domicilio" value="{{ old('domicilio') }}" required>
                    @error('domicilio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- DATOS PERSONALES -->
            <fieldset>
                <legend class="text-primary font-weight-bold">DATOS PERSONALES</legend>
                <div class="form-group">
                    <label>Nº Cédula de Identidad:</label>
                    <input type="text" class="form-control @error('ci') is-invalid @enderror" name="ci" value="{{ old('ci') }}" required>
                    @error('ci')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Expedido en:</label>
                    <input type="text" class="form-control @error('expedido') is-invalid @enderror" name="expedido" value="{{ old('expedido') }}" required>
                    @error('expedido')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Sexo:</label>
                    <select class="form-control @error('sexo') is-invalid @enderror" name="sexo" required>
                        <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nombres:</label>
                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required>
                    @error('nombres')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Apellidos:</label>
                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required>
                    @error('apellidos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Lugar de Nacimiento:</label>
                    <input type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" required>
                    @error('lugar_nacimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    @error('fecha_nacimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- DATOS DE CONTACTO -->
            <fieldset>
                <legend class="text-primary font-weight-bold">DATOS DEL CONTACTO</legend>
                <div class="form-group">
                    <label>Teléfono local:</label>
                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Celular:</label>
                    <input type="tel" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{ old('celular') }}" required>
                    @error('celular')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Correo Electrónico:</label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- ANTECEDENTES ARTÍSTICOS -->
            <fieldset>
                <legend class="text-primary font-weight-bold">ANTECEDENTES ARTÍSTICOS</legend>
                <div class="form-group">
                    <label>Referencia de agrupaciones o instituciones en las cuales participó, en orden cronológico:</label>
                    <textarea class="form-control @error('antecedentes') is-invalid @enderror" name="antecedentes" maxlength="250" required>{{ old('antecedentes') }}</textarea>
                    @error('antecedentes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- CATEGORÍA Y SUBCATEGORÍA -->
            <fieldset>
                <legend class="text-primary font-weight-bold">CATEGORÍA - SUBCATEGORÍA</legend>
                <div class="form-group">
                    <label for="categoria">Categoría Original:</label>
                    <select id="categoria" name="categoria_id" class="form-control" onchange="updateSubcategorias()">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="subcategoria">Sub Categoría:</label>
                    <select id="subcategoria" name="sub_categoria_id" class="form-control">
                        <!-- Las subcategorías se cargarán aquí dinámicamente -->
                    </select>
                    @error('sub_categoria_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="form-group">
                    <label for="especialidad1">Especialidad:</label>
                    <input type="text" class="form-control @error('especialidad1') is-invalid @enderror" name="especialidad1" value="{{ old('especialidad1') }}" required>
                    @error('especialidad1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- BIografía -->
            <fieldset>
                <legend class="text-primary font-weight-bold">Biografía</legend>
                <div class="form-group">
                    <label>Biografía:</label>
                    <textarea class="form-control @error('biografia') is-invalid @enderror" name="biografia" maxlength="250" required>{{ old('biografia') }}</textarea>
                    @error('biografia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <!-- Archivos -->
            <fieldset>
                <legend class="text-primary font-weight-bold">Archivos Adjuntos</legend>
                <div class="form-group">
                    <label>Fotografía:</label>
                    <input type="file" class="form-control @error('fotografia') is-invalid @enderror" name="fotografia" accept="image/*">
                    @error('fotografia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>PDF de Cédula de Identidad:</label>
                    <input type="file" class="form-control @error('ci_pdf') is-invalid @enderror" name="ci_pdf" accept="application/pdf">
                    @error('ci_pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Currículum Vitae (PDF):</label>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv" accept="application/pdf">
                    @error('cv')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary btn-submit">Enviar</button>
        </form>
    </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
