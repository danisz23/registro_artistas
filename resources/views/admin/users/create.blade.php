@extends('layouts.app')

@section('title', 'Crear Nuevo Usuario')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-7 offset-md-1 col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    </br>
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Ingrese el correo" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese la contraseña" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme la contraseña" required>
                            </div>
                        </div>

                        <!-- Rol -->
                        <div class="mb-4">
                            <label for="role" class="form-label">Rol del Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                                    <option value="admin">Administrador</option>
                                    <option value="user">Usuario</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Crear Usuario
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-secondary">
                            ← Volver a la lista de usuarios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
