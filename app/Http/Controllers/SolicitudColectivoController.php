<?php

namespace App\Http\Controllers;

use App\Models\SolicitudArtistaColectivo;
use App\Models\ArtistaColectivo;
use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SolicitudColectivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage-solicitudes')->except('perfil');
    }

    public function index()
    {
        $this->authorize('viewAny', SolicitudArtistaColectivo::class);

        try {
            $solicitudes = SolicitudArtistaColectivo::paginate(10);
            return view('admin.artistas_colectivos.solicitudes.index', compact('solicitudes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('mensaje', 'Error al cargar solicitudes: ' . $e->getMessage())->with('icono', 'error');
        }
    }

    public function show($id)
    {
        try {
            $solicitud = SolicitudArtistaColectivo::findOrFail($id);
            return view('admin.artistas_colectivos.solicitudes.show', compact('solicitud'));
        } catch (\Exception $e) {
            return redirect()->back()->with('mensaje', 'Solicitud no encontrada.')->with('icono', 'error');
        }
    }

    public function aprobar($id)
    {
        $this->authorize('approve', SolicitudArtistaColectivo::class);

        DB::beginTransaction();

        try {
            $solicitud = SolicitudArtistaColectivo::findOrFail($id);

            $representanteData = $solicitud->representante;
            if (is_string($representanteData)) {
                $representanteData = json_decode($representanteData, true);
            }

            $representante = Representante::firstOrCreate(
                ['ci' => $representanteData['ci'] ?? null],
                [
                    'nombres' => $representanteData['nombres'] ?? null,
                    'apellidos' => $representanteData['apellidos'] ?? null,
                    'ci' => $representanteData['ci'] ?? null,
                    'expedido' => $representanteData['expedido'] ?? null,
                    'correo' => $solicitud->correo,
                    'domicilio' => $representanteData['domicilio'] ?? null,
                ]
            );

            ArtistaColectivo::create([
                'departamento' => $solicitud->departamento,
                'provincia' => $solicitud->provincia,
                'municipio' => $solicitud->municipio,
                'comunidad' => $solicitud->comunidad,
                'nombre_denominacion' => $solicitud->nombre_denominacion,
                'integrantes' => $solicitud->integrantes,
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
                'representante_id' => $representante->id,
                'user_id' => $solicitud->user_id,
            ]);

            $solicitud->delete();

            DB::commit();

            return redirect()->route('admin.artistas_colectivos.solicitudes.index')
                ->with('mensaje', 'Solicitud aprobada correctamente.')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.artistas_colectivos.solicitudes.index')
                ->with('mensaje', 'Error al aprobar: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    public function rechazar($id)
    {
        $this->authorize('reject', SolicitudArtistaColectivo::class);

        try {
            $solicitud = SolicitudArtistaColectivo::findOrFail($id);
            $solicitud->delete();

            return redirect()->back()->with('mensaje', 'Solicitud rechazada correctamente.')->with('icono', 'warning');

        } catch (\Exception $e) {
            return redirect()->back()->with('mensaje', 'Error al rechazar: ' . $e->getMessage())->with('icono', 'error');
        }
    }

    public function perfil()
    {
        $user = Auth::user();
        $registro = ArtistaColectivo::where('user_id', $user->id)->first();
        $solicitud = SolicitudArtistaColectivo::where('user_id', $user->id)->latest()->first();
        return view('artistas_colectivos.PerfilEstadoColectivo', compact('registro', 'solicitud'));
    }
}
