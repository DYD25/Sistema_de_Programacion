<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IglesiaController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\DirectivaController;

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
        return view('inicio.inicio');
    })->name('dashboard');

     Route::post('/iglesia/seleccionar', [IglesiaController::class, 'seleccionar'])
        ->name('iglesia.seleccionar');

    Route::resource('miembros', MiembroController::class);
    Route::post('/consultar-datos-tabla', [MiembroController::class, 'data'])->name('data');
    Route::post('/crear', [MiembroController::class, 'store'])->name('crear');
    Route::post('/actualizar', [MiembroController::class, 'actualizar'])->name('actualizar');
    Route::post('/estado', [MiembroController::class, 'estado'])->name('estado');
    Route::post('/eliminar', [MiembroController::class, 'eliminar'])->name('eliminar');

    
    Route::resource('directivas', DirectivaController::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
