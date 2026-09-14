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

    public function guardarMiembros(array $data, int $id_iglesia): void
    {
        Miembro::create([
            'nombre' => $data['nombre'],
            'nombre_whatsapp' => $data['nombre_whatsapp'],
            'telefono' => $data['telefono'],
            'estado' => 1,
            'iglesia_id' => $id_iglesia
        ]);
    }

    public function actualizarMiembros(array $data, int $id_iglesia): void
    {
        Miembro::where('id', $data['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'nombre' => $data['nombre'],
                'nombre_whatsapp' => $data['nombre_whatsapp'],
                'telefono' => $data['telefono'],
            ]);
    }

    public function actualizarEstadoMiembros(array $data, int $id_iglesia): void
    {
        Miembro::where('id', $data['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'estado' => !$data['estado'],
            ]);
    }
    
    public function eliminarMiembros(int $id, int $id_iglesia): void
    {
        Miembro::where('id', $id)->where('iglesia_id', $id_iglesia)   
            ->delete();
    }

    public function existeMiembro(string $nombre, string $telefono,int $id_iglesia,int $id=null)
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
