<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Redirección después del registro (dependiendo del rol).
     */

    /**
     * Crear nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validador para el registro.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:artist_individual,artist_colectivo'],
        ]);
    }

    /**
     * Crear un nuevo usuario tras un registro válido.
     */
    protected function create(array $data)
    {
        $allowedRoles = ['artist_individual', 'artist_colectivo'];
        $role = in_array($data['role'], $allowedRoles) ? $data['role'] : 'artist_individual';

        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $role,
        ]);
    }
}
