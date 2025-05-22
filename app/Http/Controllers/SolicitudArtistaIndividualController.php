<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudArtistaIndividual;
use App\Models\ArtistaIndividual;

class SolicitudArtistaIndividualController extends Controller
{
    // Mostrar todas las solicitudes
    public function index()
    {
        $solicitudes = SolicitudArtistaIndividual::with('categoria', 'subcategoria')->get();
        return view('admin.artistas_individuales.solicitudes.index', compact('solicitudes'));
    }
    // Mostrar detalles de una solicitud
    public function show($id)
    {
        $solicitud = ArtistaIndividual::findOrFail($id);
        return view('admin.artistas_individuales.solicitudes.show', compact('solicitud'));
    }

    // Rechazar solicitud (eliminar)
    public function destroy($id)
    {
        $solicitud = SolicitudArtistaIndividual::findOrFail($id);

        // Eliminar archivos asociados
        Storage::delete([
            'public/' . $solicitud->fotografia,
            'public/' . $solicitud->ci_pdf,
            'public/' . $solicitud->cv,
        ]);

        $solicitud->delete();

        return redirect()->route('admin.artistas_individuales.solicitudes.index')
                         ->with('success', 'Solicitud rechazada y eliminada correctamente.');
    }

    // Aprobar una solicitud
    public function aprobar($id)
    {
        $solicitud = SolicitudArtistaIndividual::findOrFail($id);

        try {
            // Mover los datos a la tabla artistas_individuales
            ArtistaIndividual::create([
                'departamento' => $solicitud->departamento,
                'provincia' => $solicitud->provincia,
                'municipio' => $solicitud->municipio,
                'comunidad' => $solicitud->comunidad,
                'domicilio' => $solicitud->domicilio,
                'ci' => $solicitud->ci,
                'expedido' => $solicitud->expedido,
                'sexo' => $solicitud->sexo,
                'nombres' => $solicitud->nombres,
                'apellidos' => $solicitud->apellidos,
                'lugar_nacimiento' => $solicitud->lugar_nacimiento,
                'fecha_nacimiento' => $solicitud->fecha_nacimiento,
                'telefono' => $solicitud->telefono,
                'celular' => $solicitud->celular,
                'correo' => $solicitud->correo,
                'antecedentes' => $solicitud->antecedentes,
                'categoria_id' => $solicitud->categoria_id,
                'sub_categoria_id' => $solicitud->sub_categoria_id,
                'especialidad1' => $solicitud->especialidad1,
                'biografia' => $solicitud->biografia,
                'fotografia' => $solicitud->fotografia,
                'ci_pdf' => $solicitud->ci_pdf,
                'cv' => $solicitud->cv,
            ]);

            // Eliminar la solicitud
            $solicitud->delete();

            return redirect()->route('admin.artistas_individuales.solicitudes.index')
                             ->with('success', 'La solicitud ha sido aprobada y registrada como artista.');
        } catch (\Exception $e) {
            return redirect()->route('admin.artistas_individuales.solicitudes.index')
                             ->with('error', 'Error al aprobar la solicitud: ' . $e->getMessage());
        }
    }
}


