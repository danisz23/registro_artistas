<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\SolicitudArtistaIndividualController;
use App\Http\Controllers\SolicitudColectivoController;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        return match ($user->role) {
            'artist_individual' => $user->artistaIndividual
                ? redirect()->route('perfil.artista.individual') // Ya tiene registro
                : redirect()->route('admin.artistas_individuales.create'), // No tiene registro

            'artist_colectivo' => $user->artistasColectivos->count()
                ? redirect()->route('perfil.artista.colectivo') // Ya tiene al menos uno
                : redirect()->route('admin.artistas_colectivos.create'), // No tiene ninguno

            default => redirect('/home'),
        };
    }
}
