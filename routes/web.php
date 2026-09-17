<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\IglesiaController;
use App\Http\Controllers\DirectivaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DirectivoController;
use App\Http\Controllers\MiembroController;

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

    Route::resource('usuarios', UsuarioController::class);
    Route::post('/consultar-datos-tabla-usuario', [UsuarioController::class, 'data'])->name('data-usuario');
    Route::post('/crear-usuario', [UsuarioController::class, 'store'])->name('crear-usuario');
    Route::post('/actualizar-usuario', [UsuarioController::class, 'actualizar'])->name('actualizar-usuario');
    Route::post('/estado-usuario', [UsuarioController::class, 'estado'])->name('estado-usuario');
    Route::post('/eliminar-usuario', [UsuarioController::class, 'eliminar'])->name('eliminar-usuario');

    Route::resource('roles', RolController::class);
    Route::post('/consultar-datos-tabla-role', [RolController::class, 'data'])->name('data-role');
    Route::post('/crear-role', [RolController::class, 'store'])->name('crear-role');
    Route::post('/actualizar-role', [RolController::class, 'actualizar'])->name('actualizar-role');
    Route::post('/estado-role', [RolController::class, 'estado'])->name('estado-role');
    Route::post('/eliminar-role', [RolController::class, 'eliminar'])->name('eliminar-role');

    Route::resource('permisos', PermisoController::class);
    Route::post('/consultar-datos-tabla-periso', [PermisoController::class, 'data'])->name('data-periso');
    Route::post('/crear-periso', [PermisoController::class, 'store'])->name('crear-periso');
    Route::post('/actualizar-periso', [PermisoController::class, 'actualizar'])->name('actualizar-periso');
    Route::post('/estado-periso', [PermisoController::class, 'estado'])->name('estado-periso');
    Route::post('/eliminar-periso', [PermisoController::class, 'eliminar'])->name('eliminar-periso');

    Route::resource('iglesias', IglesiaController::class);
    Route::post('/consultar-datos-tabla-iglesia', [IglesiaController::class, 'data'])->name('data-iglesia');
    Route::post('/crear-iglesia', [IglesiaController::class, 'store'])->name('crear-iglesia');
    Route::post('/actualizar-iglesia', [IglesiaController::class, 'actualizar'])->name('actualizar-iglesia');
    Route::post('/estado-iglesia', [IglesiaController::class, 'estado'])->name('estado-iglesia');
    Route::post('/eliminar-iglesia', [IglesiaController::class, 'eliminar'])->name('eliminar-iglesia');
   
    Route::resource('directivas', DirectivaController::class);
    Route::post('/consultar-datos-tabla-directiva', [DirectivaController::class, 'data'])->name('data-directiva');
    Route::post('/crear-directiva', [DirectivaController::class, 'store'])->name('crear-directiva');
    Route::post('/actualizar-directiva', [DirectivaController::class, 'actualizar'])->name('actualizar-directiva');
    Route::post('/estado-directiva', [DirectivaController::class, 'estado'])->name('estado-directiva'); 
    Route::post('/eliminar-directiva', [DirectivaController::class, 'eliminar'])->name('eliminar-directiva');
 
    Route::resource('cargos', CargoController::class);
    Route::post('/consultar-datos-tabla-cargo', [CargoController::class, 'data'])->name('data-cargo');
    Route::post('/crear-cargo', [CargoController::class, 'store'])->name('crear-cargo');
    Route::post('/actualizar-cargo', [CargoController::class, 'actualizar'])->name('actualizar-cargo');
    Route::post('/estado-cargo', [CargoController::class, 'estado'])->name('estado-cargo');
    Route::post('/eliminar-cargo', [CargoController::class, 'eliminar'])->name('eliminar-cargo');

   

    Route::resource('directivos', DirectivoController::class);
    Route::post('/consultar-datos-tabla-directivo', [DirectivoController::class, 'data'])->name('data-directivo');
    Route::post('/crear-directivo', [DirectivoController::class, 'store'])->name('crear-directivo');
    Route::post('/actualizar-directivo', [DirectivoController::class, 'actualizar'])->name('actualizar-directivo');
    Route::post('/estado-directivo', [DirectivoController::class, 'estado'])->name('estado-directivo');
    Route::post('/eliminar-directivo', [DirectivoController::class, 'eliminar'])->name('eliminar-directivo');
    Route::post('/obtener-directivas', [DirectivoController::class, 'obtenerDirectivas'])->name('obtener-directivas');
    Route::post('/obtener-cargos', [DirectivoController::class, 'obtenerCargos'])->name('obtener-cargos');
    
    Route::resource('miembros', MiembroController::class);
    Route::post('/consultar-datos-tabla-miembro', [MiembroController::class, 'data'])->name('data-miembro');
    Route::post('/crear-miembro', [MiembroController::class, 'store'])->name('crear-miembro');
    Route::post('/actualizar-miembro', [MiembroController::class, 'actualizar'])->name('actualizar-miembro');
    Route::post('/estado-miembro', [MiembroController::class, 'estado'])->name('estado-miembro');
    Route::post('/eliminar-miembro', [MiembroController::class, 'eliminar'])->name('eliminar-miembro');
  
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
