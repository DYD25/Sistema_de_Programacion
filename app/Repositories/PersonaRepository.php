<?php

namespace App\Repositories;

use App\Models\Persona;
use App\Models\PersonaArea;
use Illuminate\Support\Facades\DB;

class PersonaRepository
{
    public function listar(string $id_iglesia)
    {
        return Persona::select(
            'id',
            'nombres',
            'apellidos',
            'telefono',
            'fecha_nacimiento',
            'estado',
        )
            ->with('areas:id,nombre')
            ->withCount('areas')
            ->where('iglesia_id', $id_iglesia)
            ->get();
    }

    public function guardarPersonas(array $data, string $id_iglesia): void
    {
        Persona::create([
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'telefono' => $data['telefono'],
            'estado' => 1,
            'iglesia_id' => $id_iglesia,
            'fecha_nacimiento' => $data['fecha_nacimiento'],
        ]);
    }

    public function actualizarPersona(array $data, string $id_iglesia): void    
    {
        Persona::where('id', $data['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'telefono' => $data['telefono'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
            ]);
    }

    public function actualizarEstadoPersona(array $data, string $id_iglesia): void    
    {
        Persona::where('id', $data['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'estado' => !$data['estado'],
            ]);
    }
    
    public function eliminarPersona(string $id, string $id_iglesia, string $id_area): void
    {
        if(strlen($id_area) > 0)
        {
            $areas = explode(',', $id_area);
            PersonaArea::where('persona_id', $id)->whereIn('area_id', $areas)->delete();
        }
      
        Persona::where('id', $id)->where('iglesia_id', $id_iglesia)->delete();
    }

    public function listarPersonas(string $id_iglesia)
    {
        return Persona::select(
            'id',
            DB::raw('concat_ws(" ", nombres, apellidos) as nombre'), 
        ) ->where('iglesia_id', $id_iglesia)
        ->where('estado', 1)
        ->get()->toArray();
    }



}
