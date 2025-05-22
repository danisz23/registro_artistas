@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lista de Usuarios</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">Crear Usuario</a>

    @if($users->count())
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm me-2">Ver</a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }} <!-- Paginación -->
        </div>
    @else
        <div class="alert alert-warning">No hay usuarios registrados.</div>
    @endif
</div>
@endsection
