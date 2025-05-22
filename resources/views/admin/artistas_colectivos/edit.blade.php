@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Fondo Azul Degradante -->
        <div class="card-body" style="background: linear-gradient(to right,rgb(169, 201, 230),rgb(167, 181, 228));">
        <h2 class="text-center mb-4" style="color: #2D3748;">Editar Artísta Colectivo</h2>

            <!-- Errores globales -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Se encontraron los siguientes errores:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.artistas_colectivos.update', $artistaColectivo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Using PUT method for update -->

                <!-- Datos de Residencia - Lugar de Residencia -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Datos de Residencia - Lugar de Residencia</legend>

                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" value="{{ old('departamento', $artistaColectivo->departamento) }}" required>
                        @error('departamento') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <input type="text" class="form-control" id="provincia" name="provincia" value="{{ old('provincia', $artistaColectivo->provincia) }}" required>
                        @error('provincia') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="municipio">Municipio:</label>
                        <input type="text" class="form-control" id="municipio" name="municipio" value="{{ old('municipio', $artistaColectivo->municipio) }}" required>
                        @error('municipio') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="comunidad">Comunidad/Nación:</label>
                        <input type="text" class="form-control" id="comunidad" name="comunidad" value="{{ old('comunidad', $artistaColectivo->comunidad) }}" required>
                        @error('comunidad') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>

                <!-- Datos del Grupo -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Datos del Grupo</legend>

                    <div class="form-group">
                        <label for="nombre_denominacion">Nombre/Denominación:</label>
                        <input type="text" class="form-control" id="nombre_denominacion" name="nombre_denominacion" value="{{ old('nombre_denominacion', $artistaColectivo->nombre_denominacion) }}" required>
                        @error('nombre_denominacion') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Integrantes:</label>
                        <div id="integrantes-wrapper">
                                @php
                                    $integrantes = json_decode($artistaColectivo->integrantes);
                                    // Asegurarse de que $integrantes sea un array
                                    $integrantes = is_array($integrantes) ? $integrantes : [];
                                @endphp
                                @foreach ($integrantes as $integrante)
                                    <div class="input-group mb-2">
                                        <input type="text" name="integrantes[]" class="form-control" placeholder="Nombre del integrante" value="{{ $integrante }}" required>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-danger" onclick="removeIntegrante(this)">Eliminar</button>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="addIntegrante()">+ Añadir Integrante</button>
                        @error('integrantes') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="periodo_act">Periodo de Actividad:</label>
                        <textarea class="form-control" id="periodo_act" name="periodo_act" maxlength="1200" required>{{ old('periodo_act', $artistaColectivo->periodo_act) }}</textarea>
                        @error('periodo_act') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>

                <!-- Datos de Contacto del Grupo -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Datos de Contacto del Grupo</legend>

                    <div class="form-group">
                        <label for="telefono">Teléfono fijo:</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $artistaColectivo->telefono) }}">
                        @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="tel" class="form-control" id="celular" name="celular" value="{{ old('celular', $artistaColectivo->celular) }}" required>
                        @error('celular') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $artistaColectivo->correo) }}" required>
                        @error('correo') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>

                <!-- Antecedentes Artísticos -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Antecedentes Artísticos</legend>

                    <div class="form-group">
                        <label for="categoria">Categoría Original:</label>
                        <select id="categoria" name="categoria_id" class="form-control" onchange="updateSubcategorias()">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $artistaColectivo->categoria_id) == $categoria->id ? 'selected' : '' }}>
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
                        <input type="text" class="form-control" id="especialidad1" name="especialidad1" value="{{ old('especialidad1', $artistaColectivo->especialidad1) }}" required>
                        @error('especialidad1') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="antecedentes_grupo">Antecedentes del Grupo:</label>
                        <textarea  type="text" class="form-control" id="antecedentes_grupo" name="antecedentes_grupo" value="{{ old('antecedentes_grupo', $artistaColectivo->antecedentes_grupo) }}" required></textarea>
                        @error('antecedentes_grupo') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="trayectoria">Trayectoria del Grupo:</label>
                        <textarea type="text" class="form-control" id="trayectoria" name="trayectoria" value="{{ old('trayectoria', $artistaColectivo->trayectoria) }}" required></textarea> 
                        @error('trayectoria') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>
                <!-- Datos del Representante -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Datos del Representante</legend>

                    <div class="form-group">
                        <label for="rep_nombres">Nombre(s):</label>
                        <input type="text" class="form-control" id="rep_nombres" name="rep_nombres" value="{{ old('rep_nombres', $artistaColectivo->representante->nombres) }}" required>
                        @error('rep_nombres') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="rep_apellidos">Apellido(s):</label>
                        <input type="text" class="form-control" id="rep_apellidos" name="rep_apellidos" value="{{ old('rep_apellidos', $artistaColectivo->representante->apellidos) }}" required>
                        @error('rep_apellidos') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="rep_ci">Cédula de Identidad:</label>
                        <input type="text" class="form-control" id="rep_ci" name="rep_ci" value="{{ old('rep_ci', $artistaColectivo->representante->ci) }}" required>
                        @error('rep_ci') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="rep_expedido">Expedido en:</label>
                        <input type="text" class="form-control" id="rep_expedido" name="rep_expedido" value="{{ old('rep_expedido', $artistaColectivo->representante->expedido) }}" required>
                        @error('rep_expedido') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="rep_lugar_nacimiento">Lugar de Nacimiento:</label>
                        <input type="text" class="form-control" id="rep_lugar_nacimiento" name="rep_lugar_nacimiento" value="{{ old('rep_lugar_nacimiento', $artistaColectivo->representante->lugar_nacimiento) }}" required>
                        @error('rep_lugar_nacimiento') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="rep_fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" class="form-control" id="rep_fecha_nacimiento" name="rep_fecha_nacimiento" value="{{ old('rep_fecha_nacimiento', $artistaColectivo->representante->fecha_nacimiento) }}" required>
                        @error('rep_fecha_nacimiento') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label for="domicilio">Domicilio Actual:</label>
                        <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{ old('domicilio', $artistaColectivo->representante->domicilio) }}" required>
                        @error('domicilio') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>

                <!-- Documentos Adjuntos -->
                <fieldset class="mb-4">
                    <legend class="text-primary font-weight-bold">Documentación Adjunta</legend>

                    <div class="form-group">
                        <label for="logo">LOGO DEL GRUPO (JPG, máx. 256 KB):</label>
                        <input type="file" class="form-control-file" id="logo" name="logo" accept="image/jpeg,image/png,image/jpg,image/webp">
                        @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                        <div>
                            @if($artistaColectivo->logo)
                                <img src="{{ asset('storage/' . $artistaColectivo->logo) }}" alt="Logo" width="100" height="100">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ci_representante">DOCUMENTO DE CARNET DE IDENTIDAD DEL REPRESENTANTE (PDF, máx. 1 MB):</label>
                        <input type="file" class="form-control-file" id="ci_representante" name="ci_representante" accept="application/pdf">
                        @error('ci_representante') <small class="text-danger">{{ $message }}</small> @enderror
                        <div>
                            @if($artistaColectivo->ci_representante)
                                <a href="{{ asset('storage/' . $artistaColectivo->ci_representante) }}" target="_blank">Ver Documento</a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cv">DOCUMENTO DE RESPALDO (CV en PDF, máx. 1 MB):</label>

                        @if($artistaColectivo->cv)
                            <p><a href="{{ asset('storage/' . $artistaColectivo->cv) }}" target="_blank">Ver documento actual</a></p>
                        @endif

                        <input type="file" class="form-control-file" id="cv" name="cv" accept="application/pdf">
                        @error('cv') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label for="carta">CARTA DE SOLICITUD (PDF, máx. 1 MB):</label>

                        @if($artistaColectivo->carta)
                            <p><a href="{{ asset('storage/' . $artistaColectivo->carta) }}" target="_blank">Ver documento actual</a></p>
                        @endif

                        <input type="file" class="form-control-file" id="carta" name="carta" accept="application/pdf">
                        @error('carta') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </fieldset>

                <!-- Botón de Enviar -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Actualizar Artísta Colectivo</button>
                </div>

            </form>

            <div class="mt-4">
                <a href="{{ route('admin.artistas_colectivos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </div>
    </div>
    <script>
        // Function to add an input for a new integrante
        function addIntegrante() {
            var inputWrapper = document.getElementById('integrantes-wrapper');
            var newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-2');
            newInputGroup.innerHTML = `
                <input type="text" name="integrantes[]" class="form-control" placeholder="Nombre del integrante" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removeIntegrante(this)">Eliminar</button>
                </div>
            `;
            inputWrapper.appendChild(newInputGroup);
        }

        // Function to remove an integrante input field
        function removeIntegrante(button) {
            button.parentElement.parentElement.remove();
        }
        function updateSubcategorias() {
            const categoriaId = document.getElementById('categoria').value;
            const subcategoriaSelect = document.getElementById('subcategoria');

            if (!categoriaId || !subcategoriaSelect) {
                console.error('Faltan elementos necesarios para cargar subcategorías.');
                return;
            }

            fetch(`/subcategorias/${categoriaId}`)
                .then(response => {
                    if (!response.ok) throw new Error('No se pudo obtener la respuesta del servidor');
                    return response.json();
                })
                .then(data => {
                    subcategoriaSelect.innerHTML = '';
                    if (data.subcategorias && Array.isArray(data.subcategorias)) {
                        data.subcategorias.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.nombre;
                            subcategoriaSelect.appendChild(option);
                        });
                    } else {
                        throw new Error('Formato de datos inválido');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener las subcategorías:', error);
                    alert('No se pudieron cargar las subcategorías');
                });
        }

        // Opcional: carga inicial si ya hay una categoría seleccionada
        document.addEventListener('DOMContentLoaded', function () {
            updateSubcategorias();
        });
    </script>

@endsection


