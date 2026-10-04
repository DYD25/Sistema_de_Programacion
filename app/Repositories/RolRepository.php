<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function listar()
    {
        return Rol::all();
    }

    public function registrarRol(array $datos): void
    {
        Rol::create([
            'nombre' => $datos['nombre-rol'],
            'descripcion' => $datos['descripcion-rol'],
            'estado' => 1,
        ]);
    }

    public function actualizarRol(array $datos): void
    {
        Rol::where('id', $datos['id'])
            ->update([
                'nombre' => $datos['nombre-rol'],
                'descripcion' => $datos['descripcion-rol'],
            ]);
    }
    
    public function actualizarEstadoRol(array $datos): void
    {
        Rol::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarRol(string $id): void
    {
        Rol::where('id', $id)->delete();
    }

}
