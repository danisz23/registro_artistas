<?php

namespace App\Http\Controllers;

use App\Models\ArtistaIndividual;
use App\Models\ArtistaColectivo;
use App\Models\SolicitudArtistaIndividual;
use App\Models\SolicitudArtistaColectivo;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
{
    // Contadores de estado
    $aprobadosIndividuales = ArtistaIndividual::count();
    $aprobadosColectivos = ArtistaColectivo::count();

    $totalArtistas = $aprobadosIndividuales + $aprobadosColectivos;

    $pendientes = SolicitudArtistaIndividual::where('estado', 'pendiente')->count()
                + SolicitudArtistaColectivo::where('estado', 'pendiente')->count();

    $rechazados = SolicitudArtistaIndividual::where('estado', 'rechazado')->count()
                + SolicitudArtistaColectivo::where('estado', 'rechazado')->count();

    // Últimos registros aprobados (mezclados)
    $individuales = ArtistaIndividual::select('id', 'nombres', 'apellidos', 'estado', 'created_at')
        ->get()
        ->map(function ($item) {
            $item->tipo = 'individual';
            return $item;
        });

    $colectivos = ArtistaColectivo::select('id', 'nombre_denominacion', 'estado', 'created_at')
        ->get()
        ->map(function ($item) {
            $item->tipo = 'colectivo';
            return $item;
        });

    $ultimosRegistros = $individuales
        ->merge($colectivos)
        ->sortByDesc('created_at')
        ->take(5);

    return view('admin.dashboard', compact(
        'totalArtistas',
        'aprobadosIndividuales',
        'aprobadosColectivos',
        'pendientes',
        'rechazados',
        'ultimosRegistros'
    ));
}
public function estadisticas()
{
    $mesActual = Carbon::now()->month;
    $anioActual = Carbon::now()->year;

    $artistasPorDepartamento = DB::table('artistas_individuales')
        ->select('departamento', DB::raw('COUNT(*) as total'))
        ->whereMonth('created_at', $mesActual)
        ->whereYear('created_at', $anioActual)
        ->groupBy('departamento')
        ->get();

    return response()->json($artistasPorDepartamento);
}

public function verEstadisticas()
{
    return view('admin.estadisticas');
}
 

}
