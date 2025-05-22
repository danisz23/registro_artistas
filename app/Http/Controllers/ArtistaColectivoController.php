<?php

namespace App\Http\Controllers;

use App\Models\ArtistaColectivo;
use App\Models\Representante;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\SolicitudArtistaColectivo;

class ArtistaColectivoController extends Controller
{
  public function index()
{
    $artistasColectivos = ArtistaColectivo::with(['representante', 'categoria', 'subcategoria'])->paginate(5);
    $categorias = Categoria::all();

    return view('admin.artistas_colectivos.index', compact('artistasColectivos', 'categorias'));
}
    public function create()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return view('admin.artistas_colectivos.create', compact('categorias'));
    }
public function store(Request $request)
{
    $request->validate([
        'departamento' => 'required|string',
        'provincia' => 'required|string',
        'municipio' => 'required|string',
        'comunidad' => 'required|string',
        'nombre_denominacion' => 'required|string',
        'integrantes' => 'required|array',
        'integrantes.*' => 'string',
        'periodo_act' => 'required|string',
        'telefono' => 'nullable|string',
        'celular' => 'required|string',
        'correo' => 'required|email',
        'categoria_id' => 'required|exists:categorias,id',
        'sub_categoria_id' => 'required|exists:subcategorias,id',
        'especialidad1' => 'required|string',
        'antecedentes_grupo' => 'required|string',
        'trayectoria' => 'required|string',
        'rep_nombres' => 'required|string',
        'rep_apellidos' => 'required|string',
        'rep_ci' => 'required|string',
        'rep_expedido' => 'required|string',
        'rep_lugar_nacimiento' => 'required|string',
        'rep_fecha_nacimiento' => 'required|date',
        'domicilio' => 'required|string',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        'ci_representante' => 'required|file|mimes:pdf|max:10000',
        'cv' => 'required|file|mimes:pdf|max:10000',
        'carta' => 'required|file|mimes:pdf|max:10000',
    ]);

    try {
        $logo = $request->file('logo')->store('logos', 'public');
        $ciPdf = $request->file('ci_representante')->store('docs', 'public');
        $cv = $request->file('cv')->store('docs', 'public');
        $carta = $request->file('carta')->store('docs', 'public');

        SolicitudArtistaColectivo::create([
            'departamento' => $request->departamento,
            'provincia' => $request->provincia,
            'municipio' => $request->municipio,
            'comunidad' => $request->comunidad,
            'nombre_denominacion' => $request->nombre_denominacion,
            'integrantes' => $request->integrantes,
            'periodo_act' => $request->periodo_act,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'correo' => $request->correo,
            'categoria_id' => $request->categoria_id,
            'sub_categoria_id' => $request->sub_categoria_id,
            'especialidad1' => $request->especialidad1,
            'antecedentes_grupo' => $request->antecedentes_grupo,
            'trayectoria' => $request->trayectoria,
            'logo' => $logo,
            'ci_representante' => $ciPdf,
            'cv' => $cv,
            'carta' => $carta,
            'representante' => [
                'nombres' => $request->rep_nombres,
                'apellidos' => $request->rep_apellidos,
                'ci' => $request->rep_ci,
                'expedido' => $request->rep_expedido,
                'lugar_nacimiento' => $request->rep_lugar_nacimiento,
                'fecha_nacimiento' => $request->rep_fecha_nacimiento,
                'domicilio' => $request->domicilio,
            ],
        ]);

        return redirect()->route('admin.artistas_colectivos.solicitudes.index')
            ->with('mensaje', 'Solicitud creada correctamente.')
            ->with('icono', 'success');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('mensaje', 'Ocurrió un error al guardar: ' . $e->getMessage())
            ->with('icono', 'error')
            ->withInput();
    }
}


    public function show($id)
    {
      

    
    if (!$artista) {
        abort(404, 'No se encontró el artista.');
    }


        $artista = ArtistaColectivo::find($id);
        $representante = Representante::findOrFail($artista->representante_id);
        $categorias = Categoria::all();
        $integrantes = json_decode($artista->integrantes, true);
        return view('admin.artistas_colectivos.show', compact('artista', 'representante', 'categorias','integrantes'));
    }
    public function edit($id)
        {
            // Buscar el artista colectivo y el representante por su ID
            $artistaColectivo = ArtistaColectivo::findOrFail($id);
            $representante = Representante::findOrFail($artistaColectivo->representante_id);
            
            // Obtener todas las categorías
            $categorias = Categoria::all();
        
            // Pasar los datos a la vista de edición
            return view('admin.artistas_colectivos.edit', compact('artistaColectivo', 'representante', 'categorias'));
        }
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'departamento' => 'required|string',
            'provincia' => 'required|string',
            'municipio' => 'required|string',
            'comunidad' => 'required|string',
            'nombre_denominacion' => 'required|string',
            'integrantes' => 'required|array|min:1',
            'integrantes.*' => 'required|string|max:255',
            'periodo_act' => 'required|string|max:1200',
            'telefono' => 'nullable|string',
            'celular' => 'required|string',
            'correo' => 'required|email',
            'categoria_id' => 'required|exists:categorias,id',
            'sub_categoria_id' => 'required|exists:subcategorias,id',
            'especialidad1' => 'required|string',
            'antecedentes_grupo' => 'required|string|max:500',
            'trayectoria' => 'required|string|max:1200',
            'rep_nombres' => 'required|string',
            'rep_apellidos' => 'required|string',
            'rep_ci' => 'required|string',
            'rep_expedido' => 'required|string',
            'rep_lugar_nacimiento' => 'required|string',
            'rep_fecha_nacimiento' => 'required|date',
            'domicilio' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'ci_representante' => 'nullable|file|mimes:pdf|max:10000',
            'cv' => 'nullable|file|mimes:pdf|max:10000',
            'carta' => 'nullable|file|mimes:pdf|max:1000',
        ]);
        DB::beginTransaction();
        try {
            // Obtener el artista colectivo y representante por su ID
            $artistaColectivo = ArtistaColectivo::findOrFail($id);
            $representante = Representante::findOrFail($artistaColectivo->representante_id);
            // Verificar si se suben nuevos archivos y actualizarlos
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('logos', 'public');
            } else {
                $logo = $artistaColectivo->logo;
            }
            if ($request->hasFile('ci_representante')) {
                $ciPdf = $request->file('ci_representante')->store('docs', 'public');
            } else {
                $ciPdf = $artistaColectivo->ci_representante;
            }
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv')->store('docs', 'public');
            } else {
                $cv = $artistaColectivo->cv;
            }
            if ($request->hasFile('carta')) {
                $carta = $request->file('carta')->store('docs', 'public');
            } else {
                $carta = $artistaColectivo->carta;
            }
            // Actualizar representante
            $representante->update([
                'nombres' => $request->rep_nombres,
                'apellidos' => $request->rep_apellidos,
                'ci' => $request->rep_ci,
                'expedido' => $request->rep_expedido,
                'lugar_nacimiento' => $request->rep_lugar_nacimiento,
                'fecha_nacimiento' => $request->rep_fecha_nacimiento,
                'domicilio' => $request->domicilio,
            ]);
            // Actualizar artista colectivo
            $artistaColectivo->update([
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'municipio' => $request->municipio,
                'comunidad' => $request->comunidad,
                'nombre_denominacion' => $request->nombre_denominacion,
                'integrantes' => json_encode($request->integrantes),
                'periodo_act' => $request->periodo_act,
                'telefono' => $request->telefono,
                'celular' => $request->celular,
                'correo' => $request->correo,
                'categoria_id' => $request->categoria_id,
                'sub_categoria_id' => $request->sub_categoria_id,
                'especialidad1' => $request->especialidad1,
                'antecedentes_grupo' => $request->antecedentes_grupo,
                'trayectoria' => $request->trayectoria,
                'logo' => $logo,
                'ci_representante' => $ciPdf,
                'cv' => $cv,
                'carta' => $carta,
            ]);
            DB::commit();
            // Redirigir con mensaje de éxito
            return redirect()->route('admin.artistas_colectivos.index')
                ->with('mensaje', 'Registro actualizado correctamente.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            // Redirigir con mensaje de error
            return redirect()->route('admin.artistas_colectivos.index')
                ->with('mensaje', 'Ocurrió un error al actualizar: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }
    public function destroy($id)
    {
        $artista = ArtistaColectivo::findOrFail($id);

        Storage::delete([
            'public/' . $artista->logo,
            'public/' . $artista->ci_representante,
            'public/' . $artista->cv,
            'public/' . $artista->carta,
        ]);

        $representante = $artista->representante;
        $artista->delete();

        if ($representante) {
            $representante->delete();
        }

        return redirect()->route('admin.artistas_colectivos.index')->with('success', 'Registro eliminado correctamente.');
    }
    public function show_f($id)
    {
        $artista = ArtistaColectivo::findOrFail($id);
        return view('admin.artistas_colectivos.formulario', compact('artista'));
    }
    public function mostrarCredencial($id)
    {
        $artista = ArtistaColectivo::with(['categoria', 'subcategoria'])->findOrFail($id);
        return view('admin.artistas_colectivos.credencial', compact('artista'));
    }
    public function getSubcategorias($categoriaId)
    {
        // Obtener las subcategorías asociadas a la categoría
        $categoria = Categoria::with('subcategorias')->find($categoriaId);

        if ($categoria) {
            return response()->json(['subcategorias' => $categoria->subcategorias]);
        }

        return response()->json(['subcategorias' => []]);
    }
}
