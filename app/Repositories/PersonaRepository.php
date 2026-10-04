<?php

namespace App\Repositories;

use App\Models\Persona;

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
    
    public function eliminarPersona(string $id, string $id_iglesia): void
    {
        Persona::where('id', $id)->where('iglesia_id', $id_iglesia)->delete();
    }

    // public function existeMiembro(string $nombre, string $telefono,int $id_iglesia,int $id=null)
    // {
    //     $query = Miembro::where('iglesia_id', $id_iglesia)
    //         ->where('nombre', $nombre)
    //         ->where('telefono', $telefono);

    //         if($id) 
    //         {
    //             $query->where('id', '!=', $id);
    //         }
    //         return $query->exists();
    // }


}
