<?php

namespace App\Repositories;

use App\Models\Cargo;
use Illuminate\Support\Facades\Auth;


class CargoRepository
{
    public function listar(string $id_iglesia): array
    {
        return Cargo::where(function ($query) use ($id_iglesia) {
        $query
        ->orWhereNull('iglesia_id')
        ->orWhere('iglesia_id', $id_iglesia)
        ->orWhere('iglesia_id', '');
        })->get()->toArray();
    }

    public function registrarCargo(array $datos, string $id_iglesia): void
    {
        Cargo::create([
            'iglesia_id' => $id_iglesia,
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'estado' => 1,    
            'created_by'=>Auth::user()->id,
        ]);
    }

    public function actualizarCargo(array $datos, string $id_iglesia): void
    {
        Cargo::where('id', $datos['id'])
            ->where('iglesia_id', $id_iglesia)
            ->update([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'created_by'=>Auth::user()->id,
            ]);
    }
    
    public function actualizarEstadoCargo(array $datos): void
    {
        Cargo::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
                'created_by'=>Auth::user()->id, 
            ]);
    }
    
    public function eliminarCargo(string $id, string $id_iglesia): void
    {
        Cargo::where('id', $id)
            ->where('iglesia_id', $id_iglesia)
            ->delete();
    }

    public function listarCargos(string $id_iglesia): array
    {
        return Cargo::where(function ($query) use ($id_iglesia) {
        $query
        ->orWhereNull('iglesia_id')
        ->orWhere('iglesia_id', $id_iglesia)
        ->orWhere('iglesia_id', '');
        })->orderBy('nombre')
        ->where('estado', 1)
            ->get()->toArray();
    }

}
