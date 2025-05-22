@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Usuario</h2>

    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
