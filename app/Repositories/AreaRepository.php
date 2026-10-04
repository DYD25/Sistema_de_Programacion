<?php

namespace App\Repositories;

use App\Models\Area;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonaArea;



class AreaRepository
{
    public function listar(string $id_iglesia)
    {
        return Area::where('iglesia_id', $id_iglesia)->get();
    }

    public function registrarArea(array $datos, string $id_iglesia): void
    {
        Area::create([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'iglesia_id' => $id_iglesia,
            'usa_grupo'=>$datos['usa_grupo'],
            'created_by'=>Auth::user()->id,
            'estado' => 1,
        ]);
    }

    public function actualizarArea(array $datos, string  $id_iglesia): void
    {
        Area::where('id', $datos['id'])
            ->where('iglesia_id', $id_iglesia)
            ->update([
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'usa_grupo'=>$datos['usa_grupo'],
                'created_by'=>Auth::user()->id,
            ]);
    }
    
    public function actualizarEstadoArea(array $datos): void
    {
        Area::where('id', $datos['id'])
            ->update([
                'estado' => !$datos['estado'],
                'created_by'=>Auth::user()->id,
            ]);
    }
    
    public function eliminarArea(string $id): void
    {
        Area::where('id', $id)->delete();
    }
    
    public function obtenerAreas(string $id_iglesia)
    {
        return Area::select('id', 'nombre',)
            ->where('iglesia_id', $id_iglesia)
            ->where('estado', 1)
            ->get();
    }

    public function asignarAreas(array $datos): void
    {
        PersonaArea::where('persona_id', $datos['id_persona'])->delete();

       $areas = is_array($datos['areas'])  ? $datos['areas']  : explode(',', $datos['areas']);

        foreach ($areas as $areaId) {
            PersonaArea::create([
                'persona_id' => $datos['id_persona'],
                'area_id' => trim($areaId),
                'created_by' => auth()->id(),
            ]);
        }
    }
}
