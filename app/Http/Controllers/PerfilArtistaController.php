<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ArtistaIndividual;
use App\Models\SolicitudArtistaIndividual;

class PerfilArtistaController extends Controller
{
    public function individual()
    {
        $user = Auth::user();
        $artista = ArtistaIndividual::where('user_id', $user->id)->first();
        $solicitud = SolicitudArtistaIndividual::where('user_id', $user->id)->first();

        if (!$artista) {
            return redirect()->route('admin.artistas_individuales.create');
        }

        return view('perfil.artista.individual', compact('artista', 'solicitud'));
    }
}

