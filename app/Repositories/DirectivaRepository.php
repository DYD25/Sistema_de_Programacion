<?php

namespace App\Repositories;

use App\Models\Directiva;

class DirectivaRepository
{
    public function listar()
    {
        return Directiva::all();
    }

    public function registrarDirectiva(array $datos, string $id_iglesia): void
    {
        Directiva::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'iglesia_id' => $id_iglesia,
            'estado' => 1,
        ]);
    }

    public function actualizarDirectiva(array $datos, string  $id_iglesia): void
    {
        Directiva::where('id', $datos['id'])
            ->where('iglesia_id', $id_iglesia)
            ->update([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
            ]);
    }
    
    public function actualizarEstadoDirectiva(array $datos): void
    {
        Directiva::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarDirectiva(string $id): void
    {
        Directiva::where('id', $id)->delete();
    }

}
