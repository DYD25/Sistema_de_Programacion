<?php

namespace App\Services;

use Exception;
use App\Repositories\MiembroRepository;
use App\Services\ContextoService;

class MiembroService
{

    public function __construct(
        protected MiembroRepository $miembroRepository, protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        if (!$id_iglesia) {
            return [];
        }
     
        $miembros = $this->miembroRepository->listar($id_iglesia);

        $total = $miembros->count();
        $activos = $miembros->where('estado', 1)->count();
        $inactivos = $miembros->where('estado', 0)->count();

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

            'data' => $miembros
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $respusta =  $this->obtenerMiembroExistente($data['nombre'], $data['telefono'], $id_iglesia);

        if($respusta) return $respusta;

        $this->miembroRepository->guardarMiembros($data, $id_iglesia);

        return [
            'mensaje' => 'Persona registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $respusta =  $this->obtenerMiembroExistente($data['nombre'], $data['telefono'], $id_iglesia, $data['id']);

        if($respusta) return $respusta;
        
        $this->miembroRepository->actualizarMiembros($data, $id_iglesia);

        return [
            'mensaje' => 'Persona actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();   
        $this->miembroRepository->actualizarEstadoMiembros($data, $id_iglesia);

        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->miembroRepository->eliminarMiembros($data['id'], $id_iglesia);

        return [
            'mensaje' => 'Persona eliminado correctamente.' 
        ];
    }

    public function obtenerMiembroExistente(string $nombre, string $telefono,int $id_iglesia,int $id=null)
    {
        if($this->miembroRepository->existeMiembro($nombre, $telefono,$id_iglesia,$id))      
        {
            return [
                'excepcion' => true,
                'mensaje' => "La persona '{$nombre}' ya se encuentra registrada.",
                'status' => 400,
            ]; 
        }
    }
}
