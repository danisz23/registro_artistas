<?php

namespace App\Http\Controllers;

use App\Models\ArtistaIndividual;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SolicitudArtistaIndividual;

class ArtistaIndividualController extends Controller
{
public function index(Request $request)
{
    $query = ArtistaIndividual::with('categoria', 'subcategoria');

    if ($request->filled('ci+')) {
        $query->where('ci', $request->ci);
    }
    foreach (['ci', 'nombres', 'apellidos', 'departamento'] as $field) {
        if ($request->filled($field)) {
            $query->where($field, 'like', '%' . $request->$field . '%');
        }
    }

    if ($request->filled('sexo')) {
        $query->where('sexo', $request->sexo);
    }

    if ($request->filled('fecha_emision')) {
        $query->whereDate('fecha_emision', $request->fecha_emision);
    }

    if ($request->filled('categoria_id')) {
        $query->where('categoria_id', $request->categoria_id);
    }

    if ($request->filled('sub_categoria_id')) {
        $query->where('sub_categoria_id', $request->sub_categoria_id);
    }

    $artistas = $query->paginate(10);
    $categorias = Categoria::all();

    return view('admin.artistas_individuales.index', compact('artistas', 'categorias'));
}


    // Mostrar formulario para crear nuevo artista
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('admin.artistas_individuales.create', compact('categorias', 'subcategorias'));
    }

    // Guardar nuevo artista
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validaciones igual que antes
            'departamento' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'comunidad' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'expedido' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'lugar_nacimiento' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|unique:solicitudes_artistas_individuales,correo',
            'antecedentes' => 'required|string|max:250',
            'categoria_id' => 'required|exists:categorias,id',
            'sub_categoria_id' => 'required|exists:subcategorias,id',
            'especialidad1' => 'required|string|max:255',
            'biografia' => 'required|string|max:250',
            'fotografia' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'ci_pdf' => 'required|mimes:pdf|max:10000',
            'cv' => 'required|mimes:pdf|max:10000',
        ]);

        $paths = $this->handleFileUploads($request);

        try {
            // Guardar en tabla de solicitudes
            SolicitudArtistaIndividual::create(array_merge(
                $validated,
                $paths,
                ['estado' => 'pendiente']
            ));

            return redirect()->route('solicitudes.artistas_individuales.index')
                ->with('mensaje', 'La solicitud fue enviada exitosamente y está pendiente de revisión.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('mensaje', 'Hubo un error al enviar la solicitud: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    private function handleFileUploads(Request $request)
    {
        return [
            'fotografia' => $request->file('fotografia')->store('fotografias', 'public'),
            'ci_pdf' => $request->file('ci_pdf')->store('documentos/ci', 'public'),
            'cv' => $request->file('cv')->store('documentos/cv', 'public'),
        ];
    }

    // Mostrar un artista específico
    public function show($id)
    {
        $artista = ArtistaIndividual::findOrFail($id);
        return view('admin.artistas_individuales.show', compact('artista'));
    }
    public function show_f($id)
    {
        $artista = ArtistaIndividual::findOrFail($id);
        return view('admin.artistas_individuales.formulario', compact('artista'));
    }
    public function mostrarCredencial($id)
    {
        $artista = ArtistaIndividual::with(['categoria', 'subcategoria'])->findOrFail($id);
        return view('admin.artistas_individuales.credencial', compact('artista'));
    }
    // Mostrar formulario de edición
    public function edit($id)
    {
        $artista = ArtistaIndividual::findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('admin.artistas_individuales.edit', compact('artista', 'categorias', 'subcategorias'));
    }

    // Actualizar datos del artista
    public function update(Request $request, ArtistaIndividual $artista)
    {
        $validated = $request->validate([
            'departamento' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'comunidad' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'ci' => 'required|string|max:255',
            'expedido' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'lugar_nacimiento' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|unique:artistas_individuales,correo,' . $artista->id,
            'antecedentes' => 'required|string|max:250',
            'categoria_id' => 'required|exists:categorias,id',
            'sub_categoria_id' => 'required|exists:subcategorias,id',
            'especialidad1' => 'required|string|max:255',
            'biografia' => 'required|string|max:250',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'ci_pdf' => 'nullable|mimes:pdf|max:1024',
            'cv' => 'nullable|mimes:pdf|max:2048',
        ]);

        try {
            $artista->update($validated);

            if ($request->hasFile('fotografia') || $request->hasFile('ci_pdf') || $request->hasFile('cv')) {
                $filePaths = $this->handleFileUploads($request);
                $artista->update($filePaths);
            }

            return redirect()->route('admin.artistas_individuales.index')->with('success', 'El artista individual ha sido actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.artistas_individuales.index')->with('error', 'Hubo un error al actualizar el artista: ' . $e->getMessage());
        }
    }

    // Eliminar artista
    public function destroy($id)
    {
        try {
            // Encontrar al artista individual por ID
            $artista = ArtistaIndividual::findOrFail($id);
    
            // Eliminar los archivos asociados al artista individual
            Storage::delete([
                'public/' . $artista->fotografia,  // Fotografía del artista
                'public/' . $artista->ci_pdf,      // PDF de la cédula de identidad
                'public/' . $artista->cv,          // Currículum Vitae (PDF)
            ]);
    
            // Eliminar al artista individual
            $artista->delete();
    
            // Si existe un representante (relación opcional), eliminarlo también
            $representante = $artista->representante; // Esto depende de la relación que tengas configurada
            if ($representante) {
                $representante->delete(); // Eliminar el representante si existe
            }
    
            // Retornar con mensaje de éxito
            return redirect()->route('admin.artistas_individuales.index')
                             ->with('success', 'El artista individual ha sido eliminado exitosamente.');
        } catch (\Exception $e) {
            // Capturar errores y redirigir con mensaje de error
            return redirect()->route('admin.artistas_individuales.index')
                             ->with('error', 'Hubo un error al eliminar el artista: ' . $e->getMessage());
        }
    }
    
    public function getSubcategorias(Request $request)
{
    // Obtener las subcategorías que corresponden a la categoría seleccionada
    $subcategorias = SubCategoria::where('categoria_id', $request->categoria_id)->get();
    
    // Retornar las subcategorías en formato JSON
    return response()->json($subcategorias);
}
}
