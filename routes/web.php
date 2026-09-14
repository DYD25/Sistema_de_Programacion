<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IglesiaController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\DirectivaMiembroController;

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

     Route::post('/iglesia/seleccionar', [IglesiaController::class, 'seleccionar'])
        ->name('iglesia.seleccionar');

    Route::resource('miembros', MiembroController::class);
    Route::post('/consultar-datos-tabla-miembro', [MiembroController::class, 'data'])->name('data-miembro');
    Route::post('/crear-miembro', [MiembroController::class, 'store'])->name('crear-miembro');
    Route::post('/actualizar-miembro', [MiembroController::class, 'actualizar'])->name('actualizar-miembro');
    Route::post('/estado-miembro', [MiembroController::class, 'estado'])->name('estado-miembro');
    Route::post('/eliminar-miembro', [MiembroController::class, 'eliminar'])->name('eliminar-miembro');
    
    Route::resource('directivas', DirectivaMiembroController::class);
    Route::post('/consultar-datos-tabla-directiva', [DirectivaMiembroController::class, 'data'])->name('data-directiva');
    Route::post('/crear-directiva', [DirectivaMiembroController::class, 'store'])->name('crear-directiva');
    Route::post('/actualizar-directiva', [DirectivaMiembroController::class, 'actualizar'])->name('actualizar-directiva');
    Route::post('/estado-directiva', [DirectivaMiembroController::class, 'estado'])->name('estado-directiva');
    Route::post('/eliminar-directiva', [DirectivaMiembroController::class, 'eliminar'])->name('eliminar-directiva');
    Route::post('/obtener-directivas', [DirectivaMiembroController::class, 'obtenerDirectivas'])->name('obtener-directivas');
    Route::post('/obtener-cargos', [DirectivaMiembroController::class, 'obtenerCargos'])->name('obtener-cargos');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
