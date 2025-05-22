<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudArtistaColectivo;
use App\Models\ArtistaColectivo;
use App\Models\Representante;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SolicitudColectivoController extends Controller
{
    public function index()
    {
        // Obtener todas las solicitudes
        $solicitudes = SolicitudArtistaColectivo::all();
        // Pasar las solicitudes a la vista
        return view('admin.artistas_colectivos.solicitudes.index', compact('solicitudes'));
    }
    public function show($id) {
        $solicitud = SolicitudArtistaColectivo::findOrFail($id);
        return view('admin.artistas_colectivos.solicitudes.show', compact('solicitud'));
    }
public function aprobar($id)
{
    DB::beginTransaction();

    try {
        // Buscar la solicitud
        $solicitud = SolicitudArtistaColectivo::findOrFail($id);

        // Buscar o crear representante (evitar duplicados por ci_representante)
        $representante = Representante::firstOrCreate(
            ['ci' => $solicitud->ci_representante],
            [
                'nombres' => $solicitud->representante['nombres'] ?? null,
                'apellidos' => $solicitud->representante['apellidos'] ?? null,
                'ci' => $solicitud->ci_representante,
                'expedido' => $solicitud->representante['expedido'] ?? null,
                'telefono' => $solicitud->representante['telefono'] ?? null,
                'correo' => $solicitud->representante['correo'] ?? null,
                // agrega más campos que tenga representante si es necesario
            ]
        );

        // Crear grupo (artista colectivo) referenciando al representante
        ArtistaColectivo::create([
            'departamento' => $solicitud->departamento,
            'provincia' => $solicitud->provincia,
            'municipio' => $solicitud->municipio,
            'comunidad' => $solicitud->comunidad,
            'nombre_denominacion' => $solicitud->nombre_denominacion,
            'integrantes' => json_encode($solicitud->integrantes),
            'periodo_act' => $solicitud->periodo_act,
            'telefono' => $solicitud->telefono,
            'celular' => $solicitud->celular,
            'correo' => $solicitud->correo,
            'categoria_id' => $solicitud->categoria_id,
            'sub_categoria_id' => $solicitud->sub_categoria_id,
            'especialidad1' => $solicitud->especialidad1,
            'antecedentes_grupo' => $solicitud->antecedentes_grupo,
            'trayectoria' => $solicitud->trayectoria,
            'logo' => $solicitud->logo,
            'cv' => $solicitud->cv,
            'carta' => $solicitud->carta,
            'representante_id' => $representante->id, // <-- clave foránea
        ]);

        // Eliminar solicitud aprobada
        $solicitud->delete();

        DB::commit();

        return redirect()
            ->route('admin.artistas_colectivos.solicitudes.index')
            ->with('mensaje', 'Solicitud aprobada correctamente.')
            ->with('icono', 'success');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()
            ->route('admin.artistas_colectivos.solicitudes.index')
            ->with('mensaje', 'Error al aprobar: ' . $e->getMessage())
            ->with('icono', 'error');
    }
}

public function rechazar($id)
{
    try {
        $solicitud = SolicitudArtistaColectivo::findOrFail($id);
        $solicitud->save();

        // También puedes eliminarla si lo prefieres:
        $solicitud->delete();

        return redirect()->back()->with('mensaje', 'Solicitud rechazada correctamente.')->with('icono', 'warning');

    } catch (\Exception $e) {
        return redirect()->back()->with('mensaje', 'Error al rechazar: ' . $e->getMessage())->with('icono', 'error');
    }
}

}
