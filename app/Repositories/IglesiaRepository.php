<?php

namespace App\Repositories;

use App\Models\Iglesia;
use Illuminate\Support\Facades\Auth;

class IglesiaRepository
{

    public function obtenerTodas()
    {
        return Iglesia::orderBy('nombre')->where('estado', 1)->get();
    }

    public function listar()
    {
        return Iglesia::all();
    }

    public function registrarIglesia(array $datos): void
    {
        Iglesia::create([
            'nombre' => $datos['nombre'],
            'direccion' => $datos['direccion'],
            'ciudad' => $datos['ciudad'],
            'estado' => 1,
            'created_by'=>Auth::user()->id,
        ]);
    }

    public function actualizarIglesia(array $datos): void
    {
        Iglesia::where('id', $datos['id'])
            ->update([
                'nombre' => $datos['nombre'],
                'direccion' => $datos['direccion'],
                'ciudad' => $datos['ciudad'],
                'created_by'=>Auth::user()->id,
            ]);
    }
    
    public function actualizarEstadoIglesia(array $datos): void
    {
        Iglesia::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
                'created_by'=>Auth::user()->id,
            ]);
    }
    
    public function eliminarIglesia(string $id): void
    {
        Iglesia::where('id', $id)->delete();
    }
}