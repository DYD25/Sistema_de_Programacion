<?php

namespace App\Services;

use App\Repositories\PersonaRepository;
use App\Services\ContextoService;

class PersonaService
{

    public function __construct(
        protected PersonaRepository $personaRepository, protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        if (!$id_iglesia) {
            return [];
        }
     
        $personas = $this->personaRepository->listar($id_iglesia);

        $total = $personas->count();
        $activos = $personas->where('estado', 1)->count();
        $inactivos = $personas->where('estado', 0)->count();

        return [
            'estadisticas' => [
            'total' => $total,
            'activos' => $activos,
            'inactivos' => $inactivos,
            'crecimiento_mes' => 8,
            'porcentaje_activos' => $total > 0
                ? round(($activos / $total) * 100)
                : 0,
            'porcentaje_inactivos' => $total > 0
                ? round(($inactivos / $total) * 100)
                : 0,
            // Datos temporales para las mini gráficas
            'historico' => [
                'total' => [0, 0, 0, 0, 0, 0, $total],
                'activos' => [0, 0, 0, 0, 0, 0, $activos],
                'inactivos' => [0, 0, 0, 0, 0, 0, $inactivos],
            ]

        ],

            'data' => $personas
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->personaRepository->guardarPersonas($data, $id_iglesia);

        return [
            'mensaje' => 'Persona registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->personaRepository->actualizarPersona($data, $id_iglesia);

        return [
            'mensaje' => 'Persona actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();   
        $this->personaRepository->actualizarEstadoPersona($data, $id_iglesia);

        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->personaRepository->eliminarPersona($data['id'], $id_iglesia);

        return [
            'mensaje' => 'Persona eliminado correctamente.' 
        ];
    }

    // public function obtenerMiembroExistente(string $nombre, string $telefono,int $id_iglesia,int $id=null)
    // {
    //     if($this->miembroRepository->existeMiembro($nombre, $telefono,$id_iglesia,$id))      
    //     {
    //         return [
    //             'excepcion' => true,
    //             'mensaje' => "La persona '{$nombre}' ya se encuentra registrada.",
    //             'status' => 400,
    //         ]; 
    //     }
    // }
}
