<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistaIndividualController;
use App\Http\Controllers\ArtistaColectivoController;
use App\Http\Controllers\SolicitudColectivoController;
use App\Http\Controllers\SolicitudArtistaIndividualController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran todas las rutas web de la aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro del grupo "web".
|--------------------------------------------------------------------------
*/

// Página de bienvenida (pública)
Route::get('/', function () {
    return view('home');
});

// Rutas de autenticación
Auth::routes();

// Página de inicio tras el login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Ruta para obtener subcategorías según categoría
Route::get('/subcategorias/{categoriaId}', [ArtistaColectivoController::class, 'getSubcategorias']);

// Panel administrativo (rutas protegidas)
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    
    // Panel de administración (dashboard)
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // CRUD de usuarios
    Route::resource('users', UserController::class);

    // Rutas para gestionar solicitudes de artistas colectivos (antes del resource)
    Route::prefix('artistas_colectivos')->name('artistas_colectivos.')->group(function () {
        // Listado de solicitudes pendientes
        Route::get('solicitudes', [SolicitudColectivoController::class, 'index'])->name('solicitudes.index');

        // Ver detalles de una solicitud
        Route::get('solicitudes/{id}', [SolicitudColectivoController::class, 'show'])->name('solicitudes.show');

        // Aprobar una solicitud
        Route::post('solicitudes/aprobar/{id}', [SolicitudColectivoController::class, 'aprobar'])->name('solicitudes.aprobar');

        // Rechazar una solicitud
        Route::post('solicitudes/rechazar/{id}', [SolicitudColectivoController::class, 'rechazar'])->name('solicitudes.rechazar');
    });
    Route::prefix('artistas_individuales')->name('artistas_individuales.')->group(function () {
        // Listado de solicitudes pendientes
        Route::get('solicitudes', [SolicitudArtistaIndividualController::class, 'index'])->name('solicitudes.index');

        // Ver detalles de una solicitud
        Route::get('solicitudes/{id}', [SolicitudArtistaIndividualController::class, 'show'])->name('solicitudes.show');

        // Aprobar una solicitud
        Route::post('solicitudes/aprobar/{id}', [SolicitudArtistaIndividualController::class, 'aprobar'])->name('solicitudes.aprobar');

        // Rechazar una solicitud
        Route::post('solicitudes/rechazar/{id}', [SolicitudArtistaIndividualController::class, 'rechazar'])->name('solicitudes.rechazar');
    });
    // CRUD de artistas individuales
    Route::get('artistas_individuales/{id}/formulario', [ArtistaIndividualController::class, 'show_f'])->name('artistas_individuales.formulario');
    Route::get('artistas_individuales/{id}/credencial', [ArtistaIndividualController::class, 'mostrarCredencial'])->name('artistas_individuales.credencial');
    Route::resource('artistas_individuales', ArtistaIndividualController::class);

    // CRUD de artistas colectivos (debe ir después de las rutas personalizadas)
    Route::get('artistas_colectivos/{id}/formulario', [ArtistaColectivoController::class, 'show_f'])->name('artistas_colectivos.formulario');
    Route::get('artistas_colectivos/{id}/credencial', [ArtistaColectivoController::class, 'mostrarCredencial'])->name('artistas_colectivos.credencial');
    Route::resource('artistas_colectivos', ArtistaColectivoController::class);
});

