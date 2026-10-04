<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IglesiaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DirectivoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('seleccionar.iglesia')
        : redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::post('/iglesia/seleccionar', [IglesiaController::class, 'seleccionar'])->name('iglesia.seleccionar');

    Route::resource('iglesias', IglesiaController::class);
    Route::post('/consultar-datos-tabla-iglesia', [IglesiaController::class, 'data'])->name('data-iglesia');
    Route::post('/crear-iglesia', [IglesiaController::class, 'store'])->name('crear-iglesia');
    Route::post('/actualizar-iglesia', [IglesiaController::class, 'actualizar'])->name('actualizar-iglesia');
    Route::post('/estado-iglesia', [IglesiaController::class, 'estado'])->name('estado-iglesia');
    Route::post('/eliminar-iglesia', [IglesiaController::class, 'eliminar'])->name('eliminar-iglesia');
   
    Route::resource('areas', AreaController::class);
    Route::post('/consultar-datos-tabla-area', [AreaController::class, 'data'])->name('data-area');
    Route::post('/crear-area', [AreaController::class, 'store'])->name('crear-area');
    Route::post('/actualizar-area', [AreaController::class, 'actualizar'])->name('actualizar-area');
    Route::post('/estado-area', [AreaController::class, 'estado'])->name('estado-area'); 
    Route::post('/eliminar-area', [AreaController::class, 'eliminar'])->name('eliminar-area');
    Route::post('/consultar-areas', [AreaController::class, 'consultar'])->name('consultar-areas');
    Route::post('/asignar-areas', [AreaController::class, 'asignar'])->name('asignar-areas');


    Route::resource('personas-general', PersonaController::class);
    Route::post('/consultar-datos-tabla-persona', [PersonaController::class, 'data'])->name('data-persona');
    Route::post('/crear-persona', [PersonaController::class, 'store'])->name('crear-persona');
    Route::post('/actualizar-persona', [PersonaController::class, 'actualizar'])->name('actualizar-persona');
    Route::post('/estado-persona', [PersonaController::class, 'estado'])->name('estado-persona');
    Route::post('/eliminar-persona', [PersonaController::class, 'eliminar'])->name('eliminar-persona');

    Route::resource('personas', PersonaController::class);



    Route::resource('cargos', CargoController::class);
    Route::post('/consultar-datos-tabla-cargo', [CargoController::class, 'data'])->name('data-cargo');
    Route::post('/crear-cargo', [CargoController::class, 'store'])->name('crear-cargo');
    Route::post('/actualizar-cargo', [CargoController::class, 'actualizar'])->name('actualizar-cargo');
    Route::post('/estado-cargo', [CargoController::class, 'estado'])->name('estado-cargo');
    Route::post('/eliminar-cargo', [CargoController::class, 'eliminar'])->name('eliminar-cargo');

    Route::resource('administracion', AdministracionController::class);
    Route::post('/consultar-datos-tabla-usuario', [AdministracionController::class, 'data'])->name('data-usuario');
    Route::post('/crear-usuario', [AdministracionController::class, 'store'])->name('crear-usuario');
    Route::post('/actualizar-usuario', [AdministracionController::class, 'actualizar'])->name('actualizar-usuario');
    Route::post('/estado-usuario', [AdministracionController::class, 'estado'])->name('estado-usuario');
    Route::post('/eliminar-usuario', [AdministracionController::class, 'eliminar'])->name('eliminar-usuario');

    Route::post('/consultar-datos-tabla-rol', [RolController::class, 'data'])->name('data-rol');
    Route::post('/crear-rol', [RolController::class, 'store'])->name('crear-rol');
    Route::post('/actualizar-rol', [RolController::class, 'actualizar'])->name('actualizar-rol');
    Route::post('/estado-rol', [RolController::class, 'estado'])->name('estado-rol');
    Route::post('/eliminar-rol', [RolController::class, 'eliminar'])->name('eliminar-rol');

    Route::post('/consultar-datos-tabla-permiso', [PermisoController::class, 'data'])->name('data-permiso');
    Route::post('/consultar-permisos', [PermisoController::class, 'consultar'])->name('consultar-permiso');
    Route::post('/crear-permiso', [PermisoController::class, 'store'])->name('crear-permiso');
    Route::post('/actualizar-permiso', [PermisoController::class, 'actualizar'])->name('actualizar-permiso');
    Route::post('/estado-permiso', [PermisoController::class, 'estado'])->name('estado-permiso');
    Route::post('/eliminar-permiso', [PermisoController::class, 'eliminar'])->name('eliminar-permiso');


   

    Route::resource('directivos', DirectivoController::class);
    Route::post('/consultar-datos-tabla-directivo', [DirectivoController::class, 'data'])->name('data-directivo');
    Route::post('/crear-directivo', [DirectivoController::class, 'store'])->name('crear-directivo');
    Route::post('/actualizar-directivo', [DirectivoController::class, 'actualizar'])->name('actualizar-directivo');
    Route::post('/estado-directivo', [DirectivoController::class, 'estado'])->name('estado-directivo');
    Route::post('/eliminar-directivo', [DirectivoController::class, 'eliminar'])->name('eliminar-directivo');
    Route::post('/obtener-directivas', [DirectivoController::class, 'obtenerDirectivas'])->name('obtener-directivas');
    Route::post('/obtener-cargos', [DirectivoController::class, 'obtenerCargos'])->name('obtener-cargos');
    
   
  
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
