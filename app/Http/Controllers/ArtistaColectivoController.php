<?php
namespace App\Http\Controllers;

use App\Models\ArtistaColectivo;
use App\Models\Representante;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\SolicitudArtistaColectivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArtistaColectivoController extends Controller
{
    // Aplicar middleware para proteger rutas
    public function __construct()
    {
        // Por ejemplo, solo usuarios autenticados
        $this->middleware('auth');

        // Puedes aplicar políticas o middleware específicos para admin en rutas CRUD
        // $this->middleware('can:manage-artistas')->except(['perfil']);
    }

    public function index()
    {
        // Listar artistas colectivos aprobados con relaciones
        $artistasColectivos = ArtistaColectivo::with(['representante', 'categoria', 'subcategoria'])
            ->paginate(5);
        $categorias = Categoria::all();

        return view('admin.artistas_colectivos.index', compact('artistasColectivos', 'categorias'));
    }

    public function create()
    {
        // Crear nueva solicitud - traer categorías con subcategorías
        $categorias = Categoria::with('subcategorias')->get();
        return view('admin.artistas_colectivos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'departamento' => 'required|string',
            'provincia' => 'required|string',
            'municipio' => 'required|string',
            'comunidad' => 'required|string',
            'nombre_denominacion' => 'required|string',
            'integrantes' => 'required|array|min:1',
            'integrantes.*' => 'string|max:255',
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

        DB::beginTransaction();

        try {
            // Guardar archivos
            $logo = $request->file('logo')->store('logos', 'public');
            $ciPdf = $request->file('ci_representante')->store('docs', 'public');
            $cv = $request->file('cv')->store('docs', 'public');
            $carta = $request->file('carta')->store('docs', 'public');

            // Crear solicitud con datos
            $solicitud = SolicitudArtistaColectivo::create([
                'departamento' => $request->departamento,
                'provincia' => $request->provincia,
                'municipio' => $request->municipio,
                'comunidad' => $request->comunidad,
                'nombre_denominacion' => $request->nombre_denominacion,
                'integrantes' => json_encode($request->integrantes), // siempre codifica antes de guardar
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
                'user_id' => Auth::id(),
                // Guardar representante como JSON (si tu tabla lo soporta) o en tabla aparte
                'representante' => json_encode([
                    'nombres' => $request->rep_nombres,
                    'apellidos' => $request->rep_apellidos,
                    'ci' => $request->rep_ci,
                    'expedido' => $request->rep_expedido,
                    'lugar_nacimiento' => $request->rep_lugar_nacimiento,
                    'fecha_nacimiento' => $request->rep_fecha_nacimiento,
                    'domicilio' => $request->domicilio,
                ]),
            ]);

            DB::commit();

            return redirect()->route('admin.artistas_colectivos.solicitudes.index')
                ->with('mensaje', 'Solicitud creada correctamente.')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('mensaje', 'Ocurrió un error al guardar: ' . $e->getMessage())
                ->with('icono', 'error')
                ->withInput();
        }
    }

    public function show($id)
    {
        // Mostrar artista colectivo con relaciones cargadas
        $artista = ArtistaColectivo::with('representante', 'categoria', 'subcategoria')->findOrFail($id);
        $integrantes = json_decode($artista->integrantes, true);

        return view('admin.artistas_colectivos.show', compact('artista', 'integrantes'));
    }

    public function edit($id)
    {
        // Obtener artista y representante para edición
        $artistaColectivo = ArtistaColectivo::with('representante')->findOrFail($id);
        $categorias = Categoria::all();

        return view('admin.artistas_colectivos.edit', compact('artistaColectivo', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validación datos
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
            'carta' => 'nullable|file|mimes:pdf|max:10000',
        ]);

        DB::beginTransaction();

        try {
            $artistaColectivo = ArtistaColectivo::with('representante')->findOrFail($id);

            // Manejo de archivos: solo actualiza si vienen nuevos
            $logo = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : $artistaColectivo->logo;
            $ciPdf = $request->hasFile('ci_representante') ? $request->file('ci_representante')->store('docs', 'public') : $artistaColectivo->ci_representante;
            $cv = $request->hasFile('cv') ? $request->file('cv')->store('docs', 'public') : $artistaColectivo->cv;
            $carta = $request->hasFile('carta') ? $request->file('carta')->store('docs', 'public') : $artistaColectivo->carta;

            // Actualizar representante
            $artistaColectivo->representante->update([
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

            return redirect()->route('admin.artistas_colectivos.index')
                ->with('mensaje', 'Registro actualizado correctamente.')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.artistas_colectivos.index')
                ->with('mensaje', 'Ocurrió un error al actualizar: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    public function destroy($id)
    {
        $artista = ArtistaColectivo::with('representante')->findOrFail($id);

        // Borrar archivos usando disco 'public'
        Storage::disk('public')->delete([
            $artista->logo,
            $artista->ci_representante,
            $artista->cv,
            $artista->carta,
        ]);

        // Borrar representante y artista
        if ($artista->representante) {
            $artista->representante->delete();
        }

        $artista->delete();

        return redirect()->route('admin.artistas_colectivos.index')
            ->with('mensaje', 'Registro eliminado correctamente.')
            ->with('icono', 'success');
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
        $categoria = Categoria::with('subcategorias')->find($categoriaId);
        if ($categoria) {
            return response()->json(['subcategorias' => $categoria->subcategorias]);
        }
        return response()->json(['subcategorias' => []]);
    }

    public function perfil()
    {
        $user = Auth::user();

        $registro = ArtistaColectivo::where('user_id', $user->id)->first();
        $solicitud = SolicitudArtistaColectivo::where('user_id', $user->id)->latest()->first();

        return view('artistas_colectivos.PerfilEstadoColectivo', compact('registro', 'solicitud'));
    }
}
