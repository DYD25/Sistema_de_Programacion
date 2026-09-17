<?php

namespace App\Repositories;

use App\Models\Cargo;

class CargoRepository
{
    public function listar()
    {
        return Cargo::all();
    }

    public function registrarCargo(array $datos): void
    {
        Cargo::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'estado' => 1,
        ]);
    }

    public function actualizarCargo(array $datos): void
    {
        Cargo::where('id', $datos['id'])
            ->update([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
            ]);
    }
    
    public function actualizarEstadoCargo(array $datos): void
    {
        Cargo::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarCargo(string $id): void
    {
        Cargo::where('id', $id)->delete();
    }

}
