<?php

namespace App\Repositories;

use App\Models\Iglesia;

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
        ]);
    }

    public function actualizarIglesia(array $datos): void
    {
        Iglesia::where('id', $datos['id'])
            ->update([
                'nombre' => $datos['nombre'],
                'direccion' => $datos['direccion'],
                'ciudad' => $datos['ciudad'],
            ]);
    }
    
    public function actualizarEstadoIglesia(array $datos): void
    {
        Iglesia::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarIglesia(string $id): void
    {
        Iglesia::where('id', $id)->delete();
    }
}