<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;

class ContextoService
{

    public function usuario()
    {
        return Auth::user();
    }

    public function obtenerUsuario()
    {
        return auth()->user();
    }

    public function obtenerIglesiaId(): ?int
    {
        $id = session('iglesia_id');

        if (!$id) {
            throw new Exception('Debe seleccionar una iglesia.');
        }

        return $id;
    }

    public function tieneIglesiaSeleccionada(): bool
    {
        return session()->has('iglesia_id');
    }
}
