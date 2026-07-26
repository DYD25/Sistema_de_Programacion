<?php

namespace App\Repositories;

use App\Models\Miembro;

class MiembroRepository
{
    public function listar(int $id_iglesia)
    {
        return Miembro::select(
            'id',
            'nombre',
            'nombre_whatsapp',
            'telefono',
            'estado'
        )
            ->where('iglesia_id', $id_iglesia)
            ->get();
    }

    public function guardarMiembros(array $datos, int $id_iglesia): void
    {
        Miembro::create([
            'nombre' => $datos['nombre'],
            'nombre_whatsapp' => $datos['nombre_whatsapp'],
            'telefono' => $datos['telefono'],
            'estado' => 1,
            'iglesia_id' => $id_iglesia
        ]);
    }

    public function actualizarMiembros(array $datos, int $id_iglesia): void
    {
        Miembro::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'nombre' => $datos['nombre'],
                'nombre_whatsapp' => $datos['nombre_whatsapp'],
                'telefono' => $datos['telefono'],
            ]);
    }

    public function actualizarEstadoMiembros(array $datos, int $id_iglesia): void
    {
        Miembro::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarMiembros(array $id, int $id_iglesia): void
    {
        Miembro::whereIn('id', $id)->where('iglesia_id', $id_iglesia)   
            ->delete();
    }

    public function existeMiembro(string $nombre, string $nombre_whatsapp, string $telefono,int $id_iglesia,int $id=null)
    {
        $query = Miembro::where('iglesia_id', $id_iglesia)
            ->where('nombre', $nombre)
            ->where('telefono', $telefono);

            if($id) 
            {
                $query->where('id', '!=', $id);
            }
            return $query->exists();
    }


}
