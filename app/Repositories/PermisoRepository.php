<?php

namespace App\Repositories;

use App\Models\Permiso;

class PermisoRepository
{
    public function listar()
    {
        return Permiso::all();
    }
  
    public function listarPermisos()
    {
        return Permiso::select('id', 'nombre')->get()->toArray();
    }

    public function registrarPermiso(array $datos): void
    {
        Permiso::create([
            'nombre' => $datos['nombre-permiso'],
            'descripcion' => $datos['descripcion-permiso'],
            'estado' => 1,
        ]);
    }
  
    public function actualizarPermiso(array $datos): void
    {
        Permiso::where('id', $datos['id'])
            ->update([
                'nombre' => $datos['nombre-permiso'],
                'descripcion' => $datos['descripcion-permiso'],
            ]);
    }
    
    public function actualizarEstadoPermiso(array $datos): void
    {
        Permiso::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarPermiso(string $id): void
    {
        Permiso::where('id', $id)->delete();
    }

}
